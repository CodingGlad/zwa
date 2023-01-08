<?php

class Occurence extends Controller
{
    public function index($message = [])
    {
        $conn = $this->connectDb();

        $getHabitsSql = "SELECT name_abbr FROM habits WHERE id_user = '" . mysqli_real_escape_string($conn, $_SESSION['id']) . "'";

        $result = $conn->query($getHabitsSql);

        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }

        if (isset($message['message_valid']) || isset($message['message_invalid']))
        {
            $result = array_merge($rows, $message);
        } else
        {
            $result = $rows;
        }

        $this->view('habitoccurence', $result);
        $conn->close();
    }

    public function add()
    {
        if (isset($_POST['habit-date']) && isset($_POST['selected-habit']))
        {
            $conn = $this->connectDb();

            $occurenceInsertSql = "INSERT INTO occurences VALUES ('" . uniqid() . "', '" .
                mysqli_real_escape_string($conn, $_POST['habit-date']) . "', '" .
                mysqli_real_escape_string($conn, $_POST['selected-habit']) . "', '" .
                mysqli_real_escape_string($conn, $_SESSION['id']) . "')";

            if ($conn->query($occurenceInsertSql) === true)
            {
                $message['message_valid'] = "Habit occurrence has been saved.";
            } else
            {
                $message['message_invalid'] = "Habit occurrence couldn't be saved.";
            }
            $conn->close();

            $this->index($message);

        } else
        {
            $this->index();
        }
    }
}
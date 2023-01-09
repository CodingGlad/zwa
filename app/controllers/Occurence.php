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

    public function show($id = [])
    {
        if (!is_array($id))
        {
            $conn = $this->connectDb();

            $deleteSql = "SELECT id, habit_abbr, date FROM occurences WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";

            $result = $conn->query($deleteSql);
            $conn->close();

            $this->view('habitoccurenceshow', $result->fetch_assoc());
        } else
        {
            $this->view('habitoccurence', ['message_invalid' => 'Occurence was not found.']);
        }


//        $this->index(['message_valid' => 'Habit occurrence has been deleted.']);
    }

    public function remove($id = [])
    {
        if (!is_array($id))
        {
            $conn = $this->connectDb();

            $deleteSql = "DELETE FROM occurences WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";

            $conn->query($deleteSql);
            $conn->close();

            $this->index(['message_valid' => 'Habit occurrence has been deleted.']);
        } else
        {
            $this->view('habitoccurence', ['message_invalid' => 'Occurence was not found.']);
        }
    }
}
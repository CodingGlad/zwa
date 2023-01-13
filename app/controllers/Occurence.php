<?php

/**
 * Occurence controller is used to show, add and delete habit occurrences in habit calendar.
 */
class Occurence extends Controller
{
    /**
     * This method handles showing of data for the possibility of habit occurrence addition.
     * @param $message string if some information was passed to the method.
     * @return void
     */
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
        $_SESSION['occurrence'] = uniqid();

        $this->view('habitOccurence', $result);
        $conn->close();
    }

    /**
     * This method handles adding habit occurrence that was selected by the user.
     * @return void
     */
    public function add()
    {
        if (isset($_POST['habit-date']) && isset($_POST['selected-habit']))
        {
            $conn = $this->connectDb();

            $occurenceInsertSql = "INSERT INTO occurences VALUES ('" . uniqid() . "', '" .
                mysqli_real_escape_string($conn, $_POST['habit-date']) . "', '" .
                mysqli_real_escape_string($conn, $_POST['selected-habit']) . "', '" .
                mysqli_real_escape_string($conn, $_SESSION['id']) . "')";

            if (isset($_SESSION['occurrence']) && isset($_POST['token']) && $_SESSION['occurrence'] == $_POST['token'])
            {
                if ($conn->query($occurenceInsertSql) === true)
                {
                    $message['message_valid'] = "Habit occurrence has been saved.";
                    unset($_SESSION['occurrence']);
                } else
                {
                    $message['message_invalid'] = "Habit occurrence couldn't be saved.";
                }
            } else
            {
                $message['message_invalid'] = "Your token doesn't match.";
            }

            $conn->close();

            $this->index($message);

        } else
        {
            $this->index();
        }
    }

    /**
     * This method is used to show habit occurrence from calendar.
     * @param $id string of habit that has occurred.
     * @return void
     */
    public function show($id = [])
    {
        if (!is_array($id))
        {
            $conn = $this->connectDb();

            $occurrenceSql = "SELECT id, habit_abbr, date FROM occurences WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";

            $result = $conn->query($occurrenceSql);
            $conn->close();

            if ($result->num_rows == 1)
            {
                $_SESSION['occurrenceShow'] = uniqid();

                $this->view('habitOccurenceShow', $result->fetch_assoc());
            } else
            {
                $this->index(['message_invalid' => 'Occurrence was not found.']);
            }
        } else
        {
            $this->index(['message_invalid' => 'Occurrence was not found.']);
        }

    }

    /**
     * This method handles removing an occurrence from database.
     * @param $id string of occurrence to be removed.
     * @return void
     */
    public function remove($id = [])
    {
        if (!is_array($id))
        {
            $conn = $this->connectDb();

            if (isset($_SESSION['occurrenceShow']) && isset($_POST['token']) && $_SESSION['occurrenceShow'] == $_POST['token'])
            {
                $occurrenceSql = "SELECT id, habit_abbr, date FROM occurences WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";
                $result = $conn->query($occurrenceSql);

                if ($result->num_rows == 1)
                {
                    $deleteSql = "DELETE FROM occurences WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";

                    $conn->query($deleteSql);
                    unset($_SESSION['occurrenceShow']);
                    $this->index(['message_valid' => 'Habit occurrence has been deleted.']);
                } else
                {
                    $this->index(['message_invalid' => 'Occurrence was not found.']);
                }
            } else
            {
                $this->index(['message_invalid' => "Your token doesn't match."]);
            }



            $conn->close();

        } else
        {
            $this->index(['message_invalid' => 'Occurrence was not found.']);
        }
    }
}
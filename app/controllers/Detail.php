<?php

/**
 * Detail controller is used for show habit details, adding a new habit, updating and/or deleting it.
 */
class Detail extends Controller
{
    /**
     * This method handles viewing of empty habit detail page so a habit can be added.
     * @return void
     */
    public function index()
    {
        $data['submit_result'] = 'add';
        $_SESSION['detail'] = uniqid();

        $this->view('habitDetail', $data);
    }

    /**
     * This method handles viewing of filled habit detail with existing habit with the possibility of updating it.
     * @param $habitAbbr string of habit to be shown.
     * @return void
     */
    public function show($habitAbbr)
    {
        $conn = $this->connectDb();
        $data['submit_result'] = 'update';
        $_SESSION['detail'] = uniqid();

        $showSql = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] .
            "' AND name_abbr = '" . mysqli_real_escape_string($conn, $habitAbbr) ."'";

        $result = $conn->query($showSql);

        if ($result->num_rows == 1)
        {
            $this->view('habitDetail', array_merge($data, $result->fetch_assoc()));
        } else
        {
            $this->index();
        }

        $conn->close();
    }

    /**
     * This method is used for updating data of existing habit.
     * @param $habit_abbr string of habit to be updated.
     * @return void
     */
    public function update($habit_abbr)
    {
        $data = [
            'id' => $_SESSION['id'],
            'name' => $_POST['habit-name'],
            'name_abbr' => $habit_abbr,
            'color' => $_POST['habit-color'],
            'description' => $_POST['habit-desc']
        ];
        $invalid = $this->validateInput($data);

        if (count($invalid) == 0)
        {
            if (isset($_SESSION['detail']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['detail'])
            {
                if (isset($_POST['deletion'])){
                    $this->delete($habit_abbr);
                } else {
                    if ($data['name'] != '' && $data['color'] != '') {
                        $conn = $this->connectDb();

                        $checkSql = "SELECT * FROM habits WHERE id_user = '" . $data['id'] . "' AND name_abbr = '" .
                            mysqli_real_escape_string($conn, $data['name_abbr']) . "'";

                        if ($conn->query($checkSql)->num_rows == 1) {
                            $updateSql = "UPDATE habits SET name = '" . mysqli_real_escape_string($conn, $data['name']) .
                                "', color = '" . mysqli_real_escape_string($conn, $data['color']) . "', description = '" .
                                mysqli_real_escape_string($conn, $data['description']) . "' WHERE id_user = '" . $data['id'] .
                                "' AND name_abbr = '" . mysqli_real_escape_string($conn, $data['name_abbr']) . "'";

                            $conn->query($updateSql);

                            unset($_SESSION['detail']);
                            $this->viewList($conn);

                        } else {
                            $data['message_invalid'] = 'This habit does not exist anymore.';
                            $data['submit_result'] = 'update';

                            $this->view('habitDetail', $data);
                        }
                        $conn->close();
                    } else {
                        $data['message_invalid'] = 'Received values are not valid.';
                        $data['submit_result'] = 'update';

                        $this->view('habitDetail', $data);
                    }
                }
            } else
            {
                $data['message_invalid'] = "Your token doesn't match.";
                $data['submit_result'] = 'update';

                $this->view('habitDetail', $data);
            }

        }
    }

    /**
     * This method is used for adding a new habit and its data.
     * @return void
     */
    public function add()
    {
        $data = [
            'id' => $_SESSION['id'],
            'name' => $_POST['habit-name'],
            'name_abbr' => $_POST['habit-abbr'],
            'color' => $_POST['habit-color'],
            'description' => $_POST['habit-desc']
            ];
        $invalid = $this->validateInput($data);

        $conn = $this->connectDb();

        if (count($invalid) == 0)
        {
            $checkSql = "SELECT * FROM habits WHERE name_abbr = '" . mysqli_real_escape_string($conn, $data['name_abbr']) ."'";

            $results = $conn->query($checkSql);

            if ($results->num_rows != 0)
            {
                $data['abbr-invalid'] = true;
                $data['message_invalid'] = 'Habit abbreviation is not available.';
                $this->view('habitDetail', $data);
            } else
            {
                $saveSql = "INSERT INTO habits VALUES ('". $data['id'] . "', '" .
                    mysqli_real_escape_string($conn, $data['name']) . "', '" . mysqli_real_escape_string($conn, $data['name_abbr']) .
                    "', '" . mysqli_real_escape_string($conn, $data['color']) . "', '" . mysqli_real_escape_string($conn, $data['description']) . "')";

                $conn->query($saveSql);

                $this->viewList($conn);
            }
        }

        $conn->close();
    }

    /**
     * This method is used for deleting an existing habit based on the habit abbr provided from the user.
     * @param $habit_abbr string of habit to be deleted.
     * @return void
     */
    public function delete($habit_abbr)
    {
        if (isset($_SESSION['detail']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['detail'])
        {
            $conn = $this->connectDb();

            $deleteSql = "DELETE FROM habits WHERE id_user = '" . mysqli_real_escape_string($conn, $_SESSION['id']) .
                "' AND name_abbr = '" . mysqli_real_escape_string($conn, $habit_abbr) . "'";

            $conn->query($deleteSql);

            $this->viewList($conn);

            $conn->close();
        } else
        {
            $this->show($habit_abbr);
        }

    }

    /**
     * This method is used for viewing habit list.
     */
    private function viewList($conn)
    {
        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";
        $result = $conn->query($listSelect);
        unset($_SESSION['detail']);

        $this->view('habitList', $result);
    }

    /**
     * This method is used to validate input data from habit detail.
     * @param $data array to be validated.
     * @return array of invalid inputs.
     */
    private function validateInput($data)
    {
        $invalid = [];

        if ($data['name'] == '')
        {
            $invalid['name-invalid'] = true;
        }

        if ($data['name_abbr'] == '')
        {
            $invalid['abbr-invalid'] = true;
        }

        if ($data['color'] == '')
        {
            $invalid['color-invalid'] = true;
        }

        return $invalid;
    }
}
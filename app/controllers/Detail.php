<?php

class Detail extends Controller
{
    public function index()
    {
        $data['submit_result'] = 'add';

        $this->view('habitDetail', $data);
    }

    public function show($habitAbbr)
    {
        $conn = $this->connectDb();
        $data['submit_result'] = 'update';

        $showSql = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] .
            "' AND name_abbr = '" . mysqli_real_escape_string($conn, $habitAbbr) ."'";

        $result = $conn->query($showSql)->fetch_assoc();

        $conn->close();
        $this->view('habitdetail', array_merge($data, $result));
    }

    public function update($habit_abbr)
    {
        if (isset($_POST['deletion'])){
            $this->delete($habit_abbr);
        } else
        {
            $data = [
                'id' => $_SESSION['id'],
                'name' => htmlspecialchars($_POST['habit-name']),
                'name_abbr' => htmlspecialchars($habit_abbr),
                'color' => htmlspecialchars($_POST['habit-color']),
                'description' => htmlspecialchars($_POST['habit-desc'])
            ];

            if($data['name'] != '' && $data['color'] != '')
            {
                $conn = $this->connectDb();

                $checkSql = "SELECT * FROM habits WHERE id_user = '" . $data['id'] . "' AND name_abbr = '" .
                    mysqli_real_escape_string($conn, $data['name_abbr']) . "'";

                if ($conn->query($checkSql)->num_rows == 1)
                {
                    $updateSql = "UPDATE habits SET name = '" . mysqli_real_escape_string($conn, $data['name']) .
                        "', color = '" . mysqli_real_escape_string($conn, $data['color']) . "', description = '" .
                        mysqli_real_escape_string($conn, $data['description']) . "' WHERE id_user = '" . $data['id'] .
                        "' AND name_abbr = '" . mysqli_real_escape_string($conn, $data['name_abbr']) . "'";

                    $conn->query($updateSql);

                    $this->viewList($conn);

                } else {
                    $data['message_invalid'] = 'This habit does not exist anymore.';
                    $data['submit_result'] = 'update';

                    $this->view('habitdetail', $data);
                }

                $conn->close();
            } else
            {
                $data['message_invalid'] = 'Received values are not valid.';
                $data['submit_result'] = 'update';

                $this->view('habitdetail', $data);
            }
        }
    }

    public function add()
    {
        $data = [
            'id' => $_SESSION['id'],
            'name' => htmlspecialchars($_POST['habit-name']),
            'name_abbr' => htmlspecialchars($_POST['habit-abbr']),
            'color' => htmlspecialchars($_POST['habit-color']),
            'description' => htmlspecialchars($_POST['habit-desc'])
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
                $this->view('habitdetail', $data);
            } else
            {
                $saveSql = "INSERT INTO habits VALUES ('". $data['id'] . "', '" .
                    mysqli_real_escape_string($conn, $data['name']) . "', '" . mysqli_real_escape_string($conn, $data['name_abbr']) .
                    "', '" . mysqli_real_escape_string($conn, $data['color']) . "', '" . mysqli_real_escape_string($conn, $data['description']) . "')";

                $conn->query($saveSql);

                $this->viewList($conn);
            }
        } else
        {
            $this->view('habitdetail', array_merge($data, $invalid));
        }

        $conn->close();
    }

    public function delete($habit_abbr)
    {
        $conn = $this->connectDb();

        $deleteSql = "DELETE FROM habits WHERE id_user = '" . mysqli_real_escape_string($conn, $_SESSION['id']) .
            "' AND name_abbr = '" . mysqli_real_escape_string($conn, $habit_abbr) . "'";

        $conn->query($deleteSql);

        $this->viewList($conn);

        $conn->close();
    }

    private function viewList($conn)
    {
        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";
        $result = $conn->query($listSelect);

        $this->view('habitlist', $result);
    }

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
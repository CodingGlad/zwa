<?php

class Detail extends Controller
{
    public function index()
    {
        $this->view('habitDetail');
    }

    public function show()
    {

    }

    public function add()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "habitjournal";

        $data = [
            'id' => $_SESSION['id'],
            'name' => htmlspecialchars($_POST['habit-name']),
            'name_abbr' => htmlspecialchars($_POST['habit-abbr']),
            'color' => htmlspecialchars($_POST['habit-color']),
            'description' => htmlspecialchars($_POST['habit-desc'])
            ];
        $invalid = $this->validateInput($data);

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error)
        {
            die();
        }

        if (count($invalid) == 0)
        {
            $checkSql = "SELECT * FROM habits WHERE name_abbr = '" . $data['habit-abbr'] ."'";

            $results = $conn->query($checkSql);

            if ($results->num_rows != 0)
            {
                $data['abbr-invalid'] = true;
                $this->view('habitdetail', $data);
            } else
            {

                $saveSql = "INSERT INTO habits VALUES ('". $data['id'] . "', '" .
                    $data['name'] . "', '" . $data['name_abbr'] . "', '" . $data['color'] . "', '" .
                    $data['description'] . "')";

                $conn->query($saveSql);
                $this->view('habitlist');
            }
        } else
        {
            $this->view('habitdetail', array_merge($data, $invalid));
        }

        $conn->close();
    }

    public function validateInput($data)
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
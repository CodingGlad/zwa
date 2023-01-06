<?php

class Detail extends Controller
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "habitjournal";

    public function index()
    {
        $this->view('habitDetail');
    }

    public function show($habitAbbr)
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        $showSql = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] .
            "' AND name_abbr = '" . htmlspecialchars($habitAbbr) ."'";

        $result = $conn->query($showSql);

        $conn->close();
        $this->view('habitdetail', $result->fetch_assoc());
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

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        if (count($invalid) == 0)
        {
            $checkSql = "SELECT * FROM habits WHERE name_abbr = '" . $data['name_abbr'] ."'";

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
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

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error)
        {
            die();
        }

        //TODO check whether we hve everything
        $saveSql = "INSERT INTO habits VALUES ('". uniqid() . "', '". $_SESSION['id'] . "', '" .
            $_POST['habit-name'] . "', '" . $_POST['habit-abbrev'] . "', '" . $_POST['habit-color'] . "', '" .
            $_POST['habit-desc'] . "')";
        $conn->query($saveSql);
        $conn->close();

        $this->view('habitlist');
    }
}
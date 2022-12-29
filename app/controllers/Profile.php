<?php

class Profile extends Controller
{
    private $servername = "localhost";
    private $username = "root";
    private $password = ""; //TODO create another user with certain permissions
    private $db = "habitjournal";

    public function index()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        //todo IMPLEMENT PDO
        $profileSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";

        $result = $conn->query($profileSql);

        $this->view('habitprofile', $result->fetch_assoc());
    }

    public function save()
    {
        $this->view('habitprofile');
    }
}
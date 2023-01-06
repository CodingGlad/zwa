<?php

class Profile extends Controller
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "habitjournal";

    public function index()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        $profileSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";

        $result = $conn->query($profileSql);

        $this->view('habitprofile', $result->fetch_assoc());

        $conn->close();
    }

    public function save()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        //TODO validate email, same thing is in sign in/up
        //TODO date of birth
        $saveSql = "UPDATE users SET first_name = '" . htmlspecialchars($_POST['first-name']) .
            "', last_name = '" . htmlspecialchars($_POST['last-name']) . "', email = '" . htmlspecialchars($_POST['email']) .
            "', date_of_birth = '" . htmlspecialchars($_POST['birthdate']) . "', gender = '" . htmlspecialchars($_POST['gender']) .
            "' WHERE id = '" . $_SESSION['id'] ."'";

        //TODO alert??
        $conn->query($saveSql);
        $conn->close();
        $this->index();
    }
}
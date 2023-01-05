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

        $conn->close();
    }

    //TODO save info and then call index function
    public function save()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        //TODO validate email, same thing is in sign in/up
        //TODO date of birth
        $saveSql = "UPDATE users SET first_name = '" . $_POST['first-name'] .
            "', last_name = '" . $_POST['last-name'] . "', email = '" . $_POST['email'] .
            "', date_of_birth = '" . $_POST['birthdate'] . "', gender = '" . $_POST['gender'] .
            "' WHERE id = '" . $_SESSION['id'] ."'";

        file_put_contents('test.txt', $saveSql);
        //TODO alert??
        $conn->query($saveSql);
        $conn->close();
        $this->index();
    }
}
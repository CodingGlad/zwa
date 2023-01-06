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
        $data = ['first_name' => htmlspecialchars($_POST['first-name']),
                'last_name' => htmlspecialchars($_POST['last-name']),
                'date_of_birth' => htmlspecialchars($_POST['birthdate']),
                'email' => htmlspecialchars($_POST['email']),
                'gender' => htmlspecialchars($_POST['gender'])];

        if ($conn->connect_error)
        {
            die();
        }

        //TODO validate email, same thing is in sign in/up


        if ($data['date_of_birth'] >= date("Y-m-d"))
        {
            $data['birth_invalid'] = true;
        }

        if ($this->validateEmail($data['email']) == 0)
        {
            $data['email_invalid'] = true;
        }

        if (!(isset($data['birth_invalid']) || isset($data['email_invalid'])))
        {
            $saveSql = "UPDATE users SET first_name = '" . $data['first_name'] .
                "', last_name = '" . $data['last_name'] . "', email = '" . $data['email'] .
                "', date_of_birth = '" . $data['date_of_birth'] . "', gender = '" . $data['gender'] .
                "' WHERE id = '" . $_SESSION['id'] ."'";

            $conn->query($saveSql);
        }

        $conn->close();
        $this->view('habitprofile', $data);
    }

    public function validateEmail($email) {
        return preg_match("^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$^", $email);//TODO add for signup and close
    }
}
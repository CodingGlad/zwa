<?php

class Profile extends Controller
{
    public function index()
    {
        $conn = $this->connectDb();

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

        if ($data['date_of_birth'] > date("Y-m-d") || $data['date_of_birth'] < date('Y-m-d', strtotime('1900-1-1')))
        {
            $data['birth_invalid'] = true;
        }

        if ($this->validateEmail($data['email']) == 0)
        {
            $data['email_invalid'] = true;
        }

        if (!(isset($data['birth_invalid']) || isset($data['email_invalid'])))
        {
            $saveSql = "UPDATE users SET first_name = '" . mysqli_real_escape_string($conn,$data['first_name']) .
                "', last_name = '" . mysqli_real_escape_string($conn,$data['last_name']) . "', email = '" . mysqli_real_escape_string($conn,$data['email']) .
                "', date_of_birth = '" . mysqli_real_escape_string($conn,$data['date_of_birth']) . "', gender = '" . mysqli_real_escape_string($conn,$data['gender']) .
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
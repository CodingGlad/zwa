<?php

class SignUp extends Controller
{
    public function index()
    {
        if (isset($_POST['password_check']) && isset($_POST['password']) && isset($_POST['email']))
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "habitjournal";

            $data = ['email' => htmlspecialchars($_POST['email']),
                'password' => htmlspecialchars($_POST['password']),
                'message' => ""];

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die();
            }

            if ($_POST['password'] == $_POST['password_check'] && $this->checkPassword($_POST['password']))
            {
                $data['passwordValid'] = true;
            } else
            {
                $data['passwordValid'] = false;
                $data['message'] .= "Passwords do not match or do not fulfill our rules.<br>";
            }

            $emailSql = "SELECT email FROM users WHERE email = '" . $_POST['email'] . "'";
            $result = $conn->query($emailSql);

            if ($result->num_rows == 0)
            {
                $data['emailValid'] = true;
            }
            else
            {
                $data['emailValid'] = false;
                $data['message'] .= "Email is already in use.<br>";
            }

            if ($data['emailValid'] && $data['passwordValid'])
            {
                $insertSql = "INSERT INTO users VALUES ('" . uniqid() . "', '" . $_POST['email'] ."', '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "')";

                if ($conn->query($insertSql) === TRUE)
                {
                    $this->view('habitcalendar');
                } else
                {
                    $data['message'] .= "Account couldn't be created due to a problem on our server.<br>";
                }
            }

            if (!($data['emailValid'] && $data['passwordValid']))
            {
                $this->view('signup', $data);
            }

        } else {
            $this->view('signup');
        }
    }

    private function checkPassword($password)
    {
        $regex = "/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*/";
        return strlen($password) >= 8 && preg_match($regex, $password);
    } //TODO email validation
}
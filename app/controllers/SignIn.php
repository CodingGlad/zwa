<?php

class SignIn extends Controller
{
    public function index()
    {
        if (isset($_POST['email']))
        {
            $servername = "localhost";
            $username = "root";
            $password = ""; //TODO create another user with certain permissions
            $db = "habitjournal";

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error)
            {
                die();
            }

            $sql = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'"; //TODO sanitize
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if (password_verify($_POST['password'], $user['password']))
                {
                    $_SESSION['id'] = $user['id'];
                    $this->view('habitcalendar');
                } else
                {
                    $this->view('signin', ['message' => 'Password is incorrect.']);
                }

            } else {
                $this->view('signin', ['message' => 'This account does not exist']);
            }
            $conn->close();
        } else
        {
            $this->view('signin');
        }
    }
}
<?php

class SignIn extends Controller
{
    public function index()
    {
        if (isset($_POST['email']))
        {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

            if ($conn->connect_error)
            {
                die();
            }

            $sql = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($conn, $_POST['email']) . "'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if (password_verify($_POST['password'], $user['password']))
                {
                    $_SESSION['id'] = $user['id'];
                    $this->view('habitwelcome');
                } else
                {
                    $this->view('signin', ['message' => 'Password is incorrect.', 'email' => htmlspecialchars($_POST['email'])]);
                }

            } else {
                $this->view('signin', ['message' => 'This account does not exist', 'email' => htmlspecialchars($_POST['email'])]);
            }
            $conn->close();
        } else
        {
            $this->view('signin');
        }
    }
}
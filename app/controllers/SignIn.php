<?php

/**
 * SignIn controller is used for signing in of a user based on provided credentials.
 */
class SignIn extends Controller
{
    /**
     * This method handles signing in. It checks provided credentials. Views welcoming page if credentials
     * were correct, otherwise returns credentials with an error message.
     * @return void
     */
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

                    $controlSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' AND permission = 'contr'";
                    $result = $conn->query($controlSql);

                    if ($result->num_rows == 1)
                    {
                        $this->view('control/habitwelcome');
                    } else
                    {
                        $this->view('habitwelcome');
                    }
                } else
                {
                    $this->view('signin', ['message' => 'Password is incorrect.', 'email' => $_POST['email']]);
                }

            } else {
                $this->view('signin', ['message' => 'This account does not exist', 'email' => $_POST['email']]);
            }
            $conn->close();
        } else
        {
            $this->view('signin');
        }
    }
}
<?php

class SignUp extends Controller
{
    public function index()
    {
        if (isset($_POST['password_check']) && isset($_POST['password']) && isset($_POST['email']))
        {
            $data = ['email' => htmlspecialchars($_POST['email']),
                'password' => htmlspecialchars($_POST['password']),
                'password_check' => htmlspecialchars($_POST['password_check']),
                'message' => ''];

            $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

            if ($conn->connect_error)
            {
                die();
            }

            if ($this->checkEmail($data['email']))
            {
                $data['emailValid'] = true;
            } else
            {
                $data['emailValid'] = false;
                $data['message'] .= "Email is not valid.<br>";
            }

            if ($data['password'] == $data['password_check'] && $this->checkPassword($data['password']))
            {
                $data['passwordValid'] = true;
            } else
            {
                $data['passwordValid'] = false;
                $data['message'] .= "Passwords do not match or do not fulfill our rules";
            }

            $emailSql = "SELECT email FROM users WHERE email = '" . mysqli_real_escape_string($conn,$data['email']) . "'";
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
                $userId = uniqid();
                $insertSql = "INSERT INTO users (id, email, password) VALUES ('" . mysqli_real_escape_string($conn, $userId) . "', '" .
                    mysqli_real_escape_string($conn, $data)['email'] ."', '" . password_hash(mysqli_real_escape_string($conn,$data['password'])
                        , PASSWORD_DEFAULT) . "')";

                if ($conn->query($insertSql))
                {
                    $_SESSION['id'] = $userId;
                    $this->view('habitwelcome', $this->getPresentMonthCalendar($conn));
                } else
                {
                    $data['message'] .= "Account couldn't be created due to a problem on our server.<br>";
                }
            }

            if (!($data['emailValid'] && $data['passwordValid']) || $data['message'] != '')
            {
                $this->view('signup', $data);
            }

            $conn->close();
        } else {
            $this->view('signup');
        }
    }

    private function checkPassword($password)
    {
        $regex = "/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*/";
        return strlen($password) >= 8 && preg_match($regex, $password);
    }

    public function checkEmail($email) {
        return preg_match("^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$^", $email);
    }
}
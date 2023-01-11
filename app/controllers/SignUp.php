<?php

/**
 * SignUp Controller is used for signing up new user and server side validation of email and password.
 */
class SignUp extends Controller
{
    /**
     * This method handles signing up of every new user. If users data were incorrect, they are sent back with a
     * specific message, otherwise welcoming page is shown.
     * @return void
     */
    public function index()
    {
        if (isset($_POST['password_check']) && isset($_POST['password']) && isset($_POST['email']))
        {
            $data = ['email' => $_POST['email'],
                'password' => $_POST['password'],
                'password_check' => $_POST['password_check'],
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
                $data['message'] .= "Email is not valid.";
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
                $data['message'] .= "Email is already in use.";
            }

            if ($data['emailValid'] && $data['passwordValid'])
            {
                $userId = uniqid();
                $insertSql = "INSERT INTO users (id, email, password) VALUES ('" . mysqli_real_escape_string($conn, $userId) . "', '" .
                    mysqli_real_escape_string($conn, $data['email']) ."', '" . password_hash($data['password'], PASSWORD_DEFAULT) . "')";

                if ($conn->query($insertSql))
                {
                    $_SESSION['id'] = $userId;
                    $this->view('habitwelcome');
                } else
                {
                    $data['message'] .= "Account couldn't be created due to a problem on our server.";
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

    /**
     * This method is used by ajax to check whether an email is available.
     * @param $email
     * @return string message to be shown on page.
     */
    public function checkEmailAvailable($email)
    {
        $conn = $this->connectDb();

        $emailSql = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";

        $result = $conn->query($emailSql);

        if ($result->num_rows == 0)
        {
            echo "Email is available";
        } else
        {
            echo "Email has already been used";
        }
    }

    /**
     * This method is used for password validation. It uses RegExp to check whether it contains at least 1 lowercase
     * letter, 1 uppercase letter, 1 number and is at least 8 chars long.
     * @param $password - to be checked.
     * @return bool true if password is valid, otherwise false.
     */
    private function checkPassword($password)
    {
        $regex = "/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*/";
        return strlen($password) >= 8 && preg_match($regex, $password);
    }

    /**
     * This method is used for email format validation.
     * @param $email - to be checked.
     * @return false|int 1 if pattern matches, 0 if patter doesn't match, false if an error occured.
     */
    public function checkEmail($email) {
        return preg_match("^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$^", $email);
    }
}
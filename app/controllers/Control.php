<?php

/**
 * Control controller is used for basic methods that correlate with creation or manipulation with control user.
 */
class Control extends Controller
{
    /**
     * This method views page for addition of control user.
     * @return void
     */
    public function index()
    {
        $this->view('habitcontrol');
    }

    /**
     * This method handles the addition of control user.
     * @return void
     */
    public function add()
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
                $data['message'] .= "Email is not in valid format.";
                $data['emailValid'] = false;
                $data['message_invalid'] = true;
            }

            if ($data['password'] == $data['password_check'] && $this->checkPassword($data['password']))
            {
                $data['passwordValid'] = true;
            } else
            {
                $data['passwordValid'] = false;
                $data['message'] .= "Passwords do not match or they do not fulfill our rules.";
                $data['message_invalid'] = true;
            }

            $emailSql = "SELECT email FROM users WHERE email = '" . mysqli_real_escape_string($conn,$data['email']) . "'";
            $result = $conn->query($emailSql);

            if ($result->num_rows == 0)
            {
                if ($data['emailValid'])
                {
                    $data['emailValid'] = true;
                }
            }
            else
            {
                $data['emailValid'] = false;
                $data['message'] .= "Email has already been used.";
                $data['message_invalid'] = true;
            }

            if ($data['emailValid'] && $data['passwordValid'])
            {
                $userId = uniqid();
                $insertSql = "INSERT INTO users (id, email, password, permission, control_calendar) VALUES 
                            ('" . mysqli_real_escape_string($conn, $userId) . "', '" .
                    mysqli_real_escape_string($conn, $data['email']) . "', '" .
                    password_hash($data['password'], PASSWORD_DEFAULT) . "', 
                    'control', '". $_SESSION['id'] . "')";

                if ($conn->query($insertSql))
                {
                    $data['message'] .= "Control account has been created.";
                    $data['message_valid'] = true;
                    unset($data['email']);
                } else
                {
                    $data['message'] .= "Control account couldn't be created due to a problem on our server.";
                    $data['message_invalid'] = true;
                }
            }

            if (!($data['emailValid'] && $data['passwordValid']) || $data['message'] != '')
            {
                $this->view('habitcontrol', $data);
            }

            $conn->close();
        } else {
            $this->view('habitcontrol');
        }
    }

    /**
     * This method is used for viewing of control calendar for control user.
     * @return void
     */
    public function show()
    {
        $this->view('control/habitControlCalendar');
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
    private function checkEmail($email) {
        return preg_match("^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$^", $email);
    }
}
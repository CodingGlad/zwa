<?php

/**
 * This method is used to get settings of current account.
 */
class SwitchThemes extends Controller
{
    /**
     * This method handles viewing of settings page.
     * @return void
     */
    public function index()
    {
        if (isset($_SESSION['theme']))
        {
            if ($_SESSION['theme'] == 'dark')
            {
                $_SESSION['theme'] = 'light';
            } elseif ($_SESSION['theme'] == 'light')
            {
                $_SESSION['theme'] = 'dark';
            }
        } else
        {
            $_SESSION['theme'] = 'dark';
        }

        $this->viewCorrectPage();
    }

    private function viewCorrectPage()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        $controlSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' AND permission = 'contr'";
        $result = $conn->query($controlSql);

        if ($result->num_rows == 1)
        {
            $this->view('control/habitwelcome');
        } else
        {
            $this->view('habitwelcome');
        }

        $conn->close();
    }
}
<?php

/**
 * This method is used as a parent to every controller in this project. It holds information about the database that is used
 * and handles connection to the database and viewing of views.
 */
class Controller {

    const DEFAULT_THEME = 'light';
    const LIGHT_THEME = 'light';
    const DARK_THEME = 'dark';
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db = "habitjournal";

    /**
     * This method handles viewing of selected view by the controller.
     * @param $view string to display
     * @param $data array to insert
     * @return void
     */
    public function view($view, $data = []) {
        $conn = $this->connectDb();

        $currentTheme = $this->getThemeFromDB($conn);

        if ($currentTheme == self::DARK_THEME)
        {
            require_once '../app/views/dark/' . $view . '.php';
        } elseif ($currentTheme == self::LIGHT_THEME)
        {
            require_once '../app/views/' . $view . '.php';
        }
    }

    /**
     * This method establishes connection to used database.
     * @return mysqli|void connection to the database or void, when connection was not established.
     */
    public function connectDb()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        return $conn;
    }

    /**
     * This method is used for checking whether user is admin or control across all controllers.
     * @param $conn mysqli db connection to use.
     * @return bool true if user is control, otherwise false.
     */
    public function isUserControl($conn)
    {
        $controlSql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' AND permission = 'contr'";
        return $conn->query($controlSql)->num_rows == 1;
    }

    /**
     * This method returns theme value associated with user from DB.
     * @param $conn mysqli to be used for querying.
     * @return mixed|string representation of chosen theme.
     */
    public function getThemeFromDB(&$conn)
    {
        if (isset($_SESSION['id']))
        {
            $themeSql = "SELECT theme FROM users WHERE id = '" . $_SESSION['id'] . "'";

            $result = $conn->query($themeSql);

            if ($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();

                return $row['theme'];
            } else
            {
                return self::DEFAULT_THEME;
            }
        } else
        {
            return self::DEFAULT_THEME;
        }
    }
}
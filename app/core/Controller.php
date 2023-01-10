<?php

/**
 * This method is used as a parent to every controller in this project. It holds information about the database that is used
 * and handles connection to the database and viewing of views.
 */
class Controller {

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db = "habitjournal";

    /**
     * This method handles viewing of selected view by the conroller.
     * @param $view - to display
     * @param $data - to insert
     * @return void
     */
    public function view($view, $data = []) {
        if (isset($_SESSION['theme']))
        {
            if ($_SESSION['theme'] == 'dark')
            {
                require_once '../app/views/dark/' . $view . '.php';
            } elseif ($_SESSION['theme'] == 'light')
            {
                require_once '../app/views/' . $view . '.php';
            }
        } else {
            require_once '../app/views/' . $view . '.php';
        }
    }

    /**
     * This method establishes connection to used database.
     * @return mysqli|void connection to the database or void, when connection was not established.
     */
    public function connectDb() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        return $conn;
    }
}
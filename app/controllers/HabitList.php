<?php

class HabitList extends Controller
{
    public function index()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($conn->connect_error)
        {
            die();
        }

        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";

        $result = $conn->query($listSelect);

        $conn->close();
        $this->view('habitlist', $result);
    }
}
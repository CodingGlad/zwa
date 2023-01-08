<?php

class HabitList extends Controller
{
    public function index()
    {
        $conn = $this->connectDb();

        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";

        $result = $conn->query($listSelect);

        $conn->close();
        $this->view('habitlist', $result);
    }
}
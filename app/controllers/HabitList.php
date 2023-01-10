<?php

/**
 * HabitList controller is used for viewing of all habits in a list.
 */
class HabitList extends Controller
{
    /**
     * This method is used for getting list of habits of certail user from DB.
     * @return void
     */
    public function index()
    {
        $conn = $this->connectDb();

        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";

        $result = $conn->query($listSelect);

        $conn->close();
        $this->view('habitlist', $result);
    }
}
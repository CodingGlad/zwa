<?php

/**
 * HabitList controller is used for viewing of all habits in a list.
 */
class HabitList extends Controller
{
    /**
     * This method is used for getting list of habits of certain user from DB. Before quering for the results, sort or filter is applied.
     * @return void
     */
    public function index()
    {
        $conn = $this->connectDb();

        $listSelect = "SELECT * FROM habits WHERE id_user = '" . $_SESSION['id'] . "'";

        if(isset($_GET['filter']))
        {
            if ($_GET['filter'] == 'Show with description only')
            {
                $listSelect .= " AND description != ''";
            }
        } else if (isset($_GET['sort']))
        {
            if ($_GET['sort'] == 'By name')
            {
                $listSelect .= " ORDER BY name";
            } else if ($_GET['sort'] == 'By abbreviation')
            {
                $listSelect .= "ORDER BY name_abbr";
            } else if ($_GET['sort'] == 'By name reverse')
            {
                $listSelect .= " ORDER BY name DESC";
            } else if ($_GET['sort'] == 'By abbreviation reverse')
            {
                $listSelect .= " ORDER BY name_abbr DESC";
            }
        }

        $result = $conn->query($listSelect);

        $conn->close();
        $this->view('habitList', $result);
    }
}
<?php

class Calendar extends Controller
{
    //TODO first return calendar for current month, then figure out a way of getting desired month
    public function index() {

        if (isset($_GET['dateSubmit']))
        {
            if (isset($_GET['currentDate']))
            {
                $visibleDate = date('Y-m-d', strtotime(htmlspecialchars($_GET['currentDate'])));
            } else {
                $visibleDate = date('Y-m-') . '1';
            }

            if($_GET['dateSubmit'] == 'Next')
            {
                $begin = date_add(new DateTime($visibleDate),
                    date_interval_create_from_date_string('1 month'));
                $end = date_add(new DateTime($visibleDate),
                    date_interval_create_from_date_string('2 month'));
            } else
            {
                $begin = date_add(new DateTime($visibleDate),
                    date_interval_create_from_date_string('-1 month'));
                $end = new DateTime($visibleDate);
            }
        } else
        {
            $begin = new DateTime(date('Y-m-') . '1');
            $end = date_add(new DateTime(date('Y-m-') . '1'),
                date_interval_create_from_date_string("1 month"));
        }

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $datesWithHabits = ['newDate' => $begin->format('F Y')];

        $conn = $this->connectDb();

        foreach($period as $date)
        {
            $formatted = $date->format('d. m. D');
            $datesWithHabits[$formatted] = $this->getHabitsForDate($date->format('Y-m-d'), $conn);
        }

        file_put_contents('calendar.txt', print_r($datesWithHabits, true));

        $conn->close();
        $this->view('habitCalendar', $datesWithHabits);
    }

    private function getHabitsForDate($date, $conn) {
        $getSql = "SELECT color, id FROM habits h INNER JOIN occurences o 
            ON h.id_user = o.user_id AND h.name_abbr = o.habit_abbr WHERE o.date = '" . $date ."'";

        $results =  $conn->query($getSql);

        if ($results->num_rows == 0)
        {
            return [];
        } else
        {
            $rows = [];
            while($row = mysqli_fetch_array($results))
            {
                $rows[] = $row;
            }

            return $rows;
        }
    }


}
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

        foreach($period as $date)
        {
            $formatted = $date->format('d. m. D');
            $datesWithHabits[$formatted] = [];
        }

        $this->view('habitCalendar', $datesWithHabits);
    }


}
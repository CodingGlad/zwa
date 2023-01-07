<?php

class Calendar extends Controller
{
    //TODO first return calendar for current month, then figure out a way of getting desired month
    public function index() {

        $data = [];

        if (isset($_GET['dateSubmit']))
        {
            if (isset($_GET['currentDate']))
            {
                $visibleDate = date('Y-m-d', strtotime(htmlspecialchars($_GET['currentDate'])));
            } else {
                $visibleDate = date('Y-m-') . '1';
            }

            if($_GET['dateSubmit'] == 'forwards')
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

//        file_put_contents('finalTest.txt', $begin->format('F Y') . ' ' . $end->format('F Y'));
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
//        file_put_contents('dateTest.txt', date('Y d m', strtotime('January 2023')));

        $datesWithHabits = [];

        foreach($period as $date)
        {
            $formatted = $date->format('d. m. D');
            $datesWithHabits[$formatted] = [];
        }

//        $this->view('habitCalendar', array_merge($data, $datesWithHabits));
        $this->view('habitCalendar', $datesWithHabits);
    }


}
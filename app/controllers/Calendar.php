<?php

class Calendar extends Controller
{
    //TODO first return calendar for current month, then figure out a way of getting desired month
    public function index() {

        $begin = new DateTime(date('Y-m-') . '1');
        $end = date_add(new DateTime(date('Y-m-') . '1'),
            date_interval_create_from_date_string("1 month"));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $datesWithHabits = [];

        foreach($period as $date)
        {
            $formatted = $date->format('d. m. D');
            $datesWithHabits[$formatted] = [];
        }

        $this->view('habitCalendar', $datesWithHabits);
    }

    private function createDatePeriod()
    {

    }
}
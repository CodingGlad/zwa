<?php

class SignIn extends Controller
{
    public function index()
    {
        if (isset($_POST['email']))
        {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

            if ($conn->connect_error)
            {
                die();
            }

            $sql = "SELECT * FROM users WHERE email = '" . htmlspecialchars($_POST['email']) . "'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if (password_verify($_POST['password'], $user['password']))
                {
                    $_SESSION['id'] = $user['id'];
                    $this->view('habitcalendar', $this->getPresentMonthCalendar($conn));
                } else
                {
                    $this->view('signin', ['message' => 'Password is incorrect.']);
                }

            } else {
                $this->view('signin', ['message' => 'This account does not exist']);
            }
            $conn->close();
        } else
        {
            $this->view('signin');
        }
    }

    //TODO get calendar with habits
    private function getPresentMonthCalendar($conn)
    {
        $begin = new DateTime(date('Y-m-') . '1');
        $end = date_add(new DateTime(date('Y-m-') . '1'),
                date_interval_create_from_date_string("1 month"));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $datesWithHabits = ['newDate' => $begin->format('F Y')];

        foreach($period as $date)
        {
            $formatted = $date->format('d. m. D');
            $datesWithHabits[$formatted] = [];
        }

        return $datesWithHabits;
    }
}
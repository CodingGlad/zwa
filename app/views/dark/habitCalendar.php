<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Habit Journal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://localhost/MojeProjekty/HabitJournal/public/css/stylesDark.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">
            <header>
                <a class="css-button" href="http://localhost/MojeProjekty/HabitJournal/public/calendar">
                    <div class="logo-container">
                        <div class="logo">
                            <img src="http://localhost/MojeProjekty/HabitJournal/public/img/logoZwa2.png" alt="Habit Journal Logo" height="150" width="150">
                        </div>
                        <h1>
                            Habit Journal
                        </h1>
                    </div>
                </a>
                <div class="logout">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/logout" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/out.png" alt="logout-icon" height="24" width="24">
                        <div class="aside-item-text">
                            Log Out
                        </div>
                    </a>
                </div>
            </header>
            <aside>
                <h2>
                    Menu
                </h2>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/calendar" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/calendar.png" alt="calendar-icon" height="24" width="24">
                        <p>
                            Habit Calendar
                        </p>
                    </a>
                </div>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/habitlist" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/menu.png" alt="menu-icon" height="24" width="24">
                        <p>
                            Habit List
                        </p>
                    </a>
                </div>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/detail" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/add.png" alt="add-icon" height="24" width="24">
                        <p>
                            Add Habit
                        </p>
                    </a>
                </div>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/occurence" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/clock.png" alt="clock-icon" height="24" width="24">
                        <p>
                            Add Occurence
                        </p>
                    </a>
                </div>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/profile" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/user.png" alt="user-icon" height="24" width="24">
                        <p>
                            Profile
                        </p>
                    </a>
                </div>
                <div class="aside-item">
                    <a href="http://localhost/MojeProjekty/HabitJournal/public/switchthemes" class="css-button">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon" height="24" width="24">
                        <p>
                            Switch themes
                        </p>
                    </a>
                </div>
            </aside>
            <main>
                <div class="calendar-heading">
                    <form method="get" action="http://localhost/MojeProjekty/HabitJournal/public/calendar">
                        <?php if (isset($data['newDate']))
                            echo '<input type="hidden" name="currentDate" value="' . htmlspecialchars($data['newDate']) . '">';
                            ?>
                        <input type="submit" name="dateSubmit" value="Previous">
                        <div><?php
                        if (isset($data['newDate']))
                        {
                            echo htmlspecialchars($data['newDate']);
                            unset($data['newDate']);
                        } else
                        {
                            echo date('F Y');
                        }
                        ?></div>
                        <input type="submit" name="dateSubmit" value="Next">
                    </form>
                </div>
                <div class="calendar-container">
                    <?php
                        foreach($data as $key=>$habits)
                        {
                            echo '<div class="calendar-item">
                                    <div class="date">' . htmlspecialchars($key) . '</div>
                                    <div class="circle-container">';

                            foreach ($habits as $habit)
                            {
                                echo '<a href="http://localhost/MojeProjekty/HabitJournal/public/occurence/show/' .
                                 htmlspecialchars($habit['id']) . '" class="color-circle" style="background-color: ' . htmlspecialchars($habit['color']) .'"></a>';
                            }

                            echo '
                                    </div>
                                  </div>';
                        }
                    ?>
                </div>
            </main>
        </div>
    </body>
</html>
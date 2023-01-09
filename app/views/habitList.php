<!DOCTYPE html>
<html lang="en">
<head>
    <title>Habit Journal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://localhost/MojeProjekty/HabitJournal/public/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-container">
    <header class="top-bar">
        <a class="css-button" href="http://localhost/MojeProjekty/HabitJournal/public/calendar">
            <div class="logo-container">
                <div class="logo">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/logoZwa2.png" alt="Habit Journal Logo">
                </div>
                <div class="logo-title">
                    Habit Journal
                </div>
            </div>
        </a>
        <div class="logout">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/logout" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/out.png" alt="logout-icon">
                <div class="menu-item-text">
                    Log Out
                </div>
            </a>
        </div>
    </header>
    <aside>
        <h2>
            Menu
        </h2>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/calendar" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/calendar.png" alt="calendar-icon">
                <div class="menu-item-text">
                    Habit Calendar
                </div>
            </a>
        </div>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/habitlist" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/menu.png" alt="menu-icon">
                <div class="menu-item-text">
                    Habit List
                </div>
            </a>
        </div>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/detail" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/add.png" alt="add-icon">
                <div class="menu-item-text">
                    Add Habit
                </div>
            </a>
        </div>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/occurence" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/clock.png" alt="clock-icon">
                <div class="menu-item-text">
                    Add Occurence
                </div>
            </a>
        </div>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/profile" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/user.png" alt="user-icon">
                <div class="menu-item-text">
                    Profile
                </div>
            </a>
        </div>
        <div class="menu-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/settings" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon">
                <div class="menu-item-text">
                    Settings
                </div>
            </a>
        </div>
    </aside>
    <main>
        <h2>
            All Habits
        </h2>
        <div class="habit-list-container">
            <?php
            if (isset($data))
            {
                while (($item = $data->fetch_assoc()) != null)
                {
                    echo '<a class="css-button" href="http://localhost/Mojeprojekty/HabitJournal/public/detail/show/' . $item['name_abbr'] .'">
                          <div class="habit-flex-item">
                              <div class="habit-wide-color" style="background-color: ' . $item['color'] . '"></div> 
                              ' . $item['name'] . '
                          </div>
                      </a>';
                }
            }
            ?>
        </div>
    </main>
</div>
</body>
</html>
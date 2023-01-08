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
        <div class="profile-settings">
            <div class="profile">
                <a href="http://localhost/MojeProjekty/HabitJournal/public/profile" class="css-button">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/user.png" alt="user-icon">
                    <div class="menu-item-text">
                        Profile
                    </div>
                </a>
            </div>
            <div class="logout">
                <a href="http://localhost/MojeProjekty/HabitJournal/public/settings" class="css-button">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon">
                </a>
            </div>
        </div>
    </header>
    <aside>
        <div class="habit-top-bar">
            <div class="habit-heading">
                List of habits
            </div>
            <div class="sidebar-buttons">
                <div class="list-button">
                    <a class="css-button" href="http://localhost/MojeProjekty/HabitJournal/public/habitlist">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/list.png" alt="...">
                    </a>
                </div>
                <div class="plus-button">
                    <a class="css-button" href="http://localhost/MojeProjekty/HabitJournal/public/detail">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/plus.png" alt="+">
                    </a>
                </div>
            </div>
        </div>
        <div class="habit-list">
            <div class="habit-item">
                <div class="habit-color">
                </div>
                Test habit
            </div>
        </div>
    </aside>
    <main class="calendar-body">
        <div class="calendar-heading">
            All Habits
        </div>
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
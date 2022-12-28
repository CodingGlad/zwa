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
        <a class="css-button" href="calendar">
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
                <a href="profile" class="css-button">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/user.png" alt="user-icon">
                    <div class="profile-text">
                        Profile
                    </div>
                </a>
            </div>
            <div class="settings">
                <a href="settings" class="css-button">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon">
                </a>
            </div>
        </div>
    </header>
    <aside class="side-bar">
        <div class="habit-top-bar">
            <div class="habit-heading">
                List of habits
            </div>
            <div class="sidebar-buttons">
                <div class="list-button">
                    <a class="css-button" href="habitlist">
                        <img src="http://localhost/MojeProjekty/HabitJournal/public/img/list.png" alt="...">
                    </a>
                </div>
                <div class="plus-button">
                    <a class="css-button" href="detail">
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
            <!-- TODO add redirects to each habit -->
            <a class="css-button">
                <div class="habit-flex-item">
                    <div class="habit-wide-color"></div> Test habit
                </div>
            </a>
            <a class="css-button">
                <div class="habit-flex-item">
                    <div class="habit-wide-color"></div> Test habit
                </div>
            </a>
            <a class="css-button">
                <div class="habit-flex-item">
                    <div class="habit-wide-color"></div> Test habit
                </div>
            </a>
        </div>
    </main>
</div>
</body>
</html>
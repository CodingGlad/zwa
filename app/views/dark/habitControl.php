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
            <a href="http://localhost/MojeProjekty/HabitJournal/public/switchthemes" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon">
                <div class="menu-item-text">
                    Switch themes
                </div>
            </a>
        </div>
    </aside>
    <main class="detail-container">
        <div class="detail">
            <div class="detail-heading">
                Add your control user
            </div>
            <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/control/add">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" required value="<?=(isset($data['email']))?(htmlspecialchars($data['email'])):("")?>" class="<?php
                if (isset($data['emailValid']))
                {
                    echo ($data['emailValid'])?("input-correct"):("input-error");
                }

                ?>">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required class="<?php
                if (isset($data['passwordValid']))
                {
                    echo ($data['passwordValid'])?("input-correct"):("input-error");
                }
                ?>">
                <div>
                    Password rules:<br>
                    <ul>
                        <li>At least 8 characters</li>
                        <li>At least 1 lower case letter</li>
                        <li>At least 1 upper case letter</li>
                        <li>At least 1 number</li>
                    </ul><br>
                </div>
                <label for="password_check">Retype password</label>
                <input id="password_check" name="password_check" type="password" required>
                <?php
                if ((isset($data['message']) && $data['message'] != ""))
                {
                    $class = '';
                    if (isset($data['message_valid']))
                    {
                        $class = 'message_valid';
                    } elseif (isset($data['message_invalid']))
                    {
                        $class = 'message_invalid';
                    }

                    echo '<div class="message '. $class .'">' . htmlspecialchars($data['message']) . '</div>';
                }
                ?>
                <input id="submit" type="submit" value="Add control user">
            </form>
        </div>
    </main>
</div>
</body>
</html>
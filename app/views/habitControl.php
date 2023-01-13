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
    <header>
        <a class="css-button" href="http://localhost/MojeProjekty/HabitJournal/public/calendar">
            <div class="logo-container">
                <div class="logo">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/logoZwa2.png" alt="Habit Journal Logo">
                </div>
                <h1>
                    Habit Journal
                </h1>
            </div>
        </a>
        <div class="logout">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/logout" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/out.png" alt="logout-icon">
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
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/calendar.png" alt="calendar-icon">
                <p>
                    Habit Calendar
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/habitlist" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/menu.png" alt="menu-icon">
                <p>
                    Habit List
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/detail" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/add.png" alt="add-icon">
                <p>
                    Add Habit
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/occurence" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/clock.png" alt="clock-icon">
                <p>
                    Add Occurence
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/profile" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/user.png" alt="user-icon">
                <p>
                    Profile
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://localhost/MojeProjekty/HabitJournal/public/switchthemes" class="css-button">
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/gear.png" alt="gear-icon">
                <p>
                    Switch themes
                </p>
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

                ?>" pattern="^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required class="<?php
                if (isset($data['passwordValid']))
                {
                    echo ($data['passwordValid'])?("input-correct"):("input-error");
                }
                ?>" pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*">
                <div> <!-- TODO csrf for control user -->
                    Password rules:<br>
                    <ul>
                        <li>At least 8 characters</li>
                        <li>At least 1 lower case letter</li>
                        <li>At least 1 upper case letter</li>
                        <li>At least 1 number</li>
                    </ul><br>
                </div>
                <label for="password_check">Retype password</label>
                <input id="password_check" name="password_check" type="password" required pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*">
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
                <input type="hidden" name="token" value="<?=(isset($_SESSION['control']))?($_SESSION['control']):('')?>">
                <input id="submit" type="submit" value="Add control user">
            </form>
        </div>
    </main>
    <script src="http://localhost/MojeProjekty/HabitJournal/public/js/controlOnSubmit.js"></script>
</div>
</body>
</html>
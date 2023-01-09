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
        <h1>
            Menu
        </h1>
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
                <img src="http://localhost/MojeProjekty/HabitJournal/public/img/calendar.png" alt="occurence-icon">
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
    <main class="detail-container">
        <div class="detail">
            <div class="detail-heading">
                Add Habit Occurence
            </div>
            <?php
                if (isset($data['message_valid']))
                {
                    echo '<span class="message_valid">' . $data['message_valid'] . '</span>';
                    unset($data['message_valid']);
                } elseif (isset($data['message_invalid']))
                {
                    echo '<span class="message_invalid">' . $data['message_invalid'] . '</span>';
                    unset($data['message_invalid']);
                }
            ?>
            <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/occurence/add">
                <label for="selected-habit">Choose habit</label>
                <select name="selected-habit" id="selected-habit" required>
                    <?php
                        if (isset($data))
                        {
                            foreach ($data as $habit)
                            {
                                echo '<option value="' . $habit['name_abbr'] . '">' . $habit['name_abbr'] .
                                    '</option>';
                            }
//                            while(($habit = $data->fetch_assoc()) != null)
//                            {
//                                echo '<option value="' . $habit['name_abbr'] . '">' . $habit['name_abbr'] .
//                                    '</option>';
//                            }
                        }
                    ?>
                </select>
                <label for="habit-date">Set date</label>
                <input type="date" id="habit-date" name="habit-date" required value="<?php echo date('Y-m-d')?>">
                <input type="submit" value="Save Habit">
            </form>
        </div>
    </main>
</div>
</body>
</html>
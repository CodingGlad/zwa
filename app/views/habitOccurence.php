<!DOCTYPE html>
<html lang="en">
<head>
    <title>Habit Journal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://wa.toad.cz/~wodecjak/public/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-container">
    <header>
        <a class="css-button" href="http://wa.toad.cz/~wodecjak/public/Calendar">
                    <div class="logo-container">
                        <div class="logo">
                            <img src="http://wa.toad.cz/~wodecjak/public/img/logoZwa2.png" alt="Habit Journal Logo" height="150" width="150">
                        </div>
                        <h1>
                            Habit Journal
                        </h1>
                    </div>
                </a>
        <div class="logout">
            <a href="http://wa.toad.cz/~wodecjak/public/LogOut" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/out.png" alt="logout-icon" height="24" width="24">
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
            <a href="http://wa.toad.cz/~wodecjak/public/Calendar" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/calendar.png" alt="calendar-icon" height="24" width="24">
                <p>
                    Habit Calendar
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://wa.toad.cz/~wodecjak/public/HabitList" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/menu.png" alt="menu-icon" height="24" width="24">
                <p>
                    Habit List
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://wa.toad.cz/~wodecjak/public/Detail" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/add.png" alt="add-icon" height="24" width="24">
                <p>
                    Add Habit
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://wa.toad.cz/~wodecjak/public/Occurence" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/clock.png" alt="clock-icon" height="24" width="24">
                <p>
                    Add Occurence
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://wa.toad.cz/~wodecjak/public/Profile" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/user.png" alt="user-icon" height="24" width="24">
                <p>
                    Profile
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://wa.toad.cz/~wodecjak/public/SwitchThemes" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/gear.png" alt="gear-icon" height="24" width="24">
                <p>
                    Switch themes
                </p>
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
                    echo '<span class="message_valid">' . htmlspecialchars($data['message_valid']) . '</span>';
                    unset($data['message_valid']);
                } elseif (isset($data['message_invalid']))
                {
                    echo '<span class="message_invalid">' . htmlspecialchars($data['message_invalid']) . '</span>';
                    unset($data['message_invalid']);
                }
            ?>
            <form method="post" action="http://wa.toad.cz/~wodecjak/public/Occurence/add">
                <label for="selected-habit">Choose habit (Required)</label>
                <select name="selected-habit" id="selected-habit" required>
                    <option value="">Choose habit...</option>
                    <?php
                        if (isset($data))
                        {
                            foreach ($data as $key=>$habit)
                            {
                                echo '<option value="' . htmlspecialchars($habit['name_abbr']) . '">' . htmlspecialchars($habit['name_abbr']) .
                                    '</option>';
                            }
                        }
                    ?>
                </select>
                <label for="habit-date">Set date (Required)</label>
                <input type="date" id="habit-date" name="habit-date" required value="<?php echo date('Y-m-d')?>">
                <input type="hidden" name="token" value="<?=(isset($_SESSION['occurrence']))?($_SESSION['occurrence']):('')?>">
                <input type="submit" value="Save Habit">
            </form>
        </div>
    </main>
</div>
</body>
</html>
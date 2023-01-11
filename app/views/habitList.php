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
    <main>
        <div class="calendar-heading">
            <h2>
                All Habits
            </h2>
            <div class="list-forms">
                <div>
                    Sort list:
                    <form method="get" action="http://localhost/MojeProjekty/HabitJournal/public/habitlist">
                        <input type="submit" name="sort" value="By name">
                        <input type="submit" name="sort" value="By abbreviation">
                        <input type="submit" name="sort" value="By name reverse">
                        <input type="submit" name="sort" value="By abbreviation reverse">
                    </form>
                </div>
                <div>
                    Filter list:
                    <form method="get" action="http://localhost/MojeProjekty/HabitJournal/public/habitlist">
                        <input type="submit" name="filter" value="Show with description only">
                    </form>
                </div>
            </div>
        </div>
        <div class="habit-list-container">
            <?php
            if (isset($data))
            {
                while (($item = $data->fetch_assoc()) != null)
                {
                    echo '<a class="css-button" href="http://localhost/Mojeprojekty/HabitJournal/public/detail/show/' . htmlspecialchars($item['name_abbr']) .'">
                          <div class="habit-flex-item">
                              <div class="habit-wide-color" style="background-color: ' . htmlspecialchars($item['color']) . '"></div> 
                              ' . htmlspecialchars($item['name']) . '
                              <div class="habit-abbrev"># ' . $item['name_abbr'] . '</div>
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
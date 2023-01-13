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
    <main>
        <div class="calendar-heading">
            <h2>
                All Habits
            </h2>
            <div class="list-forms">
                <div>
                    Sort list:
                    <form method="get" action="http://wa.toad.cz/~wodecjak/public/HabitList">
                        <input type="submit" name="sort" value="By name">
                        <input type="submit" name="sort" value="By abbreviation">
                        <input type="submit" name="sort" value="By name reverse">
                        <input type="submit" name="sort" value="By abbreviation reverse">
                    </form>
                </div>
                <div>
                    Filter list:
                    <form method="get" action="http://wa.toad.cz/~wodecjak/public/HabitList">
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
                    echo '<a class="css-button" href="http://wa.toad.cz/~wodecjak/public/Detail/show/' . htmlspecialchars($item['name_abbr']) .'">
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
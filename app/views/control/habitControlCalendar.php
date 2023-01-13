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
                    <img src="http://wa.toad.cz/~wodecjak/public/img/logoZwa2.png" alt="Habit Journal Logo">
                </div>
                <h1>
                    Habit Journal
                </h1>
            </div>
        </a>
        <div class="logout">
            <a href="http://wa.toad.cz/~wodecjak/public/LogOut" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/out.png" alt="logout-icon">
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
            <a href="http://wa.toad.cz/~wodecjak/public/SwitchThemes" class="css-button">
                <img src="http://wa.toad.cz/~wodecjak/public/img/gear.png" alt="gear-icon">
                <p>
                    Switch themes
                </p>
            </a>
        </div>
    </aside>
    <main>
        <div class="calendar-heading">
            <form method="get" action="http://wa.toad.cz/~wodecjak/public/Calendar">
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
                    echo '<div ' .
                        htmlspecialchars($habit['id']) . '" class="color-circle" style="background-color: ' . htmlspecialchars($habit['color']) .'"></div>';
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
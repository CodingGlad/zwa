<!DOCTYPE html>
<html lang="en">
<head>
  <title>Habit Journal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://habitjournal-6101.rostiapp.cz/public/css/stylesDark.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-container">
    <header>
        <a class="css-button" href="http://habitjournal-6101.rostiapp.cz/public/calendar">
                    <div class="logo-container">
                        <div class="logo">
                            <img src="http://habitjournal-6101.rostiapp.cz/public/img/logoZwa2.png" alt="Habit Journal Logo" height="150" width="150">
                        </div>
                        <h1>
                            Habit Journal
                        </h1>
                    </div>
                </a>
        <div class="logout">
            <a href="http://habitjournal-6101.rostiapp.cz/public/logout" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/out.png" alt="logout-icon" height="24" width="24">
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
            <a href="http://habitjournal-6101.rostiapp.cz/public/calendar" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/calendar.png" alt="calendar-icon" height="24" width="24">
                <p>
                    Habit Calendar
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://habitjournal-6101.rostiapp.cz/public/habitlist" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/menu.png" alt="menu-icon" height="24" width="24">
                <p>
                    Habit List
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://habitjournal-6101.rostiapp.cz/public/detail" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/add.png" alt="add-icon" height="24" width="24">
                <p>
                    Add Habit
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://habitjournal-6101.rostiapp.cz/public/occurence" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/clock.png" alt="clock-icon" height="24" width="24">
                <p>
                    Add Occurence
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://habitjournal-6101.rostiapp.cz/public/profile" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/user.png" alt="user-icon" height="24" width="24">
                <p>
                    Profile
                </p>
            </a>
        </div>
        <div class="aside-item">
            <a href="http://habitjournal-6101.rostiapp.cz/public/switchthemes" class="css-button">
                <img src="http://habitjournal-6101.rostiapp.cz/public/img/gear.png" alt="gear-icon" height="24" width="24">
                <p>
                    Switch themes
                </p>
            </a>
        </div>
    </aside>
  <main class="detail-container">
    <div class="detail">
      <div class="detail-heading">
        Habit Detail
      </div>
        <?php
        if (isset($data['message_invalid']))
        {
            echo '<span class="message_invalid">' . htmlspecialchars($data['message_invalid']) . '</span>';
            unset($data['message_invalid']);
        }
        ?>
      <form method="post" action="http://habitjournal-6101.rostiapp.cz/public/detail/<?php
            if (isset($data['submit_result'])) {
              echo htmlspecialchars($data['submit_result']);
              if ($data['submit_result'] == 'update')
              {
                  echo '/'.htmlspecialchars($data['name_abbr']);
              }
            }?>">
        <label for="habit-name">Habit name (Required)</label>
        <input type="text" id="habit-name" name="habit-name" required
            <?php
            if (isset($data['name']) && $data['name'] != '') echo 'value = "' . htmlspecialchars($data['name']) . '" ';
            if (isset($data['name-invalid'])) echo 'class = "el_invalid"';?>>
        <label for="habit-abbr">Habit abbreviation (Unique) (Required)</label>
        <input type="text" id="habit-abbr" name="habit-abbr" maxlength="5" required
            <?php
            if (isset($data['submit_result']) && $data['submit_result'] == 'update') echo "disabled ";
            if (isset($data['name_abbr']) && $data['name_abbr'] != '') echo 'value = "' . htmlspecialchars($data['name_abbr']) . '" ';
            if (isset($data['abbr-invalid'])) echo 'class = "el_invalid"';?>>
        <label for="habit-desc">Habit description</label>
        <textarea id="habit-desc" name="habit-desc"><?php
            if (isset($data['description']) && $data['description'] != '') echo htmlspecialchars($data['description']);?></textarea>
        <label for="habit-color">Habit color (Required)</label>
        <input type="color" id="habit-color" name="habit-color"
            <?php
            if (isset($data['color']) && $data['color'] != '') echo 'value = "' . htmlspecialchars($data['color']) . '" ';
            if (isset($data['color-invalid'])) echo 'class = "el_invalid"';?>>
          <input type="hidden" name="token" value="<?=(isset($_SESSION['detail']))?($_SESSION['detail']):('')?>">
        <input type="submit" value="Save Habit">
          <?php
            if (isset($data['submit_result']) && $data['submit_result'] == 'update')
            {
                echo '<input type="submit" value="Delete habit" name="deletion">';
            }
          ?>
      </form>
    </div>
  </main>
</div>
</body>
</html>
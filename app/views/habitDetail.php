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
    </aside>
  <main class="detail-container">
    <div class="detail">
      <div class="detail-heading">
        Habit Detail
      </div>
      <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/detail/add">
        <label for="habit-name">Habit name</label>
        <input type="text" id="habit-name" name="habit-name"
            <?php
            if (isset($data['name']) && $data['name'] != '') echo 'value = "' . $data['name'] . '" ';
            if (isset($data['name-invalid'])) echo 'class = "el_invalid"';?>>
        <label for="habit-abbr">Habit abbreviation (Unique)</label>
        <input type="text" id="habit-abbr" name="habit-abbr" maxlength="5" required
            <?php
            if (isset($data['name_abbr']) && $data['name_abbr'] != '') echo 'value = "' . $data['name_abbr'] . '" ';
            if (isset($data['abbr-invalid'])) echo 'class = "el_invalid"';?>>
        <label for="habit-desc">Habit description</label>
        <textarea id="habit-desc" name="habit-desc"><?php
            if (isset($data['description']) && $data['description'] != '') echo $data['description'];?></textarea>
        <label for="habit-color">Habit color</label>
        <input type="color" id="habit-color" name="habit-color" required
            <?php
            if (isset($data['color']) && $data['color'] != '') echo 'value = "' . $data['color'] . '" ';
            if (isset($data['color-invalid'])) echo 'class = "el_invalid"';?>>
        <input type="submit" value="Save Habit">
      </form>
    </div>
  </main>
</div>
</body>
</html>
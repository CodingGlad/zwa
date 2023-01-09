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
        <h2>
            Menu
        </h2>
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
        Your Habit Profile
      </div>
      <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/profile/save">
        <label for="first-name">First Name</label>
        <input id="first-name" name="first-name" type="text" value="<?=$data['first_name']?>">
        <label for="last-name">Last name</label>
        <input id="last-name" name="last-name" type="text" value="<?=$data['last_name']?>">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" required value="<?=$data['email']?>"
               <?php if (isset($data['email_invalid'])) echo 'class="el_invalid"'?>>
        <label for="birthdate">Date of birth</label>
        <input id="birthdate" name="birthdate" type="date" value="<?=$data['date_of_birth']?>"
               <?php if (isset($data['birth_invalid'])) echo 'class="el_invalid"'?>>
        <p>
          Gender
        </p>
        <span>
          <input type="radio" id="male" value="M" name="gender" <?php if ($data['gender'] == 'M') echo "checked"?>><label for="male">Male</label>
          <input type="radio" id="female" value="F" name="gender" <?php if ($data['gender'] == 'F') echo "checked"?>><label for="female">Female</label>
          <input type="radio" id="other" value="O" name="gender" <?php if ($data['gender'] == 'O') echo "checked"?>><label for="other">Other</label>
          <input type="radio" id="none" value="N" name="gender" <?php if ($data['gender'] == 'N') echo "checked"?>><label for="none">Do not specify</label>
        </span>
        <input type="submit" value="Save Changes">
      </form>
    </div>
  </main>
</div>
</body>
</html>
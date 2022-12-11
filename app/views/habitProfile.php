<!DOCTYPE html>
<html lang="en">
<head>
  <title>Habit Journal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-container">
  <header class="top-bar">
    <a class="css-button" href="calendar">
      <div class="logo-container">
        <div class="logo">
          <img src="img/logoZwa2.png" alt="Habit Journal Logo">
        </div>
        <div class="logo-title">
          Habit Journal
        </div>
      </div>
    </a>
    <div class="profile-settings">
      <div class="profile">
        <a href="profile" class="css-button">
          <img src="img/user.png" alt="user-icon">
          <div class="profile-text">
            Profile
          </div>
        </a>
      </div>
      <div class="settings">
        <a href="settings" class="css-button">
          <img src="img/gear.png" alt="gear-icon">
        </a>
      </div>
    </div>
  </header>
  <aside class="side-bar">
    <div class="habit-top-bar">
      <div class="habit-heading">
        List of habits
      </div>
      <div class="sidebar-buttons">
        <div class="list-button">
          <a class="css-button" href="habitlist">
            <img src="img/list.png" alt="...">
          </a>
        </div>
        <div class="plus-button">
          <a class="css-button" href="detail">
            <img src="img/plus.png" alt="+">
          </a>
        </div>
      </div>
    </div>
    <div class="habit-list">
      <div class="habit-item">
        <div class="habit-color">
        </div>
        Test habit
      </div>
    </div>
  </aside>
  <main class="detail-container">
    <div class="detail">
      <div class="detail-heading">
        Your Habit Profile
      </div>
      <form method="post" action="habitProfile.php">
        <label for="first-name">First Name</label>
        <input id="first-name" name="first-name" type="text" required>
        <label for="last-name">Last name</label>
        <input id="last-name" name="last-name" type="text" required>
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" required>
        <label for="birthdate">Date of birth</label>
        <input id="birthdate" name="birthdate" type="date">
        <p>
          Gender
        </p>
        <span>
          <input type="radio" id="male" name="gender"><label for="male">Male</label>
          <input type="radio" id="female" name="gender"><label for="female">Female</label>
          <input type="radio" id="other" name="gender"><label for="other">Other</label>
          <input type="radio" id="none" name="gender"><label for="none">Do not specify</label>
        </span>
        <input type="submit" value="Save Changes">
      </form>
    </div>
  </main>
</div>
</body>
</html>
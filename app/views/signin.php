<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Habit Journal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://localhost/MojeProjekty/HabitJournal/public/css/signInUp.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">
            <main class="login-container">
                <div class="login-top">
                    <img src="http://localhost/MojeProjekty/HabitJournal/public/img/logoZwa2.png" alt="Logo">
                    Habit Journal
                </div>
                <div class="login-text">
                    Log in to use your Habit Journal profile.
                </div>
                <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/signin">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" required>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                    <input id="submit" type="submit" value="Log In">
                </form>
                <?php
                    echo ((isset($data['message']) && $data['message'] != ""))?("<div class='message'>" . $data['message'] . "</div>"):("");
                ?>
            </main>
            <div class="register-redirect">
                <a href="http://localhost/MojeProjekty/HabitJournal/public/signup">Register</a>
            </div>
        </div>
        <script>
            document.getElementById("submit").disabled = true;
        </script>
        <script src="http://localhost/MojeProjekty/HabitJournal/public/js/signInUpValidation.js"></script>
    </body>
</html>
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
            Sign up to use Habit Journal.
        </div>
        <form method="post" action="http://localhost/MojeProjekty/HabitJournal/public/signup">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" required value="<?=(isset($data['email']))?(htmlspecialchars($data['email'])):("")?>" class="<?php
            if (isset($data['emailValid']))
            {
                echo ($data['emailValid'])?("input-correct"):("input-error");
            }

            ?>" pattern="^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required class="<?php
            if (isset($data['passwordValid']))
            {
                echo ($data['passwordValid'])?("input-correct"):("input-error");
            }
            ?>" pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*">
            <div>
                Password rules:<br>
                <ul>
                    <li>At least 8 characters</li>
                    <li>At least 1 lower case letter</li>
                    <li>At least 1 upper case letter</li>
                    <li>At least 1 number</li>
                </ul><br>
            </div>
            <label for="password_check">Retype password</label>
            <input id="password_check" name="password_check" type="password" required pattern="(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*">
            <input id="submit" type="submit" value="Sign Up">
        </form>
        <?php
            echo ((isset($data['message']) && $data['message'] != ""))?("<div class='message'>" . htmlspecialchars($data['message']) . "</div>"):("");
        ?>
    </main>
    <div class="login-redirect">
        <a href="http://localhost/MojeProjekty/HabitJournal/public/signin">Login</a>
    </div>
    <script>
        document.getElementById("submit").disabled = true;
    </script>
    <script src="http://localhost/MojeProjekty/HabitJournal/public/js/signInUpValidation.js"></script>
</div>
</body>
</html>
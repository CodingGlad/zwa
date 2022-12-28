<!DOCTYPE html>
<html lang="en">
<head>
    <title>Habit Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="css/signInUp.css">-->
    <link rel="stylesheet" href="https://habitjournal.azurewebsites.net/public/css/signInUp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-container">
    <main class="login-container">
        <div class="login-top">
            <img src="https://habitjournal.azurewebsites.net/public/img/logoZwa2.png" alt="Logo">
            Habit Journal
        </div>
        <div class="login-text">
            Sign up to use Habit Journal.
        </div>
        <form method="post">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" value="<?=(isset($data['email']))?($data['email']):("")?>" class="<?php
            if (isset($data['emailValid']))
            {
                echo ($data['emailValid'])?("input-correct"):("input-error");
            }

            ?>">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required value="<?=(isset($data['password']))?($data['password']):("")?>" class="<?php
            if (isset($data['passwordValid']))
            {
                echo ($data['passwordValid'])?("input-correct"):("input-error");
            }
            ?>">
            <label for="password_check">Retype password</label>
            <input id="password_check" name="password_check" type="password" required>
            <input id="submit" type="submit" value="Sign Up" disabled>
        </form>
        <?php
            echo ((isset($data['message']) && $data['message'] != ""))?("<div class='message'>" . $data['message'] . "</div>"):("");
        ?>
    </main>
    <div class="login-redirect">
        <a href="signin">Login</a>
    </div>
    <script>
        document.getElementById("submit").disabled = true;
    </script>
    <script src="https://habitjournal.azurewebsites.net/public/js/signInUpValidation.js"></script>
</div>
</body>
</html>
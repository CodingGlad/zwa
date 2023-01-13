<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Habit Journal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://habitjournal-6101.rostiapp.cz/public/css/signInUp.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">
            <main class="login-container">
                <div class="login-top">
                    <img src="http://habitjournal-6101.rostiapp.cz/public/img/logoZwa2.png" alt="Logo" height="150" width="150">
                    Habit Journal
                </div>
                <div class="login-text">
                    Log in to use your Habit Journal profile.
                </div>
                <form method="post" action="http://habitjournal-6101.rostiapp.cz/public/signin">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" type="email" required value="<?=(isset($data['email']))?(htmlspecialchars($data['email'])):("")?>"
                    pattern="^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                    <input id="submit" type="submit" value="Log In">
                </form>
                <?php
                    echo ((isset($data['message']) && $data['message'] != ""))?("<div class='message'>" . htmlspecialchars($data['message']) . "</div>"):("");
                ?>
            </main>
            <div class="register-redirect">
                <a href="http://habitjournal-6101.rostiapp.cz/public/signup">Register</a>
            </div>
        </div>
        <script>
            document.getElementById("submit").disabled = true;
        </script>
        <script src="http://habitjournal-6101.rostiapp.cz/public/js/signInUpValidation.js"></script>
    </body>
</html>
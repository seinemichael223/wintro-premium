<?php
require_once 'includes/config_session-inc.php';
require_once 'includes/signup_view-inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My First PHP Database Test</title>
    </head>

    <body>
        <h3>Login</h3>

        <form action="includes/login-inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button>Login</button>
        </form>

        <h3>Signup</h3>
        <form action="includes/signup-inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-Mail">
            <button>Signup</button>
        </form>

        <?php
        check_signup_errors();
        ?>

    </body>
</html>

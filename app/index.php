<?php
require_once 'includes/config_session-inc.php';
require_once 'includes/signup_view-inc.php';
require_once 'includes/login_view-inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My First PHP Database Test</title>
    </head>

    <body>
        <form action="dummydata.php" method="post">
            <button>Load Dummy Data</button>
        </form>
        <a href="Homepage/homepage.php">Skip to Homepage</a>

        <?php
check_signup_errors();
?>

    </body>
</html>

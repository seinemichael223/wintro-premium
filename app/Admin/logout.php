<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Clear any authentication cookies if you're using them
if (isset($_COOKIE['user_token'])) {
    setcookie('user_token', '', time() - 3600, '/');
}

// Redirect to login page
header('Location: ../Reg_Login/login.php');
exit();
?>
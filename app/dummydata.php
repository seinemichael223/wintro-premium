<?php
require_once 'includes/dbh-inc.php';
require_once 'includes/signup_model-inc.php';
require_once 'includes/signup_contr-inc.php';
require_once 'includes/config_session-inc.php';

// Dummy Data Here:
set_user($pdo, 'Alice Wong', 'aliceRabbit21', '012-222-5555', 'Abc@123', 'alice@gmail.com');

header("Location: Homepage/homepage.php");

$pdo = null;
$stmt = null;
die();
?>



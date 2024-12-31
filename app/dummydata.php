<?php
require_once 'includes/dbh-inc.php';
require_once 'includes/signup_model-inc.php';
require_once 'includes/signup_contr-inc.php';
require_once 'includes/config_session-inc.php';

// Dummy Data Here:
set_user($pdo, 'alice', 'alice', 'alice@example.com');
set_user($pdo, 'alice', 'bob', 'bob@example.com');
set_user($pdo, 'alice', 'charlie', 'charlie@example.com');

header("Location: Homepage/homepage.php");

$pdo = null;
$stmt = null;
die();
?>



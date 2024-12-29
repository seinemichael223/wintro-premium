<?php

$dsn = "mysql:host=mysql;dbname=front_db";
$dbusername = "virtuosa";
$dbpassword = "cello";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

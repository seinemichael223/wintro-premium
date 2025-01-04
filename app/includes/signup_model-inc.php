<?php

declare(strict_types=1);

function get_username(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email)
{
    $query = "SELECT username FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_pwd(object $pdo, string $pwd)
{
    $query = "SELECT username FROM users WHERE pwd = :pwd;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $fullname, string $username, string $phoneno, string $pwd, string $email)
{
    $query = "INSERT INTO users (full_name, username, pwd, email, phone_number) VALUES (?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(1, $fullname);
    $stmt->bindParam(2, $username);
    $stmt->bindParam(3, $hashedPwd);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $phoneno);

    $stmt->execute();
}

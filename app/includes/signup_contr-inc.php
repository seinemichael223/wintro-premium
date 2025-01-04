<?php

declare(strict_types=1);

function is_input_empty(string $fullname,  string $username, string $phonenumber, string $email, string $pwd)
{
    if (empty($fullname) || empty($username) || empty($phonenumber) || empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username)
{
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_pwd_fulfill(object $pdo, string $pwd)
{
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{6,8}$/', $pwd)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $fullname, string $username, string $phoneno, string $pwd, string $email)
{
    set_user($pdo, $fullname, $username, $phoneno, $email, $pwd);
}

function i_go_sleep() {

};

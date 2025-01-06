<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phoneno = trim($_POST['phoneno']);
    $email = trim($_POST['email']);
    $pwd = $_POST['pwd'];

    try {
        require_once 'dbh-inc.php';
        require_once 'signup_model-inc.php';
        require_once 'signup_contr-inc.php';
        require_once 'mail_stuff.php';

        // Error Handlers~
        $errors = [];

        if (is_input_empty($fullname, $username, $phoneno, $email,  $pwd)) {
            $errors["empty_input"] = "Please fill in all the required fields.";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid Email.";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username Taken.";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered.";
        }
        if (is_pwd_fulfill($pdo, $pwd)) {
            $errors["pwd_xpass"] = "Password must be 6-8 characters long, include an uppercase letter, a number, and a special character.";
        }

        require_once 'config_session-inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../Reg_Login/login.php");
            die();
        }

        create_user($pdo, $fullname, $username, $phoneno, $pwd, $email);

//        notify_mail($username, $email);

        header("Location: ../Reg_Login/login.php?signup=success");

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../Reg_Login/login.php");
    die();
}

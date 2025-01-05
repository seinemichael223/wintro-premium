<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh-inc.php';
        require_once 'login_model-inc.php';
        require_once 'login_contr-inc.php';

        $errors = [];

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $email);

        if (is_email_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info";
        }

        if (!is_email_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session-inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../Reg_Login/login.php");
            exit(); // Always use exit after header()
        }

        session_regenerate_id(true); // Regenerate session ID securely

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["is_admin"] = ($result["is_admin"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: ../Homepage/homepage.php?login=success");
        exit(); // Always use exit after header()
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../Reg_Login/login.php");
    exit();
}


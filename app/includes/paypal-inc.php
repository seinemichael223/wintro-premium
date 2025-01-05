<?php
require_once 'dbh-inc.php';
require_once 'config_session-inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch required session variables
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];

    if (!$user_id || !$user_email) {
        die("Error: User is not logged in. Sad");
    }

    // Fetch the total cost from myCart.php
    $totalCost = 0;
    $cart = $_SESSION['cart'] ?? [];
    foreach ($cart as $item) {
        $totalCost += intval($item['quantity']) * floatval($item['product_price']);
    }

    // Prepare hardcoded address data
    $address_street = "123 Fake Street";
    $address_city = "Faketown";
    $address_state = "Fukuoka";
    $address_zip = "12345";
    $address_country = "Badlands";

    // Insert the transaction into the database
    $sql = "INSERT INTO transactions (
                payment_amount, 
                payment_status, 
                payer_id, 
                payer_email, 
                address_street, 
                address_city, 
                address_state, 
                address_zip, 
                address_country
            ) VALUES (
                :payment_amount, 
                :payment_status, 
                :payer_id, 
                :payer_email, 
                :address_street, 
                :address_city, 
                :address_state, 
                :address_zip, 
                :address_country
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':payment_amount' => $totalCost,
        ':payment_status' => 'INCOMPLETE', // Default status
        ':payer_id' => $user_id,
        ':payer_email' => $user_email,
        ':address_street' => $address_street,
        ':address_city' => $address_city,
        ':address_state' => $address_state,
        ':address_zip' => $address_zip,
        ':address_country' => $address_country,
    ]);

    // Redirect or display a success message
    unset($_SESSION['cart']);
    header('Location: ../MyCart/myCart.php?status=success');
    exit();
}
?>

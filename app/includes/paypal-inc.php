<?php
require_once 'dbh-inc.php'; // Include your database connection file
require_once 'config_session-inc.php'; // Include your session configuration file

if (isset($_POST['paypal'])) {
    // Fetch required session variables
    $user_id = $_SESSION['user_id'] ?? null;
    $user_email = $_SESSION['user_email'] ?? null;

    if (!$user_id || !$user_email) {
        die("Error: User is not logged in.");
    }

    // Fetch the total cost from the cart
    $totalCost = 0;
    $cart = $_SESSION['cart'] ?? [];
    foreach ($cart as $item) {
        $totalCost += intval($item['quantity']) * floatval($item['product_price']);
    }

    // Fetch the user's address from the user_address table
    $address_query = "SELECT * FROM user_address WHERE uid = :uid LIMIT 1";
    $address_stmt = $pdo->prepare($address_query);
    $address_stmt->execute([':uid' => $user_id]);
    $address = $address_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$address) {
        die("Error: Address not found for the user.");
    }

    // Extract address details
    $address_street = $address['address_street'];
    $address_city = $address['address_city'];
    $address_state = $address['address_state'];
    $address_zip = $address['address_zip'];
    $address_country = $address['address_country'];

    // Start transaction for atomic database operations
    try {
        $pdo->beginTransaction();

        // Insert the main transaction into the transactions table
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

        // Get the transaction ID of the inserted record
        $transaction_id = $pdo->lastInsertId();

        // Insert product details into the transaction_details table
        $details_sql = "INSERT INTO transaction_details (tid, product_name, quantity) VALUES (:tid, :product_name, :quantity)";
        $details_stmt = $pdo->prepare($details_sql);

        foreach ($cart as $item) {
            $details_stmt->execute([
                ':tid' => $transaction_id,
                ':product_name' => $item['product_name'],
                ':quantity' => intval($item['quantity']),
            ]);
        }

        // Commit the transaction
        $pdo->commit();

        // Redirect or display a success message
        unset($_SESSION['cart']);
        header('Location: ../MyCart/myCart.php?status=success');
        exit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        $pdo->rollBack();
        die("Error: " . $e->getMessage());
    }
}
?>


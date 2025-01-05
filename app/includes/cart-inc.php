<?php
require_once 'dbh-inc.php';
require_once 'config_session-inc.php';

// Fetch the cart from the session
$cart = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'delete' && isset($_POST['product_id'])) {
            $productId = intval($_POST['product_id']);
            unset($_SESSION['cart'][$productId]);
            header('Location: ../MyCart/myCart.php');
        }
    }
    exit();
}

// Calculate the total cost of all items in the cart
$totalCost = 0;
foreach ($cart as $item) {
    $totalCost += $item['quantity'] * $item['product_price'];
}
?>


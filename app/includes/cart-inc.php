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
        }
    }
    header('Location: cart-inc.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    <?php if (!empty($cart)): ?>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cart as $id => $item): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="50"></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= intval($item['quantity']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="<?= $id ?>">
                            <button type="submit" name="action" value="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <br>
    <a href="product_details-inc.php">Add More Products</a>
</body>
</html>


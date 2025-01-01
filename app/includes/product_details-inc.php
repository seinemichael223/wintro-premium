<?php

require_once 'dbh-inc.php';
require_once 'config_session-inc.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Fetch product details from the database
    $stmt = $pdo->prepare("SELECT product_name, product_image, product_unit_price FROM product WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && $quantity > 0) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $product['product_name'],
                'image' => $product['product_image'],
                'price' => $product['product_unit_price'],
                'quantity' => $quantity
            ];
        }
        echo "<p>Product added to cart successfully!</p>";
    } else {
        echo "<p>Invalid product or quantity.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <h1>Product Details</h1>
    <form method="post" action="">
        <label for="product_id">Product ID:</label>
        <input type="number" id="product_id" name="product_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required><br>

        <button type="submit">Add to Cart</button>
    </form>

    <br>
    <a href="../MyCart/myCart.php">Go to Cart</a>
</body>
</html>


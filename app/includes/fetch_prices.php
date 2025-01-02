<?php
function fetchPrices($pdo, $product_id)
{
    $query = "SELECT product_unit_price, product_bulk_price FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row as an associative array
}

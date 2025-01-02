<?php
// Function to fetch options items
function fetchOptions($pdo, $product_id)
{
    $query = "SELECT option_size, option_colour FROM options WHERE product_id = :product_id LIMIT 0, 25";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

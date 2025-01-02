<?php
function fetchOptionId($pdo, $product_id, $size, $color)
{
    $query = "
        SELECT option_id 
        FROM options 
        WHERE product_id = :product_id 
          AND option_size = :size 
          AND option_colour = :color
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->bindParam(':size', $size, PDO::PARAM_STR);
    $stmt->bindParam(':color', $color, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn(); // Fetch only the option_id
}

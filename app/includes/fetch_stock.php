<?php
function fetchStock($pdo, $option_id)
{
    $query = "
        SELECT stock_quantity 
        FROM inventory 
        WHERE option_id = :option_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':option_id', $option_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch stock quantity as an associative array
}

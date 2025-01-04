<?php
require_once '../includes/dbh-inc.php';

function searchProducts($pdo, $search) {
    $pdo->exec("SET NAMES utf8mb4");
    
    $query = "
        SELECT 
            p.product_id, 
            p.product_name, 
            p.product_description, 
            p.product_image,
            p.product_unit_price, 
            p.product_bulk_price, 
            c.category_name,
            s.sub_category_name,
            o.option_id,
            o.option_colour,
            o.option_size,
            i.inventory_id,
            i.stock_quantity
        FROM 
            product p
        LEFT JOIN 
            sub_category s ON p.sub_category_id = s.sub_category_id
        LEFT JOIN 
            category c ON s.category_id = c.category_id
        LEFT JOIN 
            options o ON p.product_id = o.product_id
        LEFT JOIN 
            inventory i ON (p.product_id = i.product_id AND (i.option_id = o.option_id OR i.option_id IS NULL))
    ";
    
    $params = [];
    
    if (!empty($search)) {
        $query .= "
            WHERE 
                p.product_name LIKE :search
                OR p.product_description LIKE :search
                OR c.category_name LIKE :search
                OR s.sub_category_name LIKE :search
                OR o.option_colour LIKE :search
                OR o.option_size LIKE :search
        ";
        $params['search'] = "%$search%";
    }
    
    $query .= " ORDER BY p.product_id, o.option_id";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Reorganize the data to group options by product
    $products = [];
    foreach ($results as $row) {
        $productId = $row['product_id'];
        
        if (!isset($products[$productId])) {
            $products[$productId] = [
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'product_description' => $row['product_description'],
                'product_image' => $row['product_image'],
                'product_unit_price' => $row['product_unit_price'],
                'product_bulk_price' => $row['product_bulk_price'],
                'category_name' => $row['category_name'],
                'sub_category_name' => $row['sub_category_name'],
                'options' => [],
                'total_stock' => 0
            ];
        }
        
        if ($row['option_id']) {
            $option = [
                'option_id' => $row['option_id'],
                'option_colour' => $row['option_colour'],
                'option_size' => $row['option_size'],
                'stock_quantity' => $row['stock_quantity'] ?? 0
            ];
            $products[$productId]['options'][] = $option;
            $products[$productId]['total_stock'] += ($row['stock_quantity'] ?? 0);
        } else {
            // If no options, just add the stock quantity
            $products[$productId]['total_stock'] += ($row['stock_quantity'] ?? 0);
        }
    }
    
    return array_values($products);
}

// Handle AJAX requests
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    header('Content-Type: application/json');
    $search = trim($_GET['search'] ?? '');
    $products = searchProducts($pdo, $search);
    echo json_encode($products);
    exit;
}
<!-- customers_search.php -->
<?php
function searchCustomers($pdo, $search = '') {
    // Sanitize the search input
    $search = trim($search);
    
    $query = "SELECT u.id, u.full_name, u.username, u.email, u.phone_number, u.date_created,
                     a.address_street, a.address_city, a.address_state, a.address_zip, a.address_country
              FROM users u
              LEFT JOIN user_address a ON u.id = a.uid
              WHERE 1=1";
    
    $params = [];
    
    if (!empty($search)) {
        $query .= " AND (
            u.full_name LIKE :search 
            OR u.username LIKE :search 
            OR u.email LIKE :search 
            OR u.phone_number LIKE :search
            OR a.address_street LIKE :search
            OR a.address_city LIKE :search
            OR a.address_state LIKE :search
            OR a.address_zip LIKE :search
            OR a.address_country LIKE :search
        )";
        $params[':search'] = "%$search%";
    }
    
    $query .= " ORDER BY u.date_created DESC";
    
    try {
        $stmt = $pdo->prepare($query);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results ?: [];
        
    } catch (PDOException $e) {
        error_log("Error in searchCustomers: " . $e->getMessage());
        $_SESSION['error'] = "An error occurred while searching customers.";
        return [];
    }
}
?>
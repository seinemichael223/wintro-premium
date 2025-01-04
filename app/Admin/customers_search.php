<?php
function searchCustomers($pdo, $search = '') {
    // Sanitize the search input
    $search = trim($search);
    
    $query = "SELECT id, full_name, username, email, phone_number, address_street, address_city, address_state, address_zip, address_country, date_created FROM users WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $query .= " AND (
            full_name LIKE :search 
            OR username LIKE :search 
            OR email LIKE :search 
            OR phone_number LIKE :search
            OR address_street LIKE :search
            OR address_city LIKE :search
            OR address_state LIKE :search
            OR address_zip LIKE :search
            OR address_country LIKE :search
        )";
        $params[':search'] = "%$search%";
    }
    
    $query .= " ORDER BY date_created DESC";
    
    try {
        $stmt = $pdo->prepare($query);
        
        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verify we have results before returning
        if ($results === false) {
            error_log("No results found in searchCustomers");
            return [];
        }
        
        return $results;
        
    } catch (PDOException $e) {
        error_log("Error in searchCustomers: " . $e->getMessage());
        // You might want to add a session error message here
        $_SESSION['error'] = "An error occurred while searching customers.";
        return [];
    }
}
?>
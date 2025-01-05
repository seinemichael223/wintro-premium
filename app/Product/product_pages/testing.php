<?php
require_once '../../includes/dbh-inc.php'; // Include database connection

// Get the search query from the URL
$query = isset($_GET['search']) ? $_GET['search'] : '';

if ($query) {
    try {
        // Prepare the SQL query with placeholders
        $sql = "SELECT * FROM product 
                WHERE product_name LIKE :query OR 
                      product_description LIKE :query OR 
                      sub_category LIKE :query";

        $stmt = $pdo->prepare($sql);

        // Bind the search query with wildcards for partial matches
        $searchTerm = "%$query%";
        $stmt->bindValue(':query', $searchTerm, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        $results = $stmt->fetchAll();

        if ($results) {
            echo "<h2>Search Results:</h2><ul>";
            foreach ($results as $row) {
                echo "<li><strong>" . htmlspecialchars($row['product_name']) . "</strong> - ";
                echo htmlspecialchars($row['product_description']) . " ($" . htmlspecialchars($row['product_unit_price']) . ")</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No results found for '<strong>" . htmlspecialchars($query) . "</strong>'</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Search</title>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="header2">
        <!-- Search Form -->
        <form method="GET" action="search.php" class="search-form">
            <div class="input-container">
                <i class="fa-solid fa-bars"></i>
                <input type="text" name="search" id="search" placeholder="Search products..." required>
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>
</body>

</html>
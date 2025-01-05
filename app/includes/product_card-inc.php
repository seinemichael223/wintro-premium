<?php
// Function to display product cards
function displayProducts($pdo, $sql, $bindings = [])
{
    try {
        $stmt = $pdo->prepare($sql);

        // Bind parameters if provided 
        $i = 1; // Initialize parameter index 
        foreach ($bindings as $value) {
            $stmt->bindValue($i, $value, PDO::PARAM_INT);
            $i++;
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Adjust the path to the image based on the folder structure
                $image_url = htmlspecialchars($row['product_image']);
                $product_id = htmlspecialchars($row['product_id']);
                $product_name = htmlspecialchars($row['product_name']);
                $product_price = htmlspecialchars($row['product_unit_price']);

                echo '
                <a href="../../Product Details/productDetail.php?id=' . $product_id . '" class="product-card-link">
                    <div class="product-card">
                        <div class="card-image">
                            <img src="../../' . $image_url . '" alt="' . $product_name . '">
                        </div>
                        <div class="card-title">
                            <h5>' . $product_name . '</h5>
                            <p>RM ' . $product_price . '</p>
                        </div>
                    </div>
                </a>';
            }
        } else {
            echo "<p>No products found.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

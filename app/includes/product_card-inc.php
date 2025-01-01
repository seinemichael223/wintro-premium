<?php
// Function to display product cards
function displayProducts($pdo)
{
    $sql = "SELECT * FROM product WHERE sub_category_id = 1";
    $result = $pdo->query($sql);

    echo '<div class="product-grid">';

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Get the image path from the database
            $image_path = $row['product_image'];  // e.g., uploads/Awards and Trophies/trophy/Acrylic Plastic Trophy.png

            // Construct the full image URL
            $image_url = "../uploads/" . $image_path;  // Adjusted path

            // Display the product card with the image
            echo '
            <div class="product-card">
                <div class="card-image">
                    <img src="' . $image_url . '" alt="' . htmlspecialchars($row['product_name']) . '">
                </div>
                <div class="card-title">
                    <h5>' . htmlspecialchars($row['product_name']) . '</h5>
                    <p>' . htmlspecialchars($row['product_description']) . '</p>
                </div>
            </div>';
        }
    } else {
        echo "<p>No products found in the Trophy category.</p>";
    }

    echo '</div>';
}

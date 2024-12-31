<?php
// Function to display product cards
function displayProducts($pdo)
{
    $sql = "SELECT * FROM products WHERE category = 'Trophy'";
    $result = $pdo->query($sql);

    echo '<div class="product-grid">';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="product-card">
                <div class="card-image">
                    <img src="' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['product_name']) . '">
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

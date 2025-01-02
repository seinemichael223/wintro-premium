<?php
// Function to display product cards
function displayProducts($pdo)
{
    $sql = "SELECT * FROM product WHERE sub_category_id = 1";
    $result = $pdo->query($sql);

    echo '<div class="product-grid">';

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Adjust the path to the image based on the folder structure
            $image_url = htmlspecialchars($row['product_image']);
            $product_id =  htmlspecialchars($row['product_id']);
            $product_name =  htmlspecialchars($row['product_name']);
            $product_price = htmlspecialchars($row['product_unit_price']);


            echo '
            <a href="../../Product Details/productDetail.php?id=' . $product_id . '" class="product-card-link">
                <div class="product-card">
                    <div class="card-image">
                        <img src="' . $image_url . '" alt="' . $product_name . '">
                    </div>
                    <div class="card-title">
                        <h5>' . $product_name . '</h5>
                        <p>RM ' . $product_price . '</p>
                    </div>
                </div>
            </a>';
        }
    } else {
        echo "<p>No products found in the Trophy category.</p>";
    }

    echo '</div>';
}

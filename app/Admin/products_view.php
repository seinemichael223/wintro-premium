<?php
session_start();
require_once '../includes/dbh-inc.php';
require_once 'products_search.php';

// Get search query if exists
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Get products using the search function
$products = searchProducts($pdo, $search);

// Handle success/error messages
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="products_style.css" rel="stylesheet">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container mt-4">
        <h2>Product Management</h2>

        <!-- Search Container -->
        <div class="d-flex align-items-center mb-3">
            <div class="input-group" style="width: 300px;">
                <input type="text" 
                       id="searchInput" 
                       class="form-control" 
                       placeholder="Search products..."
                       value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" id="searchButton">Search</button>
            </div>
            <a href="products_view.php" class="btn btn-secondary ms-2">Clear</a>
            <a href="products_add.php" class="btn btn-primary ms-auto">Add New Product</a>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Sub-Category</th>
                <th>Description</th>
                <th>Options</th>
                <th>Unit Price (RM)</th>
                <th>Bulk Price (RM)</th>
                <th>Total Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody">
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['product_id']); ?></td>
                <td><?= htmlspecialchars($product['product_name']); ?></td>
                <td>
                    <?php
                    $baseDir = '../Product/Awards&Trophies/uploads/';
                    if (!empty($product['product_image'])) {
                        $imagePath = str_replace('uploads/', '', $product['product_image']);
                        $fullPath = $baseDir . $imagePath;
                        
                        if (file_exists($fullPath)) {
                            echo '<img src="' . htmlspecialchars($fullPath) . '" alt="Product Image" width="100">';
                        } else {
                            echo '<p>No image available (File not found)</p>';
                        }
                    } else {
                        echo '<p>No image available (No path)</p>';
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($product['category_name']); ?></td>
                <td><?= htmlspecialchars($product['sub_category_name']); ?></td>
                <td class="product-description">
                    <?php 
                    $description = $product['product_description'] ?? '';
                    $description = str_replace(
                        ['â€™', 'â€³', 'â€"'],
                        ['\'', '"', '-'],
                        $description
                    );
                    echo nl2br(htmlspecialchars($description)); 
                    ?>
                </td>
                <td>
                    <?php if (!empty($product['options'])): ?>
                        <table class="table table-sm table-borderless mb-0">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product['options'] as $option): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($option['option_colour'] ?? 'N/A'); ?></td>
                                        <td><?= htmlspecialchars($option['option_size']); ?></td>
                                        <td><?= number_format($option['stock_quantity']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No options available</p>
                    <?php endif; ?>
                </td>
                <td><?= number_format($product['product_unit_price'], 2); ?></td>
                <td><?= number_format($product['product_bulk_price'], 2); ?></td>
                <td><?= number_format($product['total_stock']); ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="products_edit.php?id=<?= $product['product_id']; ?>" 
                        class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal<?= $product['product_id']; ?>">
                            Delete
                        </button>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade delete-modal" id="deleteModal<?= $product['product_id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this product?</p>
                                    <p><strong>Product:</strong> <?= htmlspecialchars($product['product_name']); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="POST" action="products_delete.php">
                                        <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                        <input type="hidden" name="confirm_delete" value="1">
                                        <button type="submit" class="btn btn-danger">Yes, Delete Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="products_search.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>


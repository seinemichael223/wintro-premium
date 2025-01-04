<?php
session_start();
require_once '../includes/dbh-inc.php';

// Define upload directory path
$target_dir = "../Product/Awards&Trophies/uploads/";

// Create uploads directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$product_id) {
    $_SESSION['error'] = "Invalid product ID";
    header("Location: products_view.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $product_name = trim($_POST['name']);
    $product_description = trim($_POST['description']);
    $unit_price = floatval($_POST['unit_price']);
    $bulk_price = floatval($_POST['bulk_price']);
    $sub_category = intval($_POST['sub_category']);

    // Begin transaction
    $pdo->beginTransaction();

    try {
        // Handle file upload if new image is provided
        $image_path = null;
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
            $file_tmp = $_FILES["product_image"]["tmp_name"];
            $file_name = basename($_FILES["product_image"]["name"]);
            $target_file = $target_dir . $file_name;
            
            // Verify file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = mime_content_type($file_tmp);
            
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception("Only JPG, PNG & GIF files are allowed.");
            }
            
            if (!move_uploaded_file($file_tmp, $target_file)) {
                throw new Exception("Failed to upload file.");
            }
            
            $image_path = "uploads/" . $file_name;
        }

        // Update product details
        $sql = "UPDATE product SET 
                product_name = :name,
                product_description = :description,
                product_unit_price = :unit_price,
                product_bulk_price = :bulk_price,
                sub_category_id = :sub_category";

        // Add image to update if new one was uploaded
        if ($image_path) {
            $sql .= ", product_image = :image";
        }
        
        $sql .= " WHERE product_id = :product_id";
        
        $stmt = $pdo->prepare($sql);
        
        $params = [
            ':name' => $product_name,
            ':description' => $product_description,
            ':unit_price' => $unit_price,
            ':bulk_price' => $bulk_price,
            ':sub_category' => $sub_category,
            ':product_id' => $product_id
        ];
        
        if ($image_path) {
            $params[':image'] = $image_path;
        }
        
        $stmt->execute($params);

        // Commit transaction
        $pdo->commit();
        
        $_SESSION['success'] = "Product updated successfully";
        header("Location: ../admin/admin_ProductManagement.php");
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error updating product: " . $e->getMessage();
        header("Location: products_edit.php?id=" . $product_id);
        exit;
    }
}

// Fetch product details
$stmt = $pdo->prepare("
    SELECT 
        p.*,
        c.category_id,
        c.category_name,
        s.sub_category_name,
        o.option_id,
        o.option_colour,
        o.option_size,
        i.inventory_id,
        i.stock_quantity
    FROM product p
    LEFT JOIN sub_category s ON p.sub_category_id = s.sub_category_id
    LEFT JOIN category c ON s.category_id = c.category_id
    LEFT JOIN options o ON p.product_id = o.product_id
    LEFT JOIN inventory i ON (p.product_id = i.product_id AND i.option_id = o.option_id)
    WHERE p.product_id = ?
");

$stmt->execute([$product_id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($results)) {
    $_SESSION['error'] = "Product not found";
    header("Location: products_view.php");
    exit;
}

// Organize the data
$product = [
    'product_id' => $results[0]['product_id'],
    'product_name' => $results[0]['product_name'],
    'product_description' => $results[0]['product_description'],
    'product_image' => $results[0]['product_image'],
    'product_unit_price' => $results[0]['product_unit_price'],
    'product_bulk_price' => $results[0]['product_bulk_price'],
    'category_id' => $results[0]['category_id'],
    'sub_category_id' => $results[0]['sub_category_id'],
    'category_name' => $results[0]['category_name'],
    'sub_category_name' => $results[0]['sub_category_name'],
    'options' => []
];

foreach ($results as $row) {
    if ($row['option_id']) {
        $product['options'][] = [
            'option_id' => $row['option_id'],
            'option_colour' => $row['option_colour'],
            'option_size' => $row['option_size'],
            'stock_quantity' => $row['stock_quantity']
        ];
    }
}

// Fetch categories and subcategories
$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
$subcategories = $pdo->query("SELECT * FROM sub_category")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - <?= htmlspecialchars($product['product_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Product</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['category_id']; ?>" 
                            <?= $category['category_id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="sub_category" class="form-label">Sub-Category</label>
                <select class="form-select" id="sub_category" name="sub_category" required>
                    <?php foreach ($subcategories as $subcategory): ?>
                        <option value="<?= $subcategory['sub_category_id']; ?>" 
                            <?= $subcategory['sub_category_id'] == $product['sub_category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($subcategory['sub_category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                    value="<?= htmlspecialchars($product['product_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($product['product_description'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image">
                <?php if (!empty($product['product_image'])): ?>
                    <div class="mt-2">
                        <p>Current image:</p>
                        <img src="<?= htmlspecialchars($target_dir . basename($product['product_image'])); ?>" 
                             alt="Current product image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="number" class="form-control" id="unit_price" name="unit_price" 
                    step="0.01" value="<?= htmlspecialchars($product['product_unit_price']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="bulk_price" class="form-label">Bulk Price</label>
                <input type="number" class="form-control" id="bulk_price" name="bulk_price" 
                    step="0.01" value="<?= htmlspecialchars($product['product_bulk_price']); ?>">
            </div>

            <!-- Options Section -->
            <h4 class="mt-4">Product Options</h4>
            <div id="options-container">
                <?php foreach ($product['options'] as $index => $option): ?>
                    <div class="option-group mb-3 border p-3">
                        <div class="mb-2">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="options[<?= $index ?>][colour]" 
                                value="<?= htmlspecialchars($option['option_colour']); ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Size</label>
                            <input type="text" class="form-control" name="options[<?= $index ?>][size]" 
                                value="<?= htmlspecialchars($option['option_size']); ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" name="options[<?= $index ?>][quantity]" 
                                value="<?= htmlspecialchars($option['stock_quantity']); ?>">
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-option">Remove Option</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary mb-3" id="add-option">Add Option</button>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="products_view.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
    // Handle category change and subcategory loading
    document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;
        fetch(`get_subcategories.php?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const subCategorySelect = document.getElementById('sub_category');
                subCategorySelect.innerHTML = '';
                data.forEach(subCategory => {
                    const option = document.createElement('option');
                    option.value = subCategory.sub_category_id;
                    option.textContent = subCategory.sub_category_name;
                    subCategorySelect.appendChild(option);
                });
            });
    });

    // Handle adding and removing options
    document.getElementById('add-option').addEventListener('click', function() {
        const container = document.getElementById('options-container');
        const index = container.children.length;
        
        const optionGroup = document.createElement('div');
        optionGroup.className = 'option-group mb-3 border p-3';
        optionGroup.innerHTML = `
            <div class="mb-2">
                <label class="form-label">Color</label>
                <input type="text" class="form-control" name="options[${index}][colour]">
            </div>
            <div class="mb-2">
                <label class="form-label">Size</label>
                <input type="text" class="form-control" name="options[${index}][size]">
            </div>
            <div class="mb-2">
                <label class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" name="options[${index}][quantity]" value="0">
            </div>
            <button type="button" class="btn btn-danger btn-sm remove-option">Remove Option</button>
        `;
        
        container.appendChild(optionGroup);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-option')) {
            e.target.closest('.option-group').remove();
        }
    });
    </script>
</body>
</html>




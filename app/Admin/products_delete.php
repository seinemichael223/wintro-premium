<?php
// First, ensure there is no whitespace or output before this opening PHP tag
ob_start(); // Start output buffering
session_start(); // Start session
require_once '../includes/dbh-inc.php';

// Define upload directory path
$upload_dir = __DIR__ . "/uploads/";

function deleteFile($filepath) {
    if (file_exists($filepath)) {
        try {
            unlink($filepath);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting file {$filepath}: " . $e->getMessage());
            return false;
        }
    }
    return false;
}

// Initialize response array
$response = [];

if (isset($_POST['product_id'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    
    if ($product_id === false) {
        $error = "Invalid product ID";
    } else {
        // Start transaction
        $pdo->beginTransaction();

        try {
            // Get the product image path
            $stmt = $pdo->prepare("SELECT product_image FROM product WHERE product_id = :product_id");
            $stmt->execute([':product_id' => $product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$product) {
                throw new Exception("Product not found");
            }

            // Delete related records in the correct order due to foreign key constraints
            $tables = ['inventory', 'options', 'product'];
            
            foreach ($tables as $table) {
                $stmt = $pdo->prepare("DELETE FROM {$table} WHERE product_id = :product_id");
                $stmt->execute([':product_id' => $product_id]);
            }

            // Handle image deletion
            if (!empty($product['product_image'])) {
                // Convert relative path to absolute path
                $image_path = $upload_dir . basename($product['product_image']);
                $thumbnail_path = $upload_dir . 'thumbnails/' . basename($product['product_image']);
                
                // Delete main image
                if (!deleteFile($image_path)) {
                    error_log("Warning: Could not delete product image: {$image_path}");
                }
                
                // Delete thumbnail if it exists
                if (!deleteFile($thumbnail_path)) {
                    error_log("Warning: Could not delete thumbnail: {$thumbnail_path}");
                }
            }

            // Commit transaction
            $pdo->commit();
            $_SESSION['success'] = "Product deleted successfully";
            $response = ['status' => 'success', 'message' => 'Product deleted successfully'];

        } catch (Exception $e) {
            // Rollback transaction
            $pdo->rollBack();
            $error = "Error deleting product: " . $e->getMessage();
            error_log($error);
            $_SESSION['error'] = $error;
            $response = ['status' => 'error', 'message' => $error];
        }
    }

    // Clear the output buffer before sending any response
    ob_clean();

    // Handle response based on request type
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        // AJAX response
        header('Content-Type: application/json');
        if (isset($error)) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $error]);
        } else {
            echo json_encode($response);
        }
        exit();
    } else {
        // Regular form submission response
        header("Location: products_view.php");
        exit();
    }
} else {
    // No product ID provided
    $_SESSION['error'] = "No product ID provided";
    header("Location: products_view.php");
    exit();
}

// End output buffering and send output
ob_end_flush();
?>
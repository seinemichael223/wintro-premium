<?php
session_start();
require_once '../includes/dbh-inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_POST['customer_id']]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "Customer deleted successfully.";
        } else {
            $_SESSION['error'] = "Customer not found.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error deleting customer. Please try again.";
        error_log("Error deleting customer: " . $e->getMessage());
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

header("Location: customers_view.php");
exit();
?>
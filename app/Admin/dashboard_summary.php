<?php
require_once '../includes/dbh-inc.php';

function getTotalSalesForCurrentMonth($pdo)
{
    $currentYear = date('Y');
    $currentMonth = date('m');

    $query = "SELECT SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE YEAR(transaction_date) = :year
              AND MONTH(transaction_date) = :month
              AND payment_status = 'SUCCESS'";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
    $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_sales'] ?? 0;
}

function getPendingOrdersCount($pdo)
{
    try {

        $query = "SELECT COUNT(*) AS pending_orders FROM orders WHERE status = 'pending'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();


        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pending_orders'] ?? 0;
    } catch (PDOException $e) {

        error_log("Error fetching pending orders: " . $e->getMessage());
        return false;
    }
}

function getOrdersCountForCurrentMonth($pdo)
{
    try {

        $currentYear = date('Y');
        $currentMonth = date('m');

        $query = "SELECT COUNT(*) AS total_orders
                  FROM orders
                  WHERE YEAR(order_date) = :year
                  AND MONTH(order_date) = :month";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
        $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_orders'] ?? 0;
    } catch (PDOException $e) {
        // Handle errors
        error_log("Error fetching orders count for the current month: " . $e->getMessage());
        return false;
    }
}

function getRegistrationsForCurrentMonth($pdo)
{
    try {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $query = "SELECT COUNT(*) AS total_registrations
                  FROM users
                  WHERE YEAR(date_created) = :year
                  AND MONTH(date_created) = :month";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
        $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_registrations'] ?? 0;
    } catch (PDOException $e) {
        error_log("Error fetching registrations count for the current month: " . $e->getMessage());
        return false;
    }
}

function getTopSellingProduct($pdo)
{
    try {
        $query = "SELECT td.product_name, SUM(td.quantity) AS total_quantity_sold
            FROM 
                transaction_details td
            GROUP BY 
                td.product_name
            ORDER BY 
                total_quantity_sold DESC
            LIMIT 1";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return [
                'product_name' => $result['product_name'],
                'total_quantity_sold' => $result['total_quantity_sold']
            ];
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Error fetching top-selling product: " . $e->getMessage());
        return false;
    }
}

function getSiteVisitsFromLogs($logFilePath)
{
    $currentMonth = date('Y-m');  // Format: 2025-01
    $visitCount = 0;

    // Check if log file exists
    if (!file_exists($logFilePath)) {
        return false; // Log file does not exist
    }

    // Open the log file
    $file = fopen($logFilePath, 'r');
    if (!$file) {
        return false; // Failed to open file
    }

    // Parse each line of the log file
    while (($line = fgets($file)) !== false) {
        // Check if the line contains the current month
        if (strpos($line, $currentMonth) !== false) {
            $visitCount++;
        }
    }

    fclose($file);
    return $visitCount;
}

function getSuccessfulTransactionCount($pdo)
{
    try {
        // Query to count successful transactions
        $query = "SELECT COUNT(*) AS successful_transactions 
                  FROM transactions 
                  WHERE payment_status = 'SUCCESS'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['successful_transactions'] ?? 0;
    } catch (PDOException $e) {
        // Log the error and return false
        error_log("Error fetching successful transaction count: " . $e->getMessage());
        return false;
    }
}

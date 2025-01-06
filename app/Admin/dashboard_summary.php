<?php
require_once '../includes/dbh-inc.php';

function getTotalSalesForCurrentMonth($pdo)
{
    // Get the current year and month
    $currentYear = date('Y');
    $currentMonth = date('m');

    // SQL Query to calculate total sales for the current month
    $query = "SELECT SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE YEAR(transaction_date) = :year
              AND MONTH(transaction_date) = :month
              AND payment_status = 'SUCCESS'";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':year', $currentYear, PDO::PARAM_INT);
    $stmt->bindParam(':month', $currentMonth, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the total sales
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_sales'] ?? 0; // Return 0 if no sales
}

// Calculate total sales for the current month
$totalSales = getTotalSalesForCurrentMonth($pdo);

<?php
require_once '../includes/dbh-inc.php';

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y'); // Default to current year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n'); // Default to current month
$week = isset($_GET['week']) ? (int)$_GET['week'] : date('W');

// Function to get daily sales
function getDailySales($pdo, $year, $month)
{
    $query = "SELECT DATE(transaction_date) AS date, SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE payment_status = 'SUCCESS'
              AND YEAR(transaction_date) = :year
              AND MONTH(transaction_date) = :month
              GROUP BY DATE(transaction_date)
              ORDER BY DATE(transaction_date)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([':year' => $year, ':month' => $month]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getWeeklySales($pdo, $year, $week)
{
    $query = "SELECT DATE(transaction_date) AS day, SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE payment_status = 'SUCCESS'
              AND YEAR(transaction_date) = :year
              AND WEEK(transaction_date, 1) = :week
              GROUP BY DATE(transaction_date)
              ORDER BY DATE(transaction_date)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':year' => $year, ':week' => $week]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get monthly sales
function getMonthlySales($pdo, $year)
{
    $query = "SELECT YEAR(transaction_date) AS year, MONTH(transaction_date) AS month, SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE payment_status = 'SUCCESS'
              AND YEAR(transaction_date) = :year
              GROUP BY YEAR(transaction_date), MONTH(transaction_date)
              ORDER BY YEAR(transaction_date) DESC, MONTH(transaction_date) DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':year' => $year]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get daily, monthly, and yearly sales data
$dailySales = getDailySales($pdo, $year, $month);
$weeklySales = getWeeklySales($pdo, $year, $week);
$monthlySales = getMonthlySales($pdo, $year);

// Return sales data as JSON for Chart.js
header('Content-Type: application/json');

// You can choose which data to return, for example, daily sales
echo json_encode(
    [
        'dailySales' => $dailySales,
        'weeklySales' => $weeklySales,
        'monthlySales' => $monthlySales
    ]


);

<?php
require_once '../includes/dbh-inc.php';

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


// Function to get monthly sales
function getMonthlySales($pdo, $year)
{
    $query = "SELECT YEAR(transaction_date) AS year, MONTH(transaction_date) AS month, SUM(payment_amount) AS total_sales
              FROM transactions
              WHERE payment_status = 'SUCCESS'
              GROUP BY YEAR(transaction_date), MONTH(transaction_date)
              ORDER BY YEAR(transaction_date) DESC, MONTH(transaction_date) DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// // Function to get weekly sales
// function getWeeklySalesByWeek($pdo, $year)
// {
//     $query = "SELECT WEEK(transaction_date) AS week, SUM(payment_amount) AS total_sales
//             FROM transactions
//             WHERE payment_status = 'SUCCESS' 
//             AND YEAR(transaction_date) = :year
//             GROUP BY WEEK(transaction_date)
//             ORDER BY WEEK(transaction_date)";
//     $stmt = $pdo->prepare($query);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }


// // Function to get yearly sales
// function getYearlySales($pdo)
// {
//     $query = "SELECT YEAR(transaction_date) AS year, SUM(payment_amount) AS total_sales
//               FROM transactions
//               WHERE payment_status = 'SUCCESS'
//               GROUP BY YEAR(transaction_date)
//               ORDER BY YEAR(transaction_date) DESC";
//     $stmt = $pdo->prepare($query);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// Get daily, monthly, and yearly sales data
// $dailySales = getDailySalesByMonth($pdo, $year, $month);
// $monthlySales = getMonthlySalesByYear($pdo, $year);
// $weeklySales = getWeeklySalesByWeek($pdo, $year);

// Return sales data as JSON for Chart.js
header('Content-Type: application/json');

// You can choose which data to return, for example, daily sales
// echo json_encode([

//     'dailySales' => $dailySales,
//     'monthlySales' => $monthlySales,
//     'weeklySales' => $weeklySales
// ]


///TESTING///
$year = 2025;
$month = 1;
$dailySales = getDailySales($pdo, $year, $month);
$monthlySales = getMonthlySales($pdo, $year);

echo "<pre>";
print_r($dailySales);
print_r($monthlySales);
echo "</pre>";


// );

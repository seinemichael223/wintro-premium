<?php
require_once '../includes/dbh-inc.php';
require('fpdf/fpdf.php');

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Fetch transactions for the year
$query = "SELECT DATE(transaction_date) AS date, payment_amount, payment_status
          FROM transactions
          WHERE YEAR(transaction_date) = :year
          ORDER BY transaction_date";
$stmt = $pdo->prepare($query);
$stmt->execute([':year' => $year]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize FPDF
// $pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(190, 10, "Transaction Report for $year", 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Date', 1);
$pdf->Cell(60, 10, 'Payment Amount', 1);
$pdf->Cell(60, 10, 'Payment Status', 1);
$pdf->Ln();

// Table rows
$pdf->SetFont('Arial', '', 12);
foreach ($transactions as $row) {
    $pdf->Cell(60, 10, $row['date'], 1);
    $pdf->Cell(60, 10, $row['payment_amount'], 1);
    $pdf->Cell(60, 10, $row['payment_status'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('D', "transaction_report_$year.pdf");

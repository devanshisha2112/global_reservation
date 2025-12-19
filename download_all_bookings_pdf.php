<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied");
}

require('../db.php');

// Load FPDF library
require('../fpdf/fpdf.php');

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'All Bookings Report',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'ID',1);
$pdf->Cell(25,10,'User ID',1);
$pdf->Cell(25,10,'Type',1);
$pdf->Cell(50,10,'Name',1);
$pdf->Cell(35,10,'Date',1);
$pdf->Cell(35,10,'Amount',1);
$pdf->Ln();

$pdf->SetFont('Arial','',11);

// Fetch all bookings
$res = $conn->query("SELECT * FROM booking ORDER BY booking_id DESC");

while ($row = $res->fetch_assoc()) {
    $pdf->Cell(20,10,$row['booking_id'],1);
    $pdf->Cell(25,10,$row['user_id'],1);
    $pdf->Cell(25,10,$row['service_type'],1);
    $pdf->Cell(50,10,$row['full_name'],1);
    $pdf->Cell(35,10,$row['booking_date'],1);
    $pdf->Cell(35,10,'₹'.$row['total_amount'],1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('D','all_bookings.pdf');
?>

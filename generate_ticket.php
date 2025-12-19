<?php
require('fpdf/fpdf.php');
include('db.php'); 

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Fetch booking details
    $sql = "SELECT * FROM booking WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        // Create PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Header
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Global Reservation Ticket', 0, 1, 'C');
        $pdf->Ln(10);

        // Booking Info
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'Booking ID:', 0, 0);
        $pdf->Cell(0, 10, $booking['booking_id'], 0, 1);

        $pdf->Cell(50, 10, 'Service Type:', 0, 0);
        $pdf->Cell(0, 10, ucfirst($booking['service_type']), 0, 1);

        $pdf->Cell(50, 10, 'Full Name:', 0, 0);
        $pdf->Cell(0, 10, $booking['full_name'], 0, 1);

        $pdf->Cell(50, 10, 'Email:', 0, 0);
        $pdf->Cell(0, 10, $booking['email'], 0, 1);

        $pdf->Cell(50, 10, 'Phone:', 0, 0);
        $pdf->Cell(0, 10, $booking['phone'], 0, 1);

        $pdf->Cell(50, 10, 'Passengers:', 0, 0);
        $pdf->Cell(0, 10, $booking['passengers'], 0, 1);

        $pdf->Cell(50, 10, 'Class:', 0, 0);
        $pdf->Cell(0, 10, ($booking['class'] ?? 'N/A'), 0, 1);

        $pdf->Cell(50, 10, 'Total Amount:', 0, 0);
        $pdf->Cell(0, 10, 'RS :  ' . $booking['total_amount'], 0, 1);

        $pdf->Cell(50, 10, 'Booking Date:', 0, 0);
        $pdf->Cell(0, 10, $booking['booking_date'], 0, 1);

        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Status: ' . $booking['status'], 0, 1);

        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Thank you for booking with Global Reservation!', 0, 1, 'C');

        // Output the PDF to download
        $pdf->Output('D', 'Ticket_' . $booking_id . '.pdf');
    } else {
        echo "No booking found for ID: $booking_id";
    }
} else {
    echo "Booking ID not provided.";
}
?>

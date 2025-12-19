<?php
session_start();
include '../db.php';

$booking_id = intval($_GET['booking_id'] ?? 0);

if (!$booking_id) {
    die("Invalid booking.");
}

$upd = $conn->prepare("UPDATE booking SET status='Paid' WHERE booking_id=? LIMIT 1");
$upd->bind_param('i', $booking_id);
$upd->execute();
$upd->close();

// redirect to confirmation page
header("Location: ../confirmation.php?booking_id=" . $booking_id);
exit;
?>

<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { header('Location: ../login1.html'); exit; }
include '../db.php';
$booking_id = intval($_POST['booking_id'] ?? 0);
$status = $_POST['status'] ?? '';
if ($booking_id && in_array($status, ['Pending','Paid','Cancelled'])) {
    $u = $conn->prepare("UPDATE booking SET status=? WHERE booking_id=?");
    $u->bind_param('si', $status, $booking_id);
    $u->execute();
}
header('Location: bookings.php');

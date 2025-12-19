<?php

// api/booking.php
session_start();
include '../db.php';

// require login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first to book.'); window.location='../login1.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../mainpage.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$service = $_POST['service'] ?? '';
$service_id = intval($_POST['service_id'] ?? 0);
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$passengers = max(1, intval($_POST['passengers'] ?? 1));
$class = trim($_POST['class'] ?? '');

if (!$service || !$service_id || !$full_name || !$email) {
    echo "<script>alert('Missing data.'); window.history.back();</script>";
    exit;
}

// get price from appropriate table
if ($service === 'flight') {
    $stmt = $conn->prepare("SELECT price FROM flights WHERE id = ? LIMIT 1");
} elseif ($service === 'train') {
    $stmt = $conn->prepare("SELECT price FROM trains WHERE id = ? LIMIT 1");
} elseif ($service === 'bus') {
    $stmt = $conn->prepare("SELECT price FROM buses WHERE id = ? LIMIT 1");
} else {
    echo "<script>alert('Invalid service type.'); window.history.back();</script>";
    exit;
}
$stmt->bind_param('i', $service_id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    echo "<script>alert('Selected service not found.'); window.history.back();</script>";
    exit;
}
$stmt->bind_result($price);
$stmt->fetch();
$stmt->close();

$total = $price * $passengers;

$ins = $conn->prepare("INSERT INTO booking (user_id, service_type, service_id, full_name, email, phone, passengers, class, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
$ins->bind_param('isissiisd', $user_id, $service, $service_id, $full_name, $email, $phone, $passengers, $class, $total);

if ($ins->execute()) {
    $booking_id = $ins->insert_id;
    header('Location: ../payment_qr.php?booking_id=' . $booking_id);
    exit;
} else {
    echo "<script>alert('Failed to create booking.'); window.history.back();</script>";
    exit;
}
?>

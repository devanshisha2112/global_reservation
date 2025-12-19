<?php
session_start();
include 'db.php';
$booking_id = intval($_GET['booking_id'] ?? 0);
if (!$booking_id) { die('Invalid booking.'); }

// fetch booking + service info (similar logic as payment)
$stmt = $conn->prepare("SELECT * FROM booking WHERE booking_id = ? LIMIT 1");
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$res = $stmt->get_result();
$bk = $res->fetch_assoc();
$stmt->close();
if (!$bk) { die('Booking not found.'); }

$service_name = $source = $dest = $date = '';
if ($bk['service_type'] === 'flight') {
    $s = $conn->prepare("SELECT flight_name AS name, source, destination, flight_date AS date FROM flights WHERE id = ? LIMIT 1");
} elseif ($bk['service_type'] === 'train') {
    $s = $conn->prepare("SELECT train_name AS name, source, destination, travel_date AS date FROM trains WHERE id = ? LIMIT 1");
} else {
    $s = $conn->prepare("SELECT bus_name AS name, source, destination, travel_date AS date FROM buses WHERE id = ? LIMIT 1");
}
$s->bind_param('i', $bk['service_id']);
$s->execute();
$r = $s->get_result();
$info = $r->fetch_assoc();
$s->close();
if ($info) {
    $service_name = $info['name'] ?? '';
    $source = $info['source'] ?? '';
    $dest = $info['destination'] ?? '';
    $date = $info['date'] ?? '';
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Booking Confirmed</title>
<style>body{font-family:Arial,sans-serif;background:#f9f9f9;color:#333}.container{max-width:700px;margin:40px auto;padding:20px;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1)}</style>
</head>
<body>
<div class="container">
  <h2>Booking Confirmed</h2>
  <p>Booking ID: <?= htmlspecialchars($bk['booking_id']) ?></p>
  <p>Service: <?= htmlspecialchars($bk['service_type']) ?></p>
  <p>Service Name: <?= htmlspecialchars($service_name) ?></p>
  <p>Route: <?= htmlspecialchars($source) ?> → <?= htmlspecialchars($dest) ?></p>
  <p>Date: <?= htmlspecialchars($date) ?></p>
  <p>Amount Paid: ₹<?= number_format($bk['total_amount'], 2) ?></p>
  <p>Status: <?= htmlspecialchars($bk['status']) ?></p>
  <p>Booking Time: <?= htmlspecialchars($bk['booking_date']) ?></p>
</div>
</body>
</html>

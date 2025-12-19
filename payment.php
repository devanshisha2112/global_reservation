<?php
// payment.php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location='login.html';</script>";
    exit;
}

$booking_id = intval($_GET['booking_id'] ?? 0);
if (!$booking_id) { die('Invalid booking.'); }

// fetch booking
$stmt = $conn->prepare("SELECT * FROM booking WHERE booking_id = ? LIMIT 1");
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$res = $stmt->get_result();
$booking = $res->fetch_assoc();
$stmt->close();

if (!$booking) { die('Booking not found.'); }
if ($booking['status'] === 'Paid') {
    header('Location: confirmation.php?booking_id=' . $booking_id);
    exit;
}

// optionally fetch service details for display
$service_name = '';
$source = $dest = $date = '';
if ($booking['service_type'] === 'flight') {
    $s = $conn->prepare("SELECT flight_name AS name, source, destination, flight_date AS date FROM flights WHERE id = ? LIMIT 1");
} elseif ($booking['service_type'] === 'train') {
    $s = $conn->prepare("SELECT train_name AS name, source, destination, travel_date AS date FROM trains WHERE id = ? LIMIT 1");
} else {
    $s = $conn->prepare("SELECT bus_name AS name, source, destination, travel_date AS date FROM buses WHERE id = ? LIMIT 1");
}
$s->bind_param('i', $booking['service_id']);
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    // demo: mark booking Paid
    $u = $conn->prepare("UPDATE booking SET status='Paid' WHERE booking_id = ? LIMIT 1");
    $u->bind_param('i', $booking_id);
    $u->execute();
    header('Location: confirmation.php?booking_id=' . $booking_id);
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payment</title>
<style>
body{font-family:Arial,sans-serif;background:#f9f9f9;color:#333}
.container{max-width:700px;margin:40px auto;padding:20px;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1)}
button{background:#1a1a1a;color:#fff;padding:12px;border:none;border-radius:6px;cursor:pointer}
</style>
</head>
<body>
<div class="container">
  <h2>Payment</h2>
  <p><strong>Service:</strong> <?= htmlspecialchars($booking['service_type']) ?></p>
  <p><strong>Name:</strong> <?= htmlspecialchars($service_name) ?></p>
  <p><strong>Route:</strong> <?= htmlspecialchars($source) ?> → <?= htmlspecialchars($dest) ?></p>
  <p><strong>Date:</strong> <?= htmlspecialchars($date) ?></p>
  <p><strong>Amount:</strong> ₹<?= number_format($booking['total_amount'],2) ?></p>

  <form method="post">
    <!-- <button name="pay" type="submit">Pay Now (Demo)</button> -->
     <button onclick="window.location.href='payment_qr.html'">Pay Now</button>

  </form>
</div>
</body>
</html>

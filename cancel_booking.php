<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "login"; exit; }
$booking_id = intval($_POST['booking_id'] ?? 0);
$uid = $_SESSION['user_id'];
if (!$booking_id) { echo "error"; exit; }

// only allow cancel if belongs to user and status is Pending
$stmt = $conn->prepare("SELECT status FROM booking WHERE booking_id=? AND user_id=? LIMIT 1");
$stmt->bind_param('ii', $booking_id, $uid);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
if (!$row) { echo "notfound"; exit; }
if ($row['status'] !== 'Pending') { echo "notallowed"; exit; }

$u = $conn->prepare("UPDATE booking SET status='Cancelled' WHERE booking_id=? LIMIT 1");
$u->bind_param('i', $booking_id);
if ($u->execute()) echo "ok"; else echo "err";
$u->close();
$conn->close();

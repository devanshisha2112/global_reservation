<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "<script>alert('Please login');window.location='../login1.html'</script>"; exit; }

$uid = $_SESSION['user_id'];
$fullname = trim($_POST['fullname'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';

if (!$fullname) { echo "<script>alert('Full name required'); window.history.back();</script>"; exit; }

if ($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET fullname=?, phone=?, password=? WHERE user_id=?");
    $stmt->bind_param('sssi', $fullname, $phone, $hash, $uid);
} else {
    $stmt = $conn->prepare("UPDATE users SET fullname=?, phone=? WHERE user_id=?");
    $stmt->bind_param('ssi', $fullname, $phone, $uid);
}
if ($stmt->execute()) {
    $_SESSION['fullname'] = $fullname; // update session name
    echo "<script>alert('Profile updated'); window.location='../profile.php';</script>";
} else {
    echo "<script>alert('Update failed'); window.history.back();</script>";
}
$stmt->close();
$conn->close();

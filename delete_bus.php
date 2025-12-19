<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: ../login1.html"); exit; }
include '../db.php';
$id = intval($_GET['id'] ?? 0);
if ($id) {
    $d = $conn->prepare("DELETE FROM buses WHERE id=?");
    $d->bind_param('i', $id);
    $d->execute();
}
header("Location: manage_buses.php");
exit;

<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: ../login1.html"); exit; }
include '../db.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: manage_buses.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['bus_name']);
    $src  = trim($_POST['source']);
    $dest = trim($_POST['destination']);
    $dep  = trim($_POST['departure_time']);
    $arr  = trim($_POST['arrival_time']);
    $date = $_POST['travel_date'];
    $price= $_POST['price'];

    $u = $conn->prepare("UPDATE buses SET bus_name=?, source=?, destination=?, departure_time=?, arrival_time=?, travel_date=?, price=? WHERE id=?");
    $u->bind_param('sssssdii', $name, $src, $dest, $dep, $arr, $date, $price, $id);
    $u->execute();
    header("Location: manage_buses.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM buses WHERE id=? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$bus = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Bus</title><link rel="stylesheet" href="admin_style.css"></head>
<body>
<header><h1>Edit Bus</h1></header>
<nav><a href="manage_buses.php">Back</a></nav>
<div class="container">
  <form method="post">
    <input name="bus_name" value="<?=htmlspecialchars($bus['bus_name'])?>" required><br>
    <input name="source" value="<?=htmlspecialchars($bus['source'])?>" required><br>
    <input name="destination" value="<?=htmlspecialchars($bus['destination'])?>" required><br>
    <input name="departure_time" value="<?=htmlspecialchars($bus['departure_time'])?>" required><br>
    <input name="arrival_time" value="<?=htmlspecialchars($bus['arrival_time'])?>" required><br>
    <input name="travel_date" type="date" value="<?=htmlspecialchars($bus['travel_date'])?>" required><br>
    <input name="price" value="<?=htmlspecialchars($bus['price'])?>" required><br>
    <button type="submit">Save</button>
  </form>
</div>
</body>
</html>

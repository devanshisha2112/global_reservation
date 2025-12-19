<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { header('Location: ../login1.html'); exit; }
include '../db.php';

$id = intval($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['flight_name']; $src = $_POST['source']; $dest = $_POST['destination'];
    $dep = $_POST['departure_time']; $arr = $_POST['arrival_time']; $date = $_POST['flight_date']; $price = $_POST['price'];
    $u = $conn->prepare("UPDATE flights SET flight_name=?, source=?, destination=?, departure_time=?, arrival_time=?, flight_date=?, price=? WHERE id=?");
    $u->bind_param('sssssdii', $name,$src,$dest,$dep,$arr,$date,$price,$id); // careful types: adjust if needed
    $u->execute();
    header('Location: manage_flights.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM flights WHERE id=? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$flight = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Flight</title><link rel="stylesheet" href="admin_style.css">
</head><body>
<h2>Edit Flight</h2>
<form method="post">
  <input name="flight_name" value="<?=htmlspecialchars($flight['flight_name'])?>" required>
  <input name="source" value="<?=htmlspecialchars($flight['source'])?>" required>
  <input name="destination" value="<?=htmlspecialchars($flight['destination'])?>" required>
  <input name="departure_time" value="<?=htmlspecialchars($flight['departure_time'])?>" required>
  <input name="arrival_time" value="<?=htmlspecialchars($flight['arrival_time'])?>" required>
  <input name="flight_date" type="date" value="<?=htmlspecialchars($flight['flight_date'])?>" required>
  <input name="price" value="<?=htmlspecialchars($flight['price'])?>" required>
  <button type="submit">Save</button>
</form>
<p><a href="manage_flights.php">Back</a></p>
</body></html>

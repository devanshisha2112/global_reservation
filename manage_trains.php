<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login1.html");
    exit;
}
include '../db.php';

// handle add train
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = trim($_POST['train_name']);
    $src  = trim($_POST['source']);
    $dest = trim($_POST['destination']);
    $dep  = trim($_POST['departure_time']);
    $arr  = trim($_POST['arrival_time']);
    $date = $_POST['travel_date'];
    $price= $_POST['price'];

    $ins = $conn->prepare("INSERT INTO trains (train_name, source, destination, departure_time, arrival_time, travel_date, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $ins->bind_param('ssssssd', $name, $src, $dest, $dep, $arr, $date, $price);
    $ins->execute();
    header("Location: manage_trains.php");
    exit;
}

// fetch trains
$res = $conn->query("SELECT * FROM trains ORDER BY travel_date DESC");
$trains = $res->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Trains - Admin</title>
<link rel="stylesheet" href="admin_style.css">
</head>
<body>
<header><h1>Manage Trains</h1></header>
<nav><a href="dashboard.php">Dashboard</a> | <a href="manage_flights.php">Flights</a> | <a href="manage_buses.php">Buses</a> | <a href="view_users.php">Users</a> | <a href="../logout.php">Logout</a></nav>

<div class="container">
  <h2>Add Train</h2>
  <form method="post">
    <input type="hidden" name="action" value="add">
    <input name="train_name" placeholder="Train name (e.g., Rajdhani Express)" required><br>
    <input name="source" placeholder="Source" required><br>
    <input name="destination" placeholder="Destination" required><br>
    <input name="departure_time" placeholder="Departure time (e.g., 09:30)" required><br>
    <input name="arrival_time" placeholder="Arrival time (e.g., 15:45)" required><br>
    <input name="travel_date" type="date" required><br>
    <input name="price" placeholder="Price" required><br>
    <button type="submit">Add Train</button>
  </form>

  <h2>Existing Trains</h2>
  <table>
    <tr><th>ID</th><th>Name</th><th>From</th><th>To</th><th>Date</th><th>Dep</th><th>Arr</th><th>Price</th><th>Action</th></tr>
    <?php foreach($trains as $t): ?>
      <tr>
        <td><?= $t['id'] ?></td>
        <td><?= htmlspecialchars($t['train_name']) ?></td>
        <td><?= htmlspecialchars($t['source']) ?></td>
        <td><?= htmlspecialchars($t['destination']) ?></td>
        <td><?= htmlspecialchars($t['travel_date']) ?></td>
        <td><?= htmlspecialchars($t['departure_time']) ?></td>
        <td><?= htmlspecialchars($t['arrival_time']) ?></td>
        <td>₹<?= number_format($t['price'],2) ?></td>
        <td>
          <a href="edit_train.php?id=<?= $t['id'] ?>">Edit</a> |
          <a href="delete_train.php?id=<?= $t['id'] ?>" onclick="return confirm('Delete this train?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>

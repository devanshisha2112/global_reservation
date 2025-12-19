<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login1.html");
    exit;
}
include '../db.php';

// add bus
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = trim($_POST['bus_name']);
    $src  = trim($_POST['source']);
    $dest = trim($_POST['destination']);
    $dep  = trim($_POST['departure_time']);
    $arr  = trim($_POST['arrival_time']);
    $date = $_POST['travel_date'];
    $price= $_POST['price'];

    $ins = $conn->prepare("INSERT INTO buses (bus_name, source, destination, departure_time, arrival_time, travel_date, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $ins->bind_param('ssssssd', $name, $src, $dest, $dep, $arr, $date, $price);
    $ins->execute();
    header("Location: manage_buses.php");
    exit;
}

// fetch buses
$res = $conn->query("SELECT * FROM buses ORDER BY travel_date DESC");
$buses = $res->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Buses - Admin</title>
<link rel="stylesheet" href="admin_style.css">
</head>
<body>
<header><h1>Manage Buses</h1></header>
<nav><a href="dashboard.php">Dashboard</a> | <a href="manage_flights.php">Flights</a> | <a href="manage_trains.php">Trains</a> | <a href="view_users.php">Users</a> | <a href="../logout.php">Logout</a></nav>

<div class="container">
  <h2>Add Bus</h2>
  <form method="post">
    <input type="hidden" name="action" value="add">
    <input name="bus_name" placeholder="Bus name / operator" required><br>
    <input name="source" placeholder="Source" required><br>
    <input name="destination" placeholder="Destination" required><br>
    <input name="departure_time" placeholder="Departure time (e.g., 08:00)" required><br>
    <input name="arrival_time" placeholder="Arrival time (e.g., 14:00)" required><br>
    <input name="travel_date" type="date" required><br>
    <input name="price" placeholder="Price" required><br>
    <button type="submit">Add Bus</button>
  </form>

  <h2>Existing Buses</h2>
  <table>
    <tr><th>ID</th><th>Name</th><th>From</th><th>To</th><th>Date</th><th>Dep</th><th>Arr</th><th>Price</th><th>Action</th></tr>
    <?php foreach($buses as $b): ?>
      <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['bus_name']) ?></td>
        <td><?= htmlspecialchars($b['source']) ?></td>
        <td><?= htmlspecialchars($b['destination']) ?></td>
        <td><?= htmlspecialchars($b['travel_date']) ?></td>
        <td><?= htmlspecialchars($b['departure_time']) ?></td>
        <td><?= htmlspecialchars($b['arrival_time']) ?></td>
        <td>₹<?= number_format($b['price'],2) ?></td>
        <td>
          <a href="edit_bus.php?id=<?= $b['id'] ?>">Edit</a> |
          <a href="delete_bus.php?id=<?= $b['id'] ?>" onclick="return confirm('Delete this bus?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>

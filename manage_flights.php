<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../login1.html');
    exit;
}
include '../db.php';

// handle add flight
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = trim($_POST['flight_name']);
    $src = trim($_POST['source']);
    $dest = trim($_POST['destination']);
    $dep = trim($_POST['departure_time']);
    $arr = trim($_POST['arrival_time']);
    $date = $_POST['flight_date'];
    $price = $_POST['price'];

    $ins = $conn->prepare("INSERT INTO flights (flight_name, source, destination, departure_time, arrival_time, flight_date, price) VALUES (?,?,?,?,?,?,?)");
    $ins->bind_param('ssssssd', $name, $src, $dest, $dep, $arr, $date, $price);
    $ins->execute();
    header('Location: manage_flights.php');
    exit;
}

// fetch flights
$res = $conn->query("SELECT * FROM flights ORDER BY flight_date DESC");
$fl = $res->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Flights</title>
  <link rel="stylesheet" href="admin_style.css">
</head>
<body>
<header><h1>Manage Flights</h1></header>
<nav>
  <a href="dashboard.php">Dashboard</a> |
  <a href="manage_trains.php">Trains</a> |
  <a href="manage_buses.php">Buses</a> |
  <a href="view_users.php">Users</a> |
  <a href="../logout.php">Logout</a>
</nav>

<div class="container">
  <div class="top-links"><a href="dashboard.php">← Back to Dashboard</a></div>

  <h2>Add Flight</h2>
  <form method="post">
    <input type="hidden" name="action" value="add">
    <input name="flight_name" placeholder="Airline / Flight name" required>
    <input name="source" placeholder="Source" required>
    <input name="destination" placeholder="Destination" required>
    <input name="departure_time" placeholder="Departure time (e.g., 09:30)" required>
    <input name="arrival_time" placeholder="Arrival time (e.g., 15:45)" required>
    <input name="flight_date" type="date" required>
    <input name="price" placeholder="Price" required>
    <button type="submit">Add Flight</button>
  </form>

  <h2>Existing Flights</h2>
  <table>
    <tr>
      <th>ID</th><th>Name</th><th>Source</th><th>Dest</th><th>Date</th><th>Price</th><th>Action</th>
    </tr>
    <?php foreach($fl as $f): ?>
      <tr>
        <td><?= $f['id'] ?></td>
        <td><?= htmlspecialchars($f['flight_name']) ?></td>
        <td><?= htmlspecialchars($f['source']) ?></td>
        <td><?= htmlspecialchars($f['destination']) ?></td>
        <td><?= htmlspecialchars($f['flight_date']) ?></td>
        <td>₹<?= number_format($f['price'],2) ?></td>
        <td class="actions">
          <a href="edit_flight.php?id=<?= $f['id'] ?>">Edit</a> |
          <a href="delete_flight.php?id=<?= $f['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<footer><p>&copy; 2025 Global Reservation System</p></footer>
</body>
</html>

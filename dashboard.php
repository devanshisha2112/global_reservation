<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../login1.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin_style.css">
</head>
<body>
  <div class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <p class="welcome">Welcome, <?= htmlspecialchars($_SESSION['fullname'] ?? 'Admin') ?>!</p>

    <div class="dashboard-grid">
      <a href="manage_flights.php" class="card">
        <h2>✈ Manage Flights</h2>
        <p>Add, Edit, or Delete flight records.</p>
      </a>

      <a href="manage_trains.php" class="card">
        <h2>🚆 Manage Trains</h2>
        <p>Add, Edit, or Delete train schedules.</p>
      </a>

      <a href="manage_buses.php" class="card">
        <h2>🚌 Manage Buses</h2>
        <p>Manage bus routes and fares.</p>
      </a>

      <a href="bookings.php" class="card">
        <h2>📖 View Bookings</h2>
        <p>View and update booking statuses.</p>
      </a>

      <a href="view_users.php" class="card">
        <h2>👤 View Users</h2>
        <p>See all registered users.</p>
      </a>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>

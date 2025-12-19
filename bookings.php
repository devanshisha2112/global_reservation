<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login1.html");
    exit;
}
include('../db.php');
$result = $conn->query("SELECT * FROM booking");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Bookings</title>
<link rel="stylesheet" href="admin_style.css">
</head>
<body>
<header>
  <h1>Manage Bookings</h1>
  <nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="view_users.php">Users</a>
    <a href="bookings.php">Bookings</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<div class="container">
  <h2>All Bookings</h2>
  <!-- ADD THIS BUTTON -->
  <a href="download_all_bookings_pdf.php" 
     style="display:inline-block;padding:10px 20px;background:black;color:white;border-radius:5px;text-decoration:none;margin-bottom:15px;">
     Download All Bookings PDF
  </a>

  <table>
    <tr>
      <th>ID</th><th>User ID</th><th>Type</th><th>Details</th><th>Date</th><th>Amount</th>
    </tr>
    <?php
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['booking_id'] . "</td>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['service_type'] . "</td>";
    echo "<td>Service ID: " . $row['service_id'] . "<br>Name: " . $row['full_name'] . "<br>Email: " . $row['email'] . "<br>Phone: " . $row['phone'] . "<br>Passengers: " . $row['passengers'] . "<br>Class: " . ($row['class'] ?? 'N/A') . "</td>";
    echo "<td>" . $row['booking_date'] . "</td>";
    echo "<td>" . $row['total_amount'] . "</td>";
    echo "</tr>";
}
?>

  </table>
</div>

<footer>
  <p>&copy; 2025 Global Reservation System</p>
</footer>
</body>
</html>




<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login1.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// ✅ Correct column names from your table
$query = $conn->prepare("SELECT booking_id, service_type, full_name, total_amount, booking_date, status 
                         FROM booking WHERE user_id = ? ORDER BY booking_date DESC");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Bookings</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; margin:0; padding:0; color:#333; }
    header {
      background-color: #1a1a1a;
      color: white;
      text-align: center;
      padding: 15px 0;
    }
    h2 { text-align:center; color:#1a1a1a; margin:30px 0; }
    table {
      width:90%; margin:20px auto; border-collapse:collapse; background:white;
      box-shadow:0 2px 8px rgba(0,0,0,0.1); border-radius:10px; overflow:hidden;
    }
    th, td { padding:12px; border-bottom:1px solid #ccc; text-align:center; }
    th { background:#1a1a1a; color:white; }
    tr:hover { background-color:#f2f2f2; }
    a.btn {
      display:block; width:200px; margin:30px auto;
      background:#1a1a1a; color:white; padding:10px;
      text-align:center; text-decoration:none; border-radius:6px;
    }
    a.btn:hover { background:#333; }
  </style>
</head>
<body>
  <header>
    <h1>Global Reservation System</h1>
  </header>

  <h2>My Bookings</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Service Type</th>
      <th>Passenger Name</th>
      <th>Amount</th>
      <th>Date</th>
      <th>Status</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
    
        <tr>
  <td><?= htmlspecialchars($row['booking_id']) ?></td>        
  <td><?= ucfirst(htmlspecialchars($row['service_type'])) ?></td>
  <td><?= htmlspecialchars($row['full_name']) ?></td>
  <td>₹<?= number_format($row['total_amount'], 2) ?></td>
  <td><?= htmlspecialchars($row['booking_date']) ?></td>
  <td><?= htmlspecialchars($row['status']) ?></td>
  <td>
    <a href="generate_ticket.php?booking_id=<?= urlencode($row['booking_id']) ?>" 
       target="_blank" 
       class="btn btn-success btn-sm">
       Download Ticket
    </a>
  </td>
</tr>

      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="6">No bookings found.</td></tr>
    <?php endif; ?>
  </table>

  <a href="mainpage.php" class="btn">Back to Home</a>
</body>
</html>

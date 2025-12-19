<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login1.html");
    exit;
}
include '../db.php';

$res = $conn->query("SELECT fullname, email, phone, role FROM users ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>All Users</title>
<style>
    body { font-family: Arial; background: #f4f7fa; color: #333; text-align: center; }
    h2 { color: #003366; }
    table { margin: 20px auto; border-collapse: collapse; width: 80%; background: white; }
    th, td { border: 1px solid #ccc; padding: 10px; }
    th { background: #003366; color: white; }
    a { text-decoration: none; color: #003366; }
</style>
</head>
<body>
<h2>All Registered Users</h2>
<p><a href="dashboard.php">← Back to Dashboard</a></p>

<table>
<tr><th>Name</th><th>Email</th><th>Phone</th><th>Role</th></tr>
<?php while($row = $res->fetch_assoc()) { ?>
<tr>
<td><?= htmlspecialchars($row['fullname']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['phone']) ?></td>
<td><?= htmlspecialchars($row['role']) ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>

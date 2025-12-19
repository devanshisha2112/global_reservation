<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login1.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// ✅ Use the correct column names (fullname, email, etc.)
$query = $conn->prepare("SELECT fullname, email FROM users WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile | Global Reservation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #1a1a1a;
        }
        p {
            font-size: 18px;
            margin: 15px 0;
        }
        a.btn {
            display: inline-block;
            margin-top: 20px;
            background: #1a1a1a;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
        }
        a.btn:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Global Reservation System</h1>
    </header>

    <div class="container">
        <h2>My Profile</h2>
        <p><strong>Full Name:</strong> <?= htmlspecialchars($user['fullname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <a href="mainpage.php" class="btn">Back to Home</a>
    </div>
</body>
</html>

<?php
include 'db.php';

$email = 'admin@global.com';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$name = 'Admin';
$role = 'admin';

// Insert admin user if not already exists
$sql = "INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $password, $role);
$stmt->execute();

echo "✅ Admin created successfully. Email: admin@global.com, Password: admin123";
?>

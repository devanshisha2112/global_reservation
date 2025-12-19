<?php
// db.php - put in project root
$host = 'localhost';
$user = 'root';
$pass = ''; // default XAMPP password is empty
$db   = 'global_reservation';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    // helpful error during development
    die(json_encode(['error' => 'DB connect failed: ' . $conn->connect_error]));
}
$conn->set_charset('utf8mb4');
?>

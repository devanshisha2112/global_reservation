<?php
include('../db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // check if user exists by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // verify password
        if (password_verify($password, $user['password'])) {
            // set session for both user and admin
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];  // ✅ important

            // check role and redirect accordingly
            if ($user['role'] === 'admin') {
                echo "<script>alert('Welcome Admin!'); window.location='../admin/dashboard.php';</script>";
            } else {
                echo "<script>alert('Login successful!'); window.location='../mainpage.php';</script>";
            }
        } else {
            echo "<script>alert('Login failed! Incorrect password.'); window.location='../login1.html';</script>";
        }
    } else {
        echo "<script>alert('Login failed! Email not found.'); window.location='../login1.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $phone    = $_POST['phone'] ?? '';

    // check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Please login instead.'); window.location='../login1.html';</script>";
        exit;
    }

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // insert new user
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login now.'); window.location='../login1.html';</script>";
    } else {
        echo "<script>alert('Registration failed! Try again.'); window.location='../regi1.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

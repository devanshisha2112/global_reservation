<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login1.html");
    exit;
}
?>
<html>
<head>
    <title>Home | Global Reservation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #fff;
            margin: 0 12px;
            text-decoration: none;
            font-size: 16px;
        }

        .user-actions {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .user-actions a {
            background: #fff;
            color: #1a1a1a;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .user-actions a:hover {
            background: #ddd;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #1a1a1a;
            margin-bottom: 20px;
        }

        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 10px 0;
            color: #1a1a1a;
        }

        .card a {
            text-decoration: none;
            color: inherit;
        }

        footer {
            background-color: #1a1a1a;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }

        footer a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <h1>Global Reservation System</h1>
        <nav>
            <a href="mainpage.php">Home</a>
            <a href="about_us.html">About Us</a>
            <a href="service.html">Services</a>
            <a href="contact_us.html">Contact</a>
        </nav>

        <div class="user-actions">
            <a href="profile.php">Profile</a>
            <a href="mybookings.php">My Bookings</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <!-- Home Content -->
    <div class="container">
        <h2>Welcome to Global Reservation System</h2>
        <p>
            Your one-stop platform for booking <strong>Flights, Trains, and Buses</strong>.
            Compare schedules, check availability, and reserve your tickets instantly with ease.
        </p>

        <div class="services">
            <div class="card">
                <a href="flights.html">
                    <img src="images/airplane-take-off.png" alt="Flights">
                    <h3>Flights</h3>
                    <p>Book domestic and international flights in just a few clicks.</p>
                </a>
            </div>

            <div class="card">
                <a href="trains.html">
                    <img src="images/train1.png" alt="Trains">
                    <h3>Trains</h3>
                    <p>Check train availability and reserve your seats easily.</p>
                </a>
            </div>

            <div class="card">
                <a href="bus.html">
                    <img src="images/bus1.png" alt="Bus">
                    <h3>Bus</h3>
                    <p>Find and book bus tickets from trusted operators nationwide.</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>
            <a href="mainpage.php">Home</a> |
            <a href="about_us.html">About Us</a> |
            <a href="contact_us.html">Contact</a> |
            <a href="service.html">Services</a>
        </div>
        <p>&copy; 2025 Global Reservation System. All rights reserved.</p>
    </footer>

</body>
</html>

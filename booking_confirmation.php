<?php
// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<link rel="stylesheet" href="thanks.css">
<body>
    <h2>Booking Confirmation</h2>
    <p>Thank you for choosing our hotel. Your booking has been confirmed.</p><br>
    <p>For Booking Details:</p>
    <!-- Display additional booking details here -->
    <p><a id="linked" href="user_dashboard.php">Return to Dashboard</a></p>
</body>
</html>

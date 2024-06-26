<?php
session_start();

// Include necessary files and database connection
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the booking_id is provided in the URL
if (!isset($_GET['booking_id'])) {
    header("Location: view_bookings.php");
    exit();
}

$booking_id = $_GET['booking_id'];

// Fetch booking details
$sqlBookingDetails = "SELECT * FROM bookings WHERE booking_id = ? AND user_id = ?";
$stmtBookingDetails = $pdo->prepare($sqlBookingDetails);

if (!$stmtBookingDetails) {
    // Handle error, for example:
    die("Error preparing statement: " . $pdo->errorInfo()[2]);
}

$stmtBookingDetails->execute([$booking_id, $_SESSION['user_id']]);
$bookingDetails = $stmtBookingDetails->fetch(PDO::FETCH_ASSOC);

// Check if the booking exists and belongs to the logged-in user
if (!$bookingDetails) {
    header("Location: view_bookings.php");
    exit();
}

// Process the cancellation request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update room availability to 'Available' for the canceled booking's room type
    $sqlUpdateAvailability = "UPDATE rooms SET status = 'Available' WHERE room_type = ? AND status = 'Unavailable'";
    $stmtUpdateAvailability = $pdo->prepare($sqlUpdateAvailability);

    if (!$stmtUpdateAvailability) {
        // Handle error, for example:
        die("Error preparing statement: " . $pdo->errorInfo()[2]);
    }

    $stmtUpdateAvailability->execute([$bookingDetails['room_type']]);

    // Redirect to view_bookings.php after cancellation
    header("Location: view_bookings.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="styleview.css">
</head>
<body>
    <h2>Cancel Booking</h2>
    <p><a id="links1" href="logout.php">Logout</a></p>
<div id="cancel">
    <!-- Display booking details -->
    <p>Room Type: <?php echo htmlspecialchars($bookingDetails['room_type']); ?></p>
    <p>Check-in Date: <?php echo htmlspecialchars($bookingDetails['checkin_date']); ?></p>
    <p>Check-out Date: <?php echo htmlspecialchars($bookingDetails['checkout_date']); ?></p>

    <p>Are you sure you want to cancel this booking?</p>

    <form method="POST" action="">
        <!-- Add a confirmation field if needed -->
        <input type="hidden" name="confirmation" value="true">
        <button id="foorm" type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')">Yes, Cancel Booking</button>
    </form>
</div>
    <p><a  id="links" href="view_bookings.php">Back to View Bookings</a></p>
    
</body>
</html>

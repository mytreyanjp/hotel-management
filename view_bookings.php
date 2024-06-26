<?php
session_start();

// Include necessary files and database connection
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user's bookings from the database
$user_id = $_SESSION['user_id'];
$sqlBookings = "SELECT * FROM bookings WHERE user_id = ?";
$stmtBookings = $pdo->prepare($sqlBookings);
$stmtBookings->execute([$user_id]);
$bookings = $stmtBookings->fetchAll(PDO::FETCH_ASSOC);

// Display recent bookings
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="styleview.css">
    
</head>

 
<body>
    <h2>Your Bookings</h2>
    <p><a id="links1" href="logout.php">Logout</a></p>
    <?php if (!empty($bookings)): ?>
        <!-- Display bookings in a table -->
        <table>
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <!-- Display booking details -->
                        <td><?php echo $booking['room_type']; ?></td>
                        <td><?php echo $booking['checkin_date']; ?></td>
                        <td><?php echo $booking['checkout_date']; ?></td>
                        <td><a href="cancel_booking.php?booking_id=<?php echo $booking['booking_id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color:white;font-size:30px">No bookings found.</p>
    <?php endif; ?>

    <p><a id="links"href="user_dashboard.php">Back to Dashboard</a></p>
    
</body>
</html>

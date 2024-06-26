<?php
session_start();

// Include necessary files and database connection
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the booking_id and room_type are provided in the URL


$booking_id = $_GET['booking_id'];
$room_type = $_GET['room_type'];

// Delete the booking record
$sqlDeleteBooking = "DELETE FROM bookings WHERE booking_id = ?";
$stmtDeleteBooking = $pdo->prepare($sqlDeleteBooking);

if (!$stmtDeleteBooking) {
    die("Error preparing DELETE statement: " . $pdo->errorInfo()[2]);
}

if (!$stmtDeleteBooking->execute([$booking_id])) {
    die("Error executing DELETE statement: " . $stmtDeleteBooking->errorInfo()[2]);
}

// Update room availability for one room of that type
$sqlUpdateAvailability = "UPDATE rooms
SET status = 'Available'
WHERE room_type = ? AND status = 'Unavailable'
AND room_id = (
    SELECT room_id
    FROM rooms
    WHERE room_type = ? AND status = 'Unavailable'
    LIMIT 1
)
";
$stmtUpdateAvailability = $pdo->prepare($sqlUpdateAvailability);

if (!$stmtUpdateAvailability) {
    die("Error preparing UPDATE statement: " . $pdo->errorInfo()[2]);
}

if (!$stmtUpdateAvailability->execute([$room_type,$room_type])) {
    die("Error executing UPDATE statement: " . $stmtUpdateAvailability->errorInfo()[2]);
}

// Redirect back to adminhome.php after deletion
header("Location: adminhome.php");
exit();
?>

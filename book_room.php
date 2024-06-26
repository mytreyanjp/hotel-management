<?php
// Include the database connection file
include 'db_connection.php';

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Initialize the alert message
$alertMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $guests = $_POST['guests'];
    $room_type = $_POST['room_type'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $include_breakfast = isset($_POST['include_breakfast']) ? 1 : 0;

    // Check room availability
    $sqlCheckAvailability = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE room_type = ? AND status = 'Available' 
                            ";
    
    $stmtCheckAvailability = $pdo->prepare($sqlCheckAvailability);
    $stmtCheckAvailability->execute([$room_type]);
    $availabilityResult = $stmtCheckAvailability->fetch(PDO::FETCH_ASSOC);

    // If there are available rooms, proceed with the booking
    if ($availabilityResult['available_rooms'] > 0) {
        // Insert booking into the database
        $sqlInsertBooking = "INSERT INTO bookings (user_id, guests, room_type, checkin_date, checkout_date, include_breakfast) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertBooking = $pdo->prepare($sqlInsertBooking);
        $stmtInsertBooking->execute([$user_id, $guests, $room_type, $checkin_date, $checkout_date, $include_breakfast]);

        // Check if the booking was successful
        if ($stmtInsertBooking->rowCount() > 0) {
            // Update room availability to 'Unavailable'
            $sqlUpdateAvailability = "UPDATE rooms SET status = 'Unavailable' WHERE room_type = ? AND room_id = (
                                        SELECT room_id FROM rooms 
                                        WHERE room_type = ? AND status = 'Available' 
                                        ORDER BY room_id ASC 
                                        LIMIT 1
                                    )";
            $stmtUpdateAvailability = $pdo->prepare($sqlUpdateAvailability);
            $stmtUpdateAvailability->execute([$room_type, $room_type]);

            // Redirect to the confirmation page
            header("Location: booking_confirmation.php");
            exit();
        } else {
            $alertMessage = "Booking failed. Please try again.";
        }
    } else {
        $alertMessage = "No available rooms of type '$room_type' for the selected dates.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Add your stylesheets and other head content here -->
    <script type="text/javascript">
        // JavaScript code to display the alert and redirect
        <?php if (!empty($alertMessage)) : ?>
            alert("<?php echo $alertMessage; ?>");
            window.history.back();
        <?php endif; ?>
    </script>
</head>
<body>
    <!-- Your existing HTML body content -->
</body>
</html>

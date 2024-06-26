<?php
include 'db_connection.php';

session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $guests = $_POST['guests'];
    $room_type = $_POST['room_type'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $include_breakfast = isset($_POST['include_breakfast']) ? 1 : 0;

    // Check room availability
    $sqlCheckAvailability = "SELECT * FROM rooms WHERE room_type = ? AND room_id NOT IN (SELECT room_id FROM bookings WHERE 
                             (checkin_date BETWEEN ? AND ? OR checkout_date BETWEEN ? AND ?) AND status = 'confirmed')";
    $stmtCheckAvailability = $pdo->prepare($sqlCheckAvailability);
    $stmtCheckAvailability->execute([$room_type, $checkin_date, $checkout_date, $checkin_date, $checkout_date]);
    $availableRooms = $stmtCheckAvailability->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($availableRooms)) {
        // Book the room
        $selectedRoom = $availableRooms[0]; // For simplicity, select the first available room
        $room_id = $selectedRoom['room_id'];

        $sqlBookRoom = "INSERT INTO bookings (user_id, room_id, guests, room_type, checkin_date, checkout_date, 
                        include_breakfast, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'confirmed')";
        $stmtBookRoom = $pdo->prepare($sqlBookRoom);
        $stmtBookRoom->execute([$user_id, $room_id, $guests, $room_type, $checkin_date, $checkout_date, $include_breakfast]);

        echo "Booking successful!";
    } else {
        echo "No available rooms for the selected dates and room type.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book a Room</title>
</head>
<body>
    <div class="container">
        <h1>Book a Room</h1>
        <form action="book_room.php" method="post">
            <label for="guests">Number of Guests:</label>
            <input type="number" id="guests" name="guests" required>

            <label for="room_type">Room Type:</label>
            <select name="room_type" required>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Twin">Twin</option>
                <option value="Suite">Suite</option>
            </select>

            <label for="checkin_date">Check-in Date:</label>
            <input type="date" id="checkin_date" name="checkin_date" required>

            <label for="checkout_date">Check-out Date:</label>
            <input type="date" id="checkout_date" name="checkout_date" required>

            <label for="include_breakfast">Include Breakfast:</label>
            <input type="checkbox" name="include_breakfast" value="1">

            <button type="submit">Book Now</button>
        </form>

        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>

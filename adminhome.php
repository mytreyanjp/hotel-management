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
  <title>Manager Dashboard</title>

  <link rel="stylesheet" href="stylesdash.css">
</head>
<body>
  <h2>Welcome Mr. <?php echo $_SESSION['username']; ?></h2>

  <h3> Continental's Reservations:</h3>

  <?php
  // Include the database connection file
  include 'db_connection.php';

  // Fetch all bookings with user information using a join
  $sqlAllBookings = "SELECT bookings.*, users.username 
                    FROM bookings
                    JOIN users ON bookings.user_id = users.user_id
                    ORDER BY bookings.created_at DESC";

  $stmtAllBookings = $pdo->prepare($sqlAllBookings);
  $stmtAllBookings->execute();
  $allBookings = $stmtAllBookings->fetchAll(PDO::FETCH_ASSOC);

  if ($allBookings) {
    echo "<ul class='bookings' style='width:90%';>  <div class='overlay'></div> <div class='end'>";
    foreach ($allBookings as $booking) {
      $checkinDate = new DateTime($booking['checkin_date']);
      $checkoutDate = new DateTime($booking['checkout_date']);
      $dateDifference = $checkinDate->diff($checkoutDate)->days;

      $roomType = $booking['room_type'];
      $roomCost = getRoomCost($roomType);
      $totalCost = $dateDifference * $roomCost;

      echo "<li>{$booking['username']} - {$booking['room_type']} - Check-in: {$booking['checkin_date']} - Check-out: {$booking['checkout_date']} | Stay: {$dateDifference} days - Cost: ₹ {$totalCost} - 
            <a href='delete_booking.php?booking_id={$booking['booking_id']}&room_type={$roomType}' style='color: inherit;'>Remove Booking</a></li>";
    }
    echo "</div></ul>";
  } else {
    echo "<p style='color:white;font-size:30px'>No bookings available.</p>";
  }

  function getRoomCost($roomType) {
    $roomCosts = [
      'Single' => 500,
      'Double' => 1000,
      'Twin'   => 1200,
      'Suite'  => 2000
    ];

    return isset($roomCosts[$roomType]) ? $roomCosts[$roomType] : 0;
  }
  ?>
<div id="link">
  <p ><a id="links" href="logout.php" >Logout</a></p>
</div>
</body>
</html>

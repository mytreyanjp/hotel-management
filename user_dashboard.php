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
  <title>User Dashboard</title>

  <link rel="stylesheet" href="stylesdash.css">
</head>

<body>
  <h2>Welcome to Dashboard </h2><h2 id="session"><?php echo $_SESSION['username']; ?></h2>

  <h3>Not have a good Day, Have a Great Day !!</h3>

<div id="link">
    <a id="links" href="index.php">Book a Room</a>
    <a id="links1" href="view_bookings.php">View Your Bookings</a>
</div>
  <?php
  // Include the database connection file
  include 'db_connection.php';

  // Fetch recent bookings for the user
  $user_id = $_SESSION['user_id'];
  $sqlRecentBookings = "SELECT * FROM bookings WHERE user_id = ? ORDER BY created_at DESC LIMIT 5";
  $stmtRecentBookings = $pdo->prepare($sqlRecentBookings);
  $stmtRecentBookings->execute([$user_id]);
  $recentBookings = $stmtRecentBookings->fetchAll(PDO::FETCH_ASSOC);


  if ($recentBookings) {
    echo "<ul class='bookings'>  <div class='overlay'></div> <div class='end'>";
    foreach ($recentBookings as $booking) {
      $checkinDate = new DateTime($booking['checkin_date']);
        $checkoutDate = new DateTime($booking['checkout_date']);
        $dateDifference = $checkinDate->diff($checkoutDate)->days;

       
        $roomType = $booking['room_type'];
        $roomCost = getRoomCost($roomType);
        $totalCost = $dateDifference * $roomCost;

        echo "<li>{$booking['room_type']} - Check-in: {$booking['checkin_date']} - Check-out: {$booking['checkout_date']} | Stay: {$dateDifference} days - Cost: ₹ {$totalCost}</li>";
    }
    echo "</div></ul>";
  } else {
    echo "<p style='color:white;font-size:30px'>No recent bookings.</p>";
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

  <p ><a class="logout" href="logout.php" style='  margin-top:-400px;'>Logout</a></p>
</body>
</html>

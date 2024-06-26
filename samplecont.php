<?php
// Establish the PostgreSQL database connection
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '1qaz@WSX';

// Create connection
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check connection
if (!$conn) {
    die("Connection failed");
}

// Process the room booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer_name"])) {
    $customer_name = $_POST["customer_name"];
    $check_in_date = $_POST["check_in_date"];
    $check_out_date = $_POST["check_out_date"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO room_bookings (customer_name, check_in_date, check_out_date) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $customer_name);
    $stmt->bindParam(2, $check_in_date);
    $stmt->bindParam(3, $check_out_date);

    if ($stmt->execute()) {
        echo "Room booked successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt->closeCursor();
}

// Close the database connection
$conn = null;
?>

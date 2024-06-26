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

// Process the customer registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer_name"])) {
    $customer_name = $_POST["customer_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $stmt = $conn->prepare("INSERT INTO customers (customer_name, email, phone) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $customer_name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);

    if ($stmt->execute()) {
        echo "Customer registered successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt->closeCursor();
}

// Close the database connection
$conn = null;
?>
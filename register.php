<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        // Passwords do not match, show an alert
        echo "<script>alert('Passwords do not match. Please re-enter your password.');</script>";
    } elseif (strlen($password) < 8) {
        // Password is too short, show an alert
        echo "<script>alert('Password should be at least 8 characters long.');</script>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if username is already in use
        $sqlCheckUsername = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmtCheckUsername = $pdo->prepare($sqlCheckUsername);
        $stmtCheckUsername->execute([$username]);
        $usernameExists = $stmtCheckUsername->fetchColumn();

        // Check if email is already in use
        $sqlCheckEmail = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmtCheckEmail = $pdo->prepare($sqlCheckEmail);
        $stmtCheckEmail->execute([$email]);
        $emailExists = $stmtCheckEmail->fetchColumn();

        if ($usernameExists || $emailExists) {
            // Username or email already exists, show an alert
            echo "<script>alert('Username or email already in use. Please choose a different one.');</script>";
        } else {
            // Insert new user
            $sqlInsertUser = "INSERT INTO users (username, password_hash, full_name, email) VALUES (?, ?, ?, ?)";
            $stmtInsertUser = $pdo->prepare($sqlInsertUser);
            $stmtInsertUser->execute([$username, $hashedPassword, $fullName, $email]);

            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylelogin.css">
    <title>Sign Up</title>
    <style>
        .password-container {
            position: relative;
            font-size:20px;
            width: 100%;
            margin-left:-20px;
            text-align:center;
            font-size:25px;
        }

        .password-icon {
            position: absolute;
            top: 50%;
            right:1px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1 id="ww">Create your account in Continental</h1>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password" class="password-container">
                Password:
                <input style="width:100%;" type="password" id="password" name="password" required>
                <i class="password-icon" onclick="togglePassword('password')">👁</i>
            </label>

            <label for="confirmPassword" class="password-container">
                Confirm Password:
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <i class="password-icon" onclick="togglePassword('confirmPassword')">👁</i>
            </label>

            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="login.php">Sign In</a></p>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>

<?php
include 'db_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlFetchUser = "SELECT * FROM users WHERE username = ?";
    $stmtFetchUser = $pdo->prepare($sqlFetchUser);
    $stmtFetchUser->execute([$username]);
    $user = $stmtFetchUser->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] === 'user') {
            header("Location: index.php");
            exit();
        } elseif ($user['role'] === 'admin') {
            header("Location: adminhome.php");
            exit();
        }
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign In</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <div class="container">
        <h1 id="ww">Welcome to</h1>
        <h1 id="ww1">Continental</h1>
        <h1>Sign In</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign In</button>
        </form>

        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</body>
</html>

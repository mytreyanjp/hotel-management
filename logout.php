<?php
// Start a session
session_start();

// Destroy the session data
session_destroy();

// Redirect to the login page or any other appropriate page
header("Location: login.php");
exit();
?>

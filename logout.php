<?php
// Start or resume the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session data on the server
session_destroy();

// Redirect the user to a logout or login page
header("Location: login.php"); // Change "login.php" to your desired logout or login page
exit();
?>
<?php
$servername = "localhost"; // Replace with your MySQL server hostname or IP address
$db_username = "dbusername"; // Replace with your MySQL username
$db_password = "dbpass"; // Replace with your MySQL password
$database = "insecure_weblog"; // Replace with the name of your MySQL database
$backupPath = "path";

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 //echo "Connected successfully";
?>
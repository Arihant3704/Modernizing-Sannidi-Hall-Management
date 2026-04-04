<?php
// Database configuration
$host = "localhost";
$user = "sannidi_user";
$password = "sannidi123";
$dbname = "sannidi_hall";

// Create connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());
    die("Database connection failed. Please contact administrator.");
}

// Set charset to utf8mb4 for better character support
mysqli_set_charset($conn, "utf8mb4");
?>

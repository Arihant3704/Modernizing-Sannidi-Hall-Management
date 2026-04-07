<?php
// Database configuration
// Fallback to local credentials if no environment variables are set
$host     = getenv('DB_HOST') ?: "localhost";
$user     = getenv('DB_USER') ?: "sannidi_user";
$password = getenv('DB_PASSWORD') ?: "sannidi123";
$dbname   = getenv('DB_NAME') ?: "sannidi_hall";
$port     = getenv('DB_PORT') ?: "3306";

// Create connection
$conn = mysqli_connect($host, $user, $password, $dbname, $port);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());
    die("Database connection failed. Please contact administrator.");
}

// Set charset to utf8mb4 for better character support
mysqli_set_charset($conn, "utf8mb4");
?>

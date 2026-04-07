<?php
// Database configuration
// On Vercel, we MUST have environment variables set.
$host     = getenv('DB_HOST');
$user     = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname   = getenv('DB_NAME');
$port     = getenv('DB_PORT') ?: "3306";

// If missing crucial variables, and we aren't local, show error
if (!$host && (getenv('VERCEL') || getenv('NOW_REGION'))) {
    die("Deployment Error: Database environment variables (DB_HOST, etc.) are NOT configured in the Vercel Dashboard. Please check VERCEL_DEPLOYMENT.md for instructions.");
}

// Fallback for local development if not in production
$host     = $host ?: "localhost";
$user     = $user ?: "sannidi_user";
$password = $password ?: "sannidi123";
$dbname   = $dbname ?: "sannidi_hall";

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

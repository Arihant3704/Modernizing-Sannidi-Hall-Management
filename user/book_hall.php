<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$message = "";
if(isset($_POST['book'])) {
    $hall_id = $_POST['hall_id'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    if(!empty($hall_id) && !empty($date)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO booking (user_id, hall_id, booking_date, status) VALUES (?, ?, ?, 'pending')");
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $hall_id, $date);
        
        if(mysqli_stmt_execute($stmt)) {
            $message = "<div style='color: #2e7d32; background: #e8f5e9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Booking request submitted successfully! We will review and contact you soon.</div>";
        } else {
            $message = "<div style='color: #c62828; background: #ffebee; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Error submitting booking. Please try again.</div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "<div style='color: #c62828; background: #ffebee; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Please fill in all fields.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Hall - Sannidi Hall</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .booking-container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall</div>
    <div class="nav-links">
        <a href="user_dashboard.php">Dashboard</a>
        <a href="booking_history.php">My Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="booking-container">
    <div class="glass-card">
        <h2 style="margin-bottom: 1rem; color: var(--primary-color);">Reserve Your Venue</h2>
        <p style="color: var(--text-muted); margin-bottom: 2.5rem;">Select your preferred hall and date to begin your reservation request.</p>

        <?php echo $message; ?>

        <form method="POST">
            <div class="form-group">
                <label for="hall_id">Select Hall</label>
                <select name="hall_id" id="hall_id" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                    <option value="">-- Choose a Hall --</option>
                    <?php
                    $halls = mysqli_query($conn, "SELECT id, hall_name, price FROM halls");
                    while($row = mysqli_fetch_assoc($halls)) {
                        echo "<option value='".$row['id']."'>".$row['hall_name']." (₹".number_format($row['price'])."/day)</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Event Date</label>
                <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div style="margin-top: 2rem;">
                <button name="book" class="btn-primary w-100" style="width: 100%;">Submit Reservation Request</button>
                <a href="user_dashboard.php" style="display: block; text-align: center; margin-top: 1.5rem; color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">&larr; Cancel and return to Dashboard</a>
            </div>
        </form>
    </div>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>

<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include(__DIR__ . '/../includes/db.php');

$total_users = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$total_bookings = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM booking"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM booking WHERE status='pending'"));
$approved = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM booking WHERE status='approved'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sannidi Hall</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }
        .dash-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: var(--shadow-soft);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .dash-card:hover {
            transform: translateY(-5px);
        }
        .dash-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 1rem 0;
        }
        .nav-links a.active {
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall Admin</div>
    <div class="nav-links">
        <a href="admin_dashboard.php" class="active">Dashboard</a>
        <a href="manage_halls.php">Manage Halls</a>
        <a href="view_booking.php">Manage Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="dashboard-container">
    <h1 style="margin-bottom: 2rem; color: var(--secondary-color);">Administrator Dashboard</h1>

    <div class="dash-grid">
        <div class="dash-card">
            <h3 style="color: var(--text-muted);">Total Users</h3>
            <div class="stat-number"><?php echo $total_users; ?></div>
        </div>
        <div class="dash-card">
            <h3 style="color: var(--text-muted);">Total Bookings</h3>
            <div class="stat-number"><?php echo $total_bookings; ?></div>
        </div>
        <div class="dash-card">
            <h3 style="color: var(--text-muted);">Pending Requests</h3>
            <div class="stat-number" style="color: #f57f17;"><?php echo $pending; ?></div>
        </div>
        <div class="dash-card">
            <h3 style="color: var(--text-muted);">Approved Bookings</h3>
            <div class="stat-number" style="color: #2e7d32;"><?php echo $approved; ?></div>
        </div>
    </div>

    <div style="text-align: center;">
        <a href="view_booking.php" class="btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">Review Pending Bookings</a>
    </div>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>
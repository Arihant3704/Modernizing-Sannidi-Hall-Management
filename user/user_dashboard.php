<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Sannidi Hall</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }
        .welcome-section {
            margin-bottom: 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dash-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .dash-card:hover {
            transform: translateY(-5px);
        }
        .dash-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        .icon-box {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall</div>
    <div class="nav-links">
        <a href="user_dashboard.php" style="color: var(--primary-color);">Dashboard</a>
        <a href="booking_history.php">My Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="dashboard-container">
    <div class="welcome-section">
        <div>
            <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
            <p style="color: var(--text-muted);">Manage your bookings and explore our premium event spaces.</p>
        </div>
        <img src="../assets/images/hero.png" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color);">
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div>
                <div class="icon-box">📅</div>
                <h3>Calendar</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 1rem 0 2rem;">Check hall availability for your preferred dates.</p>
            </div>
            <a href="calender.php" class="btn-outline">View Availability</a>
        </div>

        <div class="dash-card">
            <div>
                <div class="icon-box">✨</div>
                <h3>Book a Hall</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 1rem 0 2rem;">Ready to host? Choose your ideal space and reserve it.</p>
            </div>
            <a href="book_hall.php" class="btn-primary">Start Booking</a>
        </div>

        <div class="dash-card">
            <div>
                <div class="icon-box">📜</div>
                <h3>My History</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 1rem 0 2rem;">Track your past and upcoming booking requests.</p>
            </div>
            <a href="booking_history.php" class="btn-outline">View History</a>
        </div>

        <div class="dash-card">
            <div>
                <div class="icon-box">🖼️</div>
                <h3>Gallery</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 1rem 0 2rem;">Browse high-quality images of our venues.</p>
            </div>
            <a href="../gallery.php" class="btn-outline">View Gallery</a>
        </div>
    </div>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>

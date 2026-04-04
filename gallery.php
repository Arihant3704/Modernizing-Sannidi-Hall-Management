<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Sannidi Hall</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .gallery-container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: transform 0.3s ease;
            position: relative;
        }
        .gallery-item:hover {
            transform: scale(1.03);
            z-index: 10;
        }
        .gallery-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }
        .gallery-caption {
            padding: 1rem;
            background: white;
            text-align: center;
            font-weight: 500;
            color: var(--secondary-color);
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall</div>
    <div class="nav-links">
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="admin/admin_dashboard.php">Dashboard</a>
        <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
            <a href="user/user_dashboard.php">Dashboard</a>
        <?php else: ?>
            <a href="index.php">Home</a>
        <?php endif; ?>
        <a href="gallery.php" style="color: var(--primary-color);">Gallery</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Login</a>
        <?php endif; ?>
    </div>
</nav>

<div class="gallery-container">
    <div style="text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--secondary-color);">Our Premium Venues</h2>
        <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Explore the luxurious settings we offer for your special events. From grand ballrooms to intimate meeting spaces.</p>
    </div>

    <div class="gallery-grid">
        <div class="gallery-item">
            <img src="assets/images/real_1.png" alt="Grand Entrance" class="gallery-img">
            <div class="gallery-caption">Sannidhi Hall Grand Entrance</div>
        </div>
        <div class="gallery-item">
            <img src="assets/images/real_2.png" alt="Lobby Area" class="gallery-img">
            <div class="gallery-caption">Spacious Lobby & Reception Area</div>
        </div>
        <div class="gallery-item">
            <img src="assets/images/real_3.png" alt="Main Auditorium" class="gallery-img">
            <div class="gallery-caption">Main Auditorium Overview</div>
        </div>
        <div class="gallery-item">
            <img src="assets/images/real_4.png" alt="Stage View" class="gallery-img">
            <div class="gallery-caption">Elegant Stage Front</div>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 4rem;">
        <a href="user/book_hall.php" class="btn-primary" style="font-size: 1.1rem; padding: 1rem 2.5rem;">Book Your Venue Now</a>
    </div>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>
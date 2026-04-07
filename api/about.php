<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sannidi Hall</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .about-container {
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        .about-section {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-soft);
        }
        .about-section h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        .about-section p {
            color: var(--text-muted);
            margin-bottom: 1rem;
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .about-list {
            list-style: none;
            padding: 0;
            margin-top: 1.5rem;
        }
        .about-list li {
            padding-left: 2rem;
            position: relative;
            margin-bottom: 1rem;
            color: var(--text-main);
            font-weight: 500;
        }
        .about-list li::before {
            content: '✓';
            color: var(--primary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .team-member {
            text-align: center;
            padding: 2rem;
            background: var(--bg-color);
            border-radius: 12px;
            transition: transform 0.3s;
        }
        .team-member:hover {
            transform: translateY(-5px);
        }
        .team-member h4 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        .team-member span {
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="about.php" style="color: var(--primary-color);">About</a>
        <a href="gallery.php">Gallery</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="user/user_dashboard.php">Dashboard</a>
            <a href="includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-outline" style="padding: 0.5rem 1rem; margin-left: 1rem;">Login</a>
        <?php endif; ?>
    </div>
</nav>

<header class="hero" style="height: 40vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/about_profile.jpg'); background-size: cover; background-position: center 20%; flex-direction: column;">
    <h1>About Our Heritage</h1>
    <p>Creating unforgettable memories since 2010.</p>
</header>

<div class="about-container">
    <div class="about-section">
        <h2>Our Story</h2>
        <p>Founded in 2010, our wedding hall booking system was born out of a passion for creating unforgettable wedding experiences. We understand that finding the perfect venue is the first step in creating your dream wedding.</p>
        <p>What started as a small local service has grown into the region's most trusted wedding venue platform, helping over 5,000 couples find their perfect venue each year.</p>
    </div>

    <div class="about-section">
        <h2>Our Mission</h2>
        <p>We believe every couple deserves a stress-free wedding planning experience. Our mission is to connect you with the perfect wedding venue that matches your vision, style, and budget.</p>
        <ul class="about-list">
            <li>Curated selection of premium venues</li>
            <li>Transparent pricing with no hidden fees</li>
            <li>Personalized venue recommendations</li>
            <li>Dedicated support throughout your journey</li>
        </ul>
    </div>

    <div class="about-section">
        <h2>Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-member">
                <h4>SHRAVAN HEGDE</h4>
                <span>Founder & CEO</span>
            </div>
            <div class="team-member">
                <h4>HARSHIT GOUDA</h4>
                <span>Venue Relations</span>
            </div>
            <div class="team-member">
                <h4>CHARAN SHETRU</h4>
                <span>Customer Experience</span>
            </div>
        </div>
    </div>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>
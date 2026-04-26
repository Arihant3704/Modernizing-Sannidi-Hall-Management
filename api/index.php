<?php 
session_start();
include __DIR__ . '/includes/db.php'; 
// Fetch halls from database
$halls_query = "SELECT * FROM halls LIMIT 3";
$halls_result = mysqli_query($conn, $halls_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sannidi Hall - Premium Event Spaces</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

<nav>
    <div class="logo" style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">Sannidi Hall</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="gallery.php">Gallery</a>
        <a href="login.php" class="btn-outline" style="padding: 0.5rem 1rem; margin-left: 1rem;">Login</a>
        <a href="register.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Register</a>
    </div>
</nav>

<header class="hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/images/hero.png'); background-size: cover; background-position: center;">
    <div>
        <h1>Experience Grandeur</h1>
        <p>From intimate gatherings to royal weddings, find the perfect space for your most cherished moments.</p>
        <div style="margin-top: 2.5rem;">
            <a href="register.php" class="btn-primary">Book Your Event</a>
            <a href="#halls" class="btn-outline" style="margin-left: 1rem; color: white; border-color: white;">Explore Halls</a>
        </div>
    </div>
</header>

<section id="about_preview" style="background: white; padding: 5rem 2rem;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 4rem; align-items: center;">
        <div>
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: var(--secondary-color);">We Build <span style="color: var(--primary-color);">Memories</span></h2>
            <p style="color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem; font-size: 1.1rem;">
                Founded in 2010, Sannidi Hall was born out of a passion for creating unforgettable wedding and event experiences. We believe that discovering the perfect venue should be the most magical step of your journey.
            </p>
            <a href="about.php" class="btn-outline">Read Our Full Story &rarr;</a>
        </div>
        <div style="position: relative;">
            <img src="assets/images/about_profile.jpg" alt="About Us Profile" style="width: 100%; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); object-fit: cover; height: 400px;">
            <div style="position: absolute; bottom: -20px; left: -20px; background: var(--primary-color); color: white; padding: 1.5rem; border-radius: 12px; font-weight: bold; font-size: 1.2rem; box-shadow: 0 10px 20px rgba(212,175,55,0.3);">
                Over 5,000+<br><small style="font-weight: normal; font-size: 0.9rem;">Couples Hosted</small>
            </div>
        </div>
    </div>
</section>

<section id="halls" class="container" style="padding: 5rem 2rem; max-width: 1200px; margin: 0 auto;">
    <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 1rem;">Our Signature Spaces</h2>
    <p style="text-align: center; color: var(--text-muted); margin-bottom: 4rem;">Meticulously designed for comfort and elegance.</p>

    <div class="hall-grid">
        <?php if (mysqli_num_rows($halls_result) > 0): ?>
            <?php while($hall = mysqli_fetch_assoc($halls_result)): ?>
                <div class="hall-card">
                    <div class="hall-img" style="background-image: url('assets/images/hero.png');"></div> <!-- Placeholder using hero image -->
                    <div class="hall-content">
                        <div class="hall-brand" style="color: var(--primary-color); font-weight: 600; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 0.5rem;">Luxury Venue</div>
                        <h3 style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($hall['hall_name']); ?></h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($hall['description']); ?></p>
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; pt: 1rem; margin-top: 1rem; padding-top: 1rem;">
                            <span class="hall-price">₹<?php echo number_format($hall['price']); ?> <small style="font-weight: 400; font-size: 0.8rem; color: var(--text-muted);">/ day</small></span>
                            <a href="login.php" style="color: var(--primary-color); text-decoration: none; font-weight: 600; font-size: 0.9rem;">View Details &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; grid-column: 1/-1;">No halls available at the moment. Please check back later.</p>
        <?php endif; ?>
    </div>
</section>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center;">
    <div style="color: white; font-weight: 700; margin-bottom: 1rem;">Sannidi Hall Management</div>
    <p style="font-size: 0.9rem; margin-bottom: 2rem;">Creating unforgettable memories since 2024.</p>
    <div style="border-top: 1px solid #444; padding-top: 2rem; font-size: 0.8rem;">
        &copy; 2024 Sannidi Hall. All rights reserved.
    </div>
</footer>

</body>
</html>
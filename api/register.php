<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sannidi Hall Management</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1a1a1a 100%);
        }
        .container {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="glass-card">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--primary-color);">Create Account</h2>
        
        <form method="post" action="register.php" autocomplete="off">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required title="Please enter a valid email address">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="10-digit number" pattern="[0-9]{10}" required title="Please enter exactly 10 digits">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 7 characters" minlength="7" required>
            </div>

            <button type="submit" name="submit" class="btn-primary w-100" style="width: 100%;">Register Now</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Already have an account? <a href="login.php" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Log In</a>
            </p>
            <a href="index.php" style="display: block; margin-top: 1rem; color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">&larr; Back to Home</a>
        </div>
    </div>
</div>

<?php
include(__DIR__ . '/includes/db.php');

if(isset($_POST['submit'])) {
    $user_name = $_POST['name'];
    $mob = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Secure password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Using prepared statement for security
    $stmt = mysqli_prepare($conn, "INSERT INTO users (user_name, mob, email, password, role) VALUES (?, ?, ?, ?, 'user')");
    mysqli_stmt_bind_param($stmt, "ssss", $user_name, $mob, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration Successful! Please login.'); window.location='login.php';</script>";
    } else {
        $error = mysqli_stmt_error($stmt);
        if (strpos($error, 'Duplicate entry') !== false) {
            echo "<script>alert('Error: Email already registered.');</script>";
        } else {
            echo "<script>alert('Registration Error. Please try again.');</script>";
        }
    }
    mysqli_stmt_close($stmt);
}
?>
</body>
</html>

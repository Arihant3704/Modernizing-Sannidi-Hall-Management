<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sannidi Hall Management</title>
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
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--primary-color);">Welcome Back</h2>
        
        <form action="includes/login_check.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-primary w-100" style="width: 100%;">Sign In</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Don't have an account? <a href="register.php" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Register</a>
            </p>
            <a href="index.php" style="display: block; margin-top: 1rem; color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">&larr; Back to Home</a>
        </div>
    </div>
</div>

</body>
</html>

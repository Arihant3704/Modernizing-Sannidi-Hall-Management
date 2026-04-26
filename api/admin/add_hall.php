<?php
session_start();
include __DIR__ . '/../includes/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

if(isset($_POST['submit_hall'])) {
    $name = $_POST['hall_name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    $stmt = mysqli_prepare($conn, "INSERT INTO halls (hall_name, location, capacity, price, description) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssiss", $name, $location, $capacity, $price, $desc);
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: manage_halls.php");
        exit();
    } else {
        $message = "<div style='color: #c62828; background: #ffebee; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Error creating hall.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Hall - Admin</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style> .container { max-width: 600px; margin: 4rem auto; padding: 0 2rem; } </style>
</head>
<body>

<nav>
    <div class="logo">Sannidi Hall Admin</div>
    <div class="nav-links">
        <a href="manage_halls.php" style="color: var(--primary-color);">&larr; Back to Halls</a>
    </div>
</nav>

<div class="container">
    <div class="glass-card">
        <h2 style="margin-bottom: 2rem; color: var(--secondary-color);">Add New Hall</h2>
        <?php echo $message; ?>
        <form method="POST">
            <div class="form-group">
                <label>Hall Name</label>
                <input type="text" name="hall_name" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
            </div>
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                <div>
                    <label>Location</label>
                    <input type="text" name="location" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                </div>
                <div>
                    <label>Capacity</label>
                    <input type="number" name="capacity" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label>Pricing (₹ per day)</label>
                <input type="number" step="0.01" name="price" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label>Description</label>
                <textarea name="description" rows="4" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;"></textarea>
            </div>
            <div style="margin-top: 2rem;">
                <button name="submit_hall" class="btn-primary w-100" style="width: 100%;">Save Venue</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

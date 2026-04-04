<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

$id = $_GET['id'] ?? null;
if(!$id) die("No ID specified");

if(isset($_POST['update_hall'])) {
    $name = $_POST['hall_name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    $stmt = mysqli_prepare($conn, "UPDATE halls SET hall_name=?, location=?, capacity=?, price=?, description=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssissi", $name, $location, $capacity, $price, $desc, $id);
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: manage_halls.php");
        exit();
    } else {
        $message = "<div style='color: #c62828; background: #ffebee; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Error updating.</div>";
    }
}

$h = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM halls WHERE id='$id'"));
if(!$h) die("Hall not found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Hall - Admin</title>
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
        <h2 style="margin-bottom: 2rem; color: var(--secondary-color);">Edit Venue Details</h2>
        <?php echo $message; ?>
        <form method="POST">
            <div class="form-group">
                <label>Hall Name</label>
                <input type="text" name="hall_name" value="<?php echo htmlspecialchars($h['hall_name']); ?>" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
            </div>
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                <div>
                    <label>Location</label>
                    <input type="text" name="location" value="<?php echo htmlspecialchars($h['location']); ?>" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                </div>
                <div>
                    <label>Capacity</label>
                    <input type="number" name="capacity" value="<?php echo $h['capacity']; ?>" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label>Pricing (₹ per day)</label>
                <input type="number" step="0.01" name="price" value="<?php echo $h['price']; ?>" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label>Description</label>
                <textarea name="description" rows="4" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($h['description']); ?></textarea>
            </div>
            <div style="margin-top: 2rem;">
                <button name="update_hall" class="btn-primary w-100" style="width: 100%;">Update Details</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

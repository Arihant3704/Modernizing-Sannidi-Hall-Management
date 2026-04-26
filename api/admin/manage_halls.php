<?php
session_start();
include __DIR__ . '/../includes/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

// Handle Delete
if(isset($_POST['delete_hall'])) {
    $hall_id = $_POST['hall_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM halls WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $hall_id);
    if(mysqli_stmt_execute($stmt)) {
        $message = "<div style='color: #2e7d32; background: #e8f5e9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Hall deleted successfully.</div>";
    }
    mysqli_stmt_close($stmt);
}

$halls = mysqli_query($conn, "SELECT * FROM halls ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Halls - Admin</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .container { max-width: 1200px; margin: 4rem auto; padding: 0 2rem; }
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 2rem; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        th { background: #f8f9fa; padding: 1.2rem; text-align: left; font-weight: 600; color: var(--secondary-color); border-bottom: 2px solid #eee; }
        td { padding: 1.2rem; border-bottom: 1px solid #eee; color: var(--text-main); vertical-align: middle; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.85rem; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-edit { background: #e3f2fd; color: #1565c0; }
        .btn-delete { background: #ffebee; color: #c62828; }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall Admin</div>
    <div class="nav-links">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_halls.php" style="color: var(--primary-color);">Manage Halls</a>
        <a href="view_booking.php">Manage Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h2 style="color: var(--secondary-color);">Manage Venues</h2>
            <p style="color: var(--text-muted);">Add, edit, or remove hall inventory.</p>
        </div>
        <a href="add_hall.php" class="btn-primary">
            + Add New Hall
        </a>
    </div>

    <?php echo $message; ?>

    <table>
        <thead>
            <tr>
                <th>Hall Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Pricing</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($h = mysqli_fetch_assoc($halls)): ?>
            <tr>
                <td style="font-weight: 600;"><?php echo htmlspecialchars($h['hall_name']); ?></td>
                <td><?php echo htmlspecialchars($h['location']); ?></td>
                <td><?php echo $h['capacity']; ?> pax</td>
                <td>₹<?php echo number_format($h['price']); ?></td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="edit_hall.php?id=<?php echo $h['id']; ?>" class="btn-sm btn-edit">Edit</a>
                        <form method="POST" onsubmit="return confirm('Delete this hall? This removes all active bookings for it.');">
                            <input type="hidden" name="hall_id" value="<?php echo $h['id']; ?>">
                            <button type="submit" name="delete_hall" class="btn-sm btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT b.booking_id, h.hall_name, b.booking_date, b.status 
          FROM booking b 
          JOIN halls h ON b.hall_id = h.id 
          WHERE b.user_id = ? 
          ORDER BY b.booking_date DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Sannidi Hall</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .history-container {
            max-width: 900px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background: #fff8e1; color: #f57f17; }
        .status-approved { background: #e8f5e9; color: #2e7d32; }
        .status-rejected { background: #ffebee; color: #c62828; }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 2rem;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        th {
            background: #f8f9fa;
            padding: 1.2rem;
            text-align: left;
            font-weight: 600;
            color: var(--secondary-color);
            border-bottom: 2px solid #eee;
        }
        td {
            padding: 1.2rem;
            border-bottom: 1px solid #eee;
            color: var(--text-main);
        }
        tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall</div>
    <div class="nav-links">
        <a href="user_dashboard.php">Dashboard</a>
        <a href="booking_history.php" style="color: var(--primary-color);">My Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="history-container">
    <h2 style="margin-bottom: 0.5rem;">Your Booking History</h2>
    <p style="color: var(--text-muted);">View the status of your reservation requests.</p>

    <?php if(mysqli_num_rows($result) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Reference ID</th>
                <th>Hall Name</th>
                <th>Event Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td style="font-family: monospace; color: var(--text-muted);">#BK-<?php echo str_pad($row['booking_id'], 5, '0', STR_PAD_LEFT); ?></td>
                <td style="font-weight: 500;"><?php echo htmlspecialchars($row['hall_name']); ?></td>
                <td><?php echo date('M d, Y', strtotime($row['booking_date'])); ?></td>
                <td>
                    <span class="status-badge status-<?php echo $row['status']; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="glass-card" style="text-align: center; margin-top: 3rem; padding: 4rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;">📜</div>
        <h3>No bookings found</h3>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">You haven't made any reservation requests yet.</p>
        <a href="book_hall.php" class="btn-primary">Book Your First Hall</a>
    </div>
    <?php endif; ?>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>
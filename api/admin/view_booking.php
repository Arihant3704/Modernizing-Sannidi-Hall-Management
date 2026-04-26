<?php
session_start();
include __DIR__ . '/../includes/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$message = "";

// Handle Approve/Reject POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $action = $_POST['action'];
    $new_status = ($action === 'approve') ? 'approved' : 'rejected';
    
    $stmt = mysqli_prepare($conn, "UPDATE booking SET status = ? WHERE booking_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $new_status, $booking_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $message = "<div style='color: #2e7d32; background: #e8f5e9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Booking #BK-" . str_pad($booking_id, 5, '0', STR_PAD_LEFT) . " has been " . $new_status . ".</div>";
    } else {
        $message = "<div style='color: #c62828; background: #ffebee; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;'>Error updating booking status.</div>";
    }
    mysqli_stmt_close($stmt);
}

// Fetch all bookings
$query = "SELECT b.booking_id, u.user_name, u.email, h.hall_name, b.booking_date, b.start_time, b.end_time, b.status 
          FROM booking b 
          JOIN users u ON b.user_id = u.id 
          JOIN halls h ON b.hall_id = h.id 
          ORDER BY b.booking_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Sannidi Hall Admin</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
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
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-pending { background: #fff8e1; color: #f57f17; }
        .status-approved { background: #e8f5e9; color: #2e7d32; }
        .status-rejected { background: #ffebee; color: #c62828; }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-approve { background: #e8f5e9; color: #2e7d32; }
        .btn-approve:hover { background: #c8e6c9; }
        .btn-reject { background: #ffebee; color: #c62828; }
        .btn-reject:hover { background: #ffcdd2; }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="color: var(--primary-color); font-weight: 700;">Sannidi Hall Admin</div>
    <div class="nav-links">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_halls.php">Manage Halls</a>
        <a href="view_booking.php" style="color: var(--primary-color);">Manage Bookings</a>
        <a href="../includes/logout.php" class="btn-primary" style="padding: 0.5rem 1rem; margin-left: 1rem;">Logout</a>
    </div>
</nav>

<div class="container">
    <h2 style="margin-bottom: 0.5rem; color: var(--secondary-color);">Manage Bookings</h2>
    <p style="color: var(--text-muted); margin-bottom: 2rem;">Review and process reservation requests.</p>
    
    <?php echo $message; ?>

    <?php if(mysqli_num_rows($result) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Booking Ref</th>
                <th>User Details</th>
                <th>Hall Request</th>
                <th>Event Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td style="font-family: monospace; color: var(--text-muted);">#BK-<?php echo str_pad($row['booking_id'], 5, '0', STR_PAD_LEFT); ?></td>
                <td>
                    <div style="font-weight: 500;"><?php echo htmlspecialchars($row['user_name']); ?></div>
                    <div style="font-size: 0.85rem; color: var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?></div>
                </td>
                <td style="font-weight: 500;"><?php echo htmlspecialchars($row['hall_name']); ?></td>
                <td>
                    <?php echo date('M d, Y', strtotime($row['booking_date'])); ?>
                    <?php if($row['start_time']): ?>
                        <br><small style="color: var(--text-muted);"><?php echo date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])); ?></small>
                    <?php endif; ?>
                </td>
                <td>
                    <span class="status-badge status-<?php echo $row['status']; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
                <td>
                    <?php if($row['status'] === 'pending'): ?>
                    <form method="POST" class="action-btns">
                        <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                        <button type="submit" name="action" value="approve" class="btn-sm btn-approve" title="Approve">✓ Approve</button>
                        <button type="submit" name="action" value="reject" class="btn-sm btn-reject" title="Reject">✗ Reject</button>
                    </form>
                    <?php else: ?>
                    <span style="color: var(--text-muted); font-size: 0.85rem;">Processed</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="glass-card" style="text-align: center; margin-top: 3rem; padding: 4rem;">
        <p style="color: var(--text-muted);">No bookings found in the system.</p>
    </div>
    <?php endif; ?>
</div>

<footer style="background: var(--secondary-color); color: #888; padding: 4rem 2rem; text-align: center; margin-top: 5rem;">
    <p style="font-size: 0.9rem;">&copy; 2024 Sannidi Hall Management. All rights reserved.</p>
</footer>

</body>
</html>
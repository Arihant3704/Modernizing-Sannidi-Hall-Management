<?php
session_start();
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statement to fetch user
    $stmt = mysqli_prepare($conn, "SELECT id, user_name, password, role FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Regeneration for security
            session_regenerate_id();
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                $_SESSION['admin'] = $email; // Backwards compatibility if needed
                header("Location: ../admin/admin_dashboard.php");
            } else {
                $_SESSION['user'] = $email; // Backwards compatibility if needed
                header("Location: ../user/user_dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid password'); window.location='../login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email'); window.location='../login.php';</script>";
    }
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../login.php");
}
?>

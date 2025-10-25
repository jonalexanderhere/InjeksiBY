<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Phoenix CTF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Phoenix CTF - User Dashboard 🔥</h1>
            <div class="nav">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p>You have successfully logged in to your account.</p>
            </div>

            <div class="info-box">
                <h3>Your Account Type</h3>
                <p>👤 <strong>Regular User</strong></p>
                <p>You do not have admin privileges to view the flag.</p>
            </div>

            <div class="hint-box">
                <h3>Challenge Status</h3>
                <p>❌ Access Denied: You need admin privileges to view the flag.</p>
                <p>💡 Try to find a way to bypass the authentication system...</p>
                <p>💡 SQL injection might help you access the admin panel...</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Phoenix CTF. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

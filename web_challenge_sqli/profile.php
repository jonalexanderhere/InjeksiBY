<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user data
$conn = getConnection();
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Phoenix CTF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Phoenix CTF - Profile 🔥</h1>
            <div class="nav">
                <a href="<?php echo $user['is_admin'] ? 'admin.php' : 'dashboard.php'; ?>">Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="content">
            <div class="profile-box">
                <h2>Your Profile</h2>
                <div class="profile-info">
                    <div class="profile-item">
                        <strong>Username:</strong>
                        <span><?php echo htmlspecialchars($user['username']); ?></span>
                    </div>
                    <div class="profile-item">
                        <strong>Email:</strong>
                        <span><?php echo htmlspecialchars($user['email'] ?: 'N/A'); ?></span>
                    </div>
                    <div class="profile-item">
                        <strong>Role:</strong>
                        <span><?php echo $user['is_admin'] ? '👑 Administrator' : '👤 Regular User'; ?></span>
                    </div>
                    <div class="profile-item">
                        <strong>Account Created:</strong>
                        <span><?php echo $user['created_at']; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Phoenix CTF. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

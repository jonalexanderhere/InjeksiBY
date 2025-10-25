<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['is_admin'] != 1) {
    header('Location: dashboard.php');
    exit();
}

// Get all users for admin panel
$conn = getConnection();
$sql = "SELECT id, username, email, is_admin, created_at FROM users ORDER BY id";
$result = $conn->query($sql);
$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Phoenix CTF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Phoenix CTF - Admin Dashboard 🔥</h1>
            <div class="nav">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h2>Welcome, Administrator <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p>You have successfully bypassed the authentication system!</p>
            </div>

            <div class="flag-box">
                <h2>🎉 Congratulations! 🎉</h2>
                <div class="flag">
                    <h3>FLAG:</h3>
                    <p class="flag-text">PHXCTF{1Njeksi_Byp44as}</p>
                </div>
                <p class="flag-description">
                    You have successfully exploited the SQL injection vulnerability and accessed the admin dashboard!
                </p>
                <div class="exploit-info">
                    <h4>🔍 What you exploited:</h4>
                    <p>The login form was vulnerable to SQL injection because the SQL query was constructed using string concatenation without proper input sanitization.</p>
                    <p><strong>Vulnerable Code:</strong></p>
                    <code>SELECT * FROM users WHERE username = '$username' AND password = '$password'</code>
                    <p><strong>Exploit Used:</strong></p>
                    <code>' OR '1'='1' -- </code>
                    <p>This payload closed the username string, added an always-true condition, and commented out the password check.</p>
                </div>
            </div>

            <div class="admin-panel">
                <h3>📊 User Management</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo $user['is_admin'] ? '👑 Admin' : '👤 User'; ?></td>
                            <td><?php echo $user['created_at']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="stats-box">
                <h3>📈 Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <h4><?php echo count($users); ?></h4>
                        <p>Total Users</p>
                    </div>
                    <div class="stat-item">
                        <h4><?php echo count(array_filter($users, function($u) { return $u['is_admin'] == 1; })); ?></h4>
                        <p>Admin Users</p>
                    </div>
                    <div class="stat-item">
                        <h4><?php echo count(array_filter($users, function($u) { return $u['is_admin'] == 0; })); ?></h4>
                        <p>Regular Users</p>
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

<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if (isset($_GET['message'])) {
    $success = $_GET['message'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // VULNERABLE SQL QUERY - Intentionally vulnerable for CTF challenge
    $conn = getConnection();
    
    // This is intentionally vulnerable to SQL injection
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '" . md5($password) . "'";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        
        // Redirect based on role
        if ($user['is_admin'] == 1) {
            header('Location: admin.php');
            exit();
        } else {
            header('Location: dashboard.php');
            exit();
        }
    } else {
        $error = 'Invalid username or password!';
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Phoenix CTF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Phoenix CTF - Login 🔥</h1>
            <a href="index.php" class="back-link">← Back to Home</a>
        </div>

        <div class="content">
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <div class="form-box">
                <h2>Login to Your Account</h2>
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required placeholder="Enter your username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <div class="form-footer">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
                
                <div class="hint-box" style="margin-top: 20px;">
                    <h4>🔍 Testing Tips:</h4>
                    <p>Try entering special characters in the username field...</p>
                    <p>What happens if you use: <code>' OR '1'='1</code></p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Phoenix CTF. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

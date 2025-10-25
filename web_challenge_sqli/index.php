<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix CTF - SQL Injection Challenge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔥 Phoenix CTF - SQL Injection Challenge 🔥</h1>
            <p class="subtitle">Find the vulnerability and bypass the authentication</p>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h2>Welcome to Phoenix CTF SQL Injection Challenge!</h2>
                <p>Your mission is to bypass the login system and access the admin panel.</p>
                <p>Can you find the SQL injection vulnerability?</p>
                
                <div class="button-group">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                </div>
            </div>

            <div class="info-box">
                <h3>Challenge Information</h3>
                <ul>
                    <li>🎯 Objective: Bypass authentication using SQL injection</li>
                    <li>🔐 Find the vulnerability in the login system</li>
                    <li>📝 You can also create a normal user account</li>
                    <li>🚀 Flag format: PHXCTF{...}</li>
                    <li>💉 SQL Injection techniques required</li>
                </ul>
            </div>

            <div class="hint-box">
                <h3>Hints</h3>
                <p>💡 The login system might be vulnerable to SQL injection...</p>
                <p>💡 Try testing with special characters like ' or " in the username field...</p>
                <p>💡 Think about how SQL queries are constructed...</p>
                <p>💡 Classic SQL injection patterns might work here...</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2024 Phoenix CTF. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

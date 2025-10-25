<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'phoenix_ctf');

// Create database connection
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Initialize database and tables
function initDatabase() {
    // Connect without database first
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    $conn->query($sql);
    
    $conn->close();
    
    // Connect to the database
    $conn = getConnection();
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        is_admin TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conn->query($sql);
    
    // Check if admin exists
    $sql = "SELECT * FROM users WHERE username = 'admin'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
        // Create default admin account
        $admin_password = md5('admin123'); // Intentionally weak for CTF
        $sql = "INSERT INTO users (username, password, email, is_admin) 
                VALUES ('admin', '$admin_password', 'admin@phoenixctf.com', 1)";
        $conn->query($sql);
    }
    
    $conn->close();
}

// Initialize database on first load
initDatabase();
?>

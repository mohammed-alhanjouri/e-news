# 📰 Truth News — E-News Portal

Truth News is a dynamic and responsive PHP-based news website for publishing breaking news, featured stories, and category-based articles. It includes user authentication, article search, pagination, and comments, all organized in a clean folder structure.

## 🚀 Features

- User Signup & Login (session-based authentication, hashed passwords)
- Dynamic article display (Breaking, Featured, Latest)
- Category-wise article filtering
- Article search
- Comments on articles
- Pagination
- Responsive design with CSS variables
- Reusable header and footer components

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3 (custom variables), responsive design
- **Backend:** PHP 8 (procedural, MySQLi)
- **Database:** MySQL / MariaDB
- **Server:** Apache (via XAMPP)

## 📁 Project Structure

```
e-news/
├── assets/
│   ├── styles.css            # Custom CSS styling
│   └── truth-news-logo.png   # Site logo
├── config/
│   └── db.php                # Database connection settings
├── includes/
│   ├── header.php            # Header with navigation (session-based)
│   └── footer.php            # Footer section
├── article.php               # Single article view with comments
├── category.php              # Category-wise article listing
├── index.php                 # Homepage: breaking, featured and latest news
├── login.php                 # User login
├── logout.php                # Ends the session and redirects
├── signup.php                # User registration with validation
├── search.php                # Article keyword search
└── news_db.sql               # Database schema and sample data
```

## ⚙️ Run It Locally (XAMPP)

### 1. Get the code into XAMPP's `htdocs` folder

```bash
cd /Applications/XAMPP/xamppfiles/htdocs   # macOS
# cd C:\xampp\htdocs                         # Windows
git clone https://github.com/mohammed-alhanjouri/e-news.git
```

> If you download the ZIP from GitHub instead, the folder is named `e-news-main`. Use that name in the URLs below.

### 2. Start Apache and MySQL

- **Windows / Intel Mac:** open the XAMPP control panel and start **Apache** and **MySQL**.
- **Apple Silicon Mac (M1/M2/M3/M4):** XAMPP for macOS is Intel-only, so it needs Rosetta 2, and its control panel (`manager-osx`) won't open on Apple chips. Install Rosetta once, then start the servers from Terminal:

  ```bash
  softwareupdate --install-rosetta --agree-to-license   # one time only
  sudo /Applications/XAMPP/xamppfiles/xampp start      # start Apache + MySQL
  sudo /Applications/XAMPP/xamppfiles/xampp stop       # stop them when done
  ```

  > Rosetta 2 runs Intel apps only up to macOS 27. On macOS 28 and later, use a native PHP + MariaDB setup (for example via Homebrew) instead.

### 3. Import the database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Go to the **Import** tab, choose `news_db.sql`, and click **Go**.

The SQL file creates the `news_db` database itself, so you don't need to create one first.

### 4. Configure the database connection

Edit `config/db.php` with your MySQL credentials. XAMPP's default login is `root` with an empty password:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'news_db');
```

### 5. Open the site

```
http://localhost/e-news/
```

> **Port note:** if Apache is set to a different port (check the `Listen` line in `xamppfiles/etc/httpd.conf`), add it to the URL, e.g. `http://localhost:8080/e-news/`. If the browser says *"localhost refused to connect"*, this is usually why.

### 6. Log in

Use one of the sample accounts, or create your own with **Sign Up**:

| Username | Password | Role |
|---|---|---|
| admin | password123 | admin |
| user1 | password123 | user |
| user2 | password234 | user |

Passwords are stored as bcrypt hashes and checked with `password_verify()`. If you add users directly in phpMyAdmin, store a hash (from PHP's `password_hash()`), not the plain password, or they won't be able to log in.

## 👤 User Authentication

- **Sign up:** create an account via `signup.php` (passwords are hashed with `password_hash()`)
- **Log in:** `login.php`
- **Sessions:** the header shows Login/Sign Up or Logout depending on the session
- **Log out:** `logout.php` ends the session and redirects home

## 🔍 Search & Filter

- **Search:** find articles by keyword, e.g. `search.php?query=gaza`
- **Categories:** pick a category from the navbar to see filtered, paginated results

## 🧑🏻‍💻 Developed by

Mohammed Al Hanjouri

- GitHub: https://github.com/mohammed-alhanjouri
- LinkedIn: https://linkedin.com/in/mohammed-alhanjouri

### Website Screenshots

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 03 00 PM" src="https://github.com/user-attachments/assets/75d6b965-2c40-400c-9a90-280537a2d458" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 03 30 PM" src="https://github.com/user-attachments/assets/c45689e9-c30f-4cc8-bc8b-713d81618a4c" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 04 30 PM" src="https://github.com/user-attachments/assets/f43bbb97-1828-432b-a469-e2627efa5eb4" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 05 09 PM" src="https://github.com/user-attachments/assets/ed5e3483-8122-4edb-81d3-a0f5b9b87800" />

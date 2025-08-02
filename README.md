# 📰 Truth News — E-News Portal

Truth News is a dynamic and responsive PHP-based news website designed for real-time publishing of breaking news, featured stories, and category-based articles. The platform includes user authentication, article search, pagination, and comment count functionalities — all managed with a clean, organized structure.

## 🚀 Features

- User Signup & Login (Session-based Authentication)
- Dynamic Article Display (Breaking, Featured, Latest)
- Category-wise Article Filtering
- Article Search Functionality
- Comment Count for Each Article
- Pagination Support
- Responsive Design with CSS Variables
- Clean Folder Structure with Reusable Components

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3 (with custom variables), Responsive Design
- **Backend:** PHP (Procedural)
- **Database:** MySQL
- **Server:** XAMPP / Apache
- **Assets:** Logo and branding in `/assets/`

## 📁 Project Structure

e-news/

│

├── assets/

│ ├── styles.css # Custom CSS styling

│ └── truth-news-logo.png # Site logo

│

├── config/

│ └── db.php # Database connection

│

├── includes/

│ ├── header.php # Header with navigation (session-based)

│ └── footer.php # Footer section

│

├── article.php # Single article view

├── category.php # Category-wise article listing

├── index.php # Homepage with breaking, featured, and latest news

├── login.php # User login page

├── logout.php # Ends session and redirects

├── signup.php # User registration with validation

├── search.php # Article keyword search

└── news_db.sql # MySQL database schema and sample data


## ⚙️ Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/mohammed-alhanjouri/e-news.git

2. **Import the database**:

  - Open phpMyAdmin

  - Create a new database (e.g., e_news)

  - Import the news_db.sql file located in the project root

3. **Configure database connection**:
   
  - Edit config/db.php with your DB credentials:

    define('DB_HOST', 'localhost');

    define('DB_USER', 'root');

    define('DB_PASS', '');

    define('DB_NAME', 'e_news');

4. **Run the project**:
  - Start Apache and MySQL via XAMPP
  - Visit http://localhost/e-news/index.php in your browser

## 👤 User Authentication

Signup: Create an account via signup.php

Login: Log in using login.php

Session Handling: The app stores session data and restricts access accordingly

Logout: Ends session and redirects to home


## 🔍 Search & Filter

Search: Users can search for articles via keywords (e.g., search.php?query=)

Category: Clickable categories on the navbar or homepage direct to filtered results

## 🧑🏻‍💻 Developed by

Mohammed Al Hanjouri

GitHub: https://github.com/mohammed-alhanjouri

LinkedIn: https://linkedin.com/in/mohammed-alhanjouri

### Website Screenshots

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 03 00 PM" src="https://github.com/user-attachments/assets/75d6b965-2c40-400c-9a90-280537a2d458" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 03 30 PM" src="https://github.com/user-attachments/assets/c45689e9-c30f-4cc8-bc8b-713d81618a4c" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 04 30 PM" src="https://github.com/user-attachments/assets/f43bbb97-1828-432b-a469-e2627efa5eb4" />

<img width="1512" height="823" alt="Screenshot 2025-08-02 at 4 05 09 PM" src="https://github.com/user-attachments/assets/ed5e3483-8122-4edb-81d3-a0f5b9b87800" />


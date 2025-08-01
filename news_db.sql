CREATE DATABASE IF NOT EXISTS news_db;
USE news_db;
-- Create users Table
CREATE TABLE users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);
-- Create categories Tables
CREATE TABLE categories(
    category_id INT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    category_description VARCHAR(255) NOT NULL
);
-- Create articles Tables
CREATE TABLE articles(
    article_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    is_breaking TINYINT(1) NOT NULL DEFAULT 0,
    image_url VARCHAR(255),
    category_id INT NOT NULL,
    author_id INT NOT NULL,
    published_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
-- Create comments Table
CREATE TABLE comments(
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
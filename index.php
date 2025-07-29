<?php

include 'config/db.php';

// Fetch all categories from DB
$categories_result = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_id ASC");
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

// Fetch Breaking News (LIMIT 2)
$breaking_sql = "SELECT * FROM articles 
                WHERE is_breaking = 1 
                ORDER BY published_date DESC 
                LIMIT 2";
$breaking_result = mysqli_query($connection, $breaking_sql);
$breaking_news = mysqli_fetch_all($breaking_result, MYSQLI_ASSOC);

// Fetch Featured Articles (LIMIT 3)
$featured_sql = "SELECT * FROM articles 
                WHERE is_breaking = 0 
                ORDER BY published_date DESC 
                LIMIT 3";
$featured_result = mysqli_query($connection, $featured_sql);
$featured_articles = mysqli_fetch_all($featured_result, MYSQLI_ASSOC);

// Fetch Latest News Articles (LIMIT 3 OFFSET 3)
$latest_sql = "SELECT * FROM articles
                WHERE is_breaking = 0 
                ORDER BY published_date DESC 
                LIMIT 3 OFFSET 3";
$latest_result = mysqli_query($connection, $latest_sql);
$latest_articles = mysqli_fetch_all($latest_result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truth News</title>
    <link rel="icon" href="truth-news.png" sizes="48x48" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>

        <div class="logo">
            <img src="truth-news.png" alt="Truth News">
            <h1>Truth News</h1>
        </div>

        <nav class="header-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>
                    <a href="category.php">Category</a>
                    <ul>
                        <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="category.php?id=<?php echo $category['category_id']; ?>">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div class="search-bar">
            <input type="text" placeholder="Search articles..."/>
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div class="auth-buttons">
            <button>Login</button>
            <button>Sign Up</button>
        </div>
    </header>

    <div class="layout-container">
        
        <main>
            <section class="breaking-news">
                <h2><i class="fas fa-bolt"></i>Breaking News</h2>
                <article>
                    <h3>Example of Breaking News</h3>
                    <p>This is a brief description of the breaking news event.</p>
                </article>
                <?php foreach ($breaking_news as $article): ?>
                    <article>
                        <h3><a href="article.php?id=<?php echo $article['article_id'] ?>"><?php echo htmlspecialchars($article['title']) ?></a></h3>
                        <p><?php echo substr(strip_tags($article['content']), 0, 100) ?>...</p>
                    </article>
                <?php endforeach; ?>
            </section>

            <section class="section featured-articles">
                <h2>Featured Articles</h2>
                <div class="grid">
                    <?php foreach ($featured_articles as $article): ?>
                        <article>
                            <img src="<?php echo htmlspecialchars($article['image_url']) ?>" alt="Thumbnail">
                            <h3><a href="article.php?id=<?php echo $article['article_id'] ?>"><?php echo htmlspecialchars($article['title']) ?></a></h3>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="section latest-news">
                <h2>Latest News</h2>
                <?php foreach ($latest_articles as $article): ?>
                    <article>
                        <img src="<?php echo htmlspecialchars($article['image_url']) ?>" alt="Thumbnail">
                        <div>
                            <h3><a href="article.php?id=<?php echo $article['article_id'] ?>"><?php echo htmlspecialchars($article['title']) ?></a></h3>
                            <p><?php echo substr(strip_tags($article['content']), 0, 100) ?>...</p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>

            <section class="section category-wise-news">
                <h2>Category-wise News</h2>
                <div class="category-grid">
                    <article>
                        <h3>Politics</h3>
                        <p>Latest developments in domestic and international political affairs, policy changes, and government initiatives.</p>
                    </article>
                    <article>
                        <h3>Technology</h3>
                        <p>Breaking news in tech innovation, digital transformation, and emerging technologies shaping our future.</p>
                    </article>
                    <article>
                        <h3>Sports</h3>
                        <p>Comprehensive coverage of sporting events, athlete achievements, and major tournament results.</p>
                    </article>
                    <article>
                        <h3>Entertainment</h3>
                        <p>Latest updates from the entertainment industry, including movies, music, and celebrity news.</p>
                    </article>
                </div>
            </section>
        </main>

        <aside class="sidebar">
            <h3>Trending</h3>
            <ul>
                <li><a href="#">Trending Topic 1</a></li>
                <li><a href="#">Climate Change Summit Results</a></li>
                <li><a href="#">Technology Innovation Awards</a></li>
                <li><a href="#">Sports Championship Finals</a></li>
                <li><a href="#">Cultural Events Calendar</a></li>
            </ul>

            <div class="ad">
                <p><strong>Advertisement</strong><br>
                Premium content space available<br>
                Contact us for rates</p>
            </div>
        </aside>
    </div>

    <footer>
        <div class="footer-about">
            <h2>Truth News</h2>
            <p>Your trusted source for reliable and timely news coverage around the world.</p>
            <p>&copy; 2025 Truth News. All rights reserved.</p>
        </div>

        <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-social">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/mohammed.alhanjouri" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/mohammed.alhanjouri" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://x.com/MohammedHanj" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.linkedin.com/in/mohammed-alhanjouri" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>
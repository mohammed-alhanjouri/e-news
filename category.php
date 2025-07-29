<?php 

include 'config/db.php';

// Fetch all categories from DB
$categories_result = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_id ASC");
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

if(isset($_GET['id'])){
    $category_id = intval($_GET['id']);

    // Fetch Category Details 
    $category_sql = "SELECT * FROM categories WHERE category_id = $category_id";
    $category_result = mysqli_query($connection, $category_sql);
    $category_details = mysqli_fetch_assoc($category_result);
} else {
    die("Category ID not provided.");
}

// Pagination 
$articles_per_page = 3; // Number of articles to display per page
if (isset($_GET['page'])) { 
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
// Count total number of articles in the category
$offset = ($current_page - 1) * $articles_per_page; // Skips articles already displayed
$total_articles_sql = "SELECT COUNT(*) AS total FROM articles WHERE category_id = $category_id";
$total_articles_result = mysqli_query($connection, $total_articles_sql);
$total_articles = mysqli_fetch_assoc($total_articles_result)['total'];
$total_pages = ceil($total_articles / $articles_per_page); // Rounds up to ensure having enough pages to display all articles


// Fetch Articles in the Category 
$category_articles_sql = "SELECT a.*, u.username, 
                            (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.article_id) AS comment_count
                           FROM articles a 
                           JOIN users u ON a.author_id = u.user_id 
                           WHERE a.category_id = $category_id 
                           ORDER BY a.published_date DESC
                           LIMIT $articles_per_page OFFSET $offset";
$category_articles_result = mysqli_query($connection, $category_articles_sql);
$category_articles = mysqli_fetch_all($category_articles_result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo htmlspecialchars($category_details['category_name']); ?> | Truth News</title>
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
            <div class="category-header">
                <h1><?php echo htmlspecialchars($category_details['category_name']); ?></h1>
                <p class="category-description"><?php echo htmlspecialchars($category_details['category_description']); ?></p>
            </div>

            <div class="category-sorting">
                <span>Sort by:</span>
                <select>
                    <option>Newest First</option>
                    <option>Oldest First</option>
                    <option>Most Popular</option>
                </select>
            </div>

            <section class="category-articles">
                <?php foreach ($category_articles as $article): ?>
                    <article>
                        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Thumbnail">
                        <div class="article-content">
                            <span class="article-category"><?php echo htmlspecialchars($category_details['category_name']); ?></span>
                            <h2><a href="article.php?id=<?php echo $article['article_id']; ?>"><?php echo htmlspecialchars($article['title']); ?></a></h2>
                            <p class="article-description"><?php echo htmlspecialchars(substr(strip_tags($article['content']), 0, 150)) . '...'; ?></p>
                            <div class="article-data">
                                <span><i class="far fa-user"></i> By <?php echo htmlspecialchars($article['username']); ?></span>
                                <span><i class="far fa-clock"></i> <?php echo date('F j, Y', strtotime($article['published_date'])); ?></span>
                                <span><i class="far fa-comment"></i><?php echo $article['comment_count']; ?> comments</span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <div class="pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $current_page - 1; ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                        <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $page; ?>" class="<?php echo ($page == $current_page) ? 'active' : ''; ?>">
                            <?php echo $page; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <a href="category.php?id=<?php echo $category_id; ?>&page=<?php echo $current_page + 1; ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <aside class="sidebar">
            <h3>Browse Other Categories</h3>
            <ul class="related-categories">
                <?php foreach ($categories as $related): ?>
                    <?php if ($related['category_id'] != $category_id): ?>
                        <li>
                            <a href="category.php?id=<?php echo $related['category_id']; ?>">
                                <?php echo htmlspecialchars($related['category_name']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>


            <div class="newsletter">
                <h3>Newsletter</h3>
                <p>Subscribe to stay updated with the latest news!</p>
                <input type="email" placeholder="Your email address">
                <button>Subscribe</button>
            </div>

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
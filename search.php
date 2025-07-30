<?php 

include 'config/db.php';

// Fetch all categories from DB
$categories_result = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_id ASC");
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);


// Pagination
$articles_per_page = 3;
if (isset($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $articles_per_page;


// Search Functionality - Allow users to search for articles by keywords.
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';
$search_results = [];

if (!empty($search_query)) {
    $total_sql = "SELECT COUNT(*) AS total FROM articles 
                WHERE title LIKE '%$search_query%' 
                OR content LIKE '%$search_query%'";
    $total_result = mysqli_query($connection, $total_sql);
    $total_articles = mysqli_fetch_assoc($total_result)['total'];
    $total_pages = ceil($total_articles / $articles_per_page);

    // Perform the search operation
    $search_results = searchArticles($search_query, $articles_per_page, $offset);
}

function searchArticles($keyword, $limit, $offset) {
    // This function should connect to the database and fetch articles matching the query
    global $connection;

    // Escapes special characters in a string for use in an SQL statement
    $keyword = mysqli_real_escape_string($connection, $keyword);

    $search_sql = "SELECT a.*, u.username, c2.category_name,
                        (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.article_id) AS comment_count
                    FROM articles a
                    JOIN users u ON a.author_id = u.user_id
                    JOIN categories c2 ON a.category_id = c2.category_id
                    WHERE a.title LIKE '%$keyword%'
                    OR a.content LIKE '%$keyword%'
                    ORDER BY a.published_date DESC
                    LIMIT $limit OFFSET $offset";
    $search_result = mysqli_query($connection, $search_sql);
    return mysqli_fetch_all($search_result, MYSQLI_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | Truth News</title>
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

        <form action="search.php" method="GET" class="search-bar">
            <input type="text" name="query" placeholder="Search articles..." required>
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>


        <div class="auth-buttons">
            <button>Login</button>
            <button>Sign Up</button>
        </div>
    </header>

    <div class="layout-container">
        <main>
            <h1>Search Results for: "<?php echo htmlspecialchars($search_query); ?>"</h1>

            <?php if (!empty($search_query)): ?>
                <?php if (count($search_results) > 0): ?>
                    <?php foreach ($search_results as $article): ?>
                        <article>
                            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Thumbnail">
                            <div class="article-content">
                                <span class="article-category"><?php echo htmlspecialchars($article['category_name']); ?></span>
                                <h2><a href="article.php?id=<?php echo $article['article_id']; ?>">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a></h2>
                                <p class="article-description">
                                    <?php echo htmlspecialchars(substr(strip_tags($article['content']), 0, 150)) . '...'; ?>
                                </p>
                                <div class="article-data">
                                    <span><i class="far fa-user"></i> By <?php echo htmlspecialchars($article['username']); ?></span>
                                    <span><i class="far fa-clock"></i> <?php echo date('F j, Y', strtotime($article['published_date'])); ?></span>
                                    <span><i class="far fa-comment"></i> <?php echo $article['comment_count']; ?> comments</span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No results found for "<?php echo htmlspecialchars($search_query); ?>"</p>
                <?php endif; ?>
            <?php else: ?>
                <p>Please enter a search term.</p>
            <?php endif; ?>
            
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="search.php?query=<?php echo $search_query; ?>&page=<?php echo $current_page - 1; ?>">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                    <a href="search.php?query=<?php echo $search_query; ?>&page=<?php echo $page; ?>" class="<?php echo ($page == $current_page) ? 'active' : ''; ?>">
                        <?php echo $page; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="search.php?query=<?php echo $search_query; ?>&page=<?php echo $current_page + 1; ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </main>
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
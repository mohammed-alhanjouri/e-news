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

<?php include 'includes/header.php'; ?>

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

<?php include 'includes/footer.php'; ?>
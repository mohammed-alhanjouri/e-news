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

<?php include 'includes/header.php'; ?>

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

<?php include 'includes/footer.php'; ?>
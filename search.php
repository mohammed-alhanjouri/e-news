<?php 

include 'config/db.php';

// Pagination
$articles_per_page = 3;
if (isset($_GET['page'])) {
    $current_page = max(1, intval($_GET['page'])); // never below page 1
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $articles_per_page;


// Search Functionality - Allow users to search for articles by keywords.
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';
$search_results = [];
$total_pages = 0;

if (!empty($search_query)) {
    // Wrap the keyword in % for LIKE; the value is bound, never pasted into the SQL
    $like = '%' . $search_query . '%';

    // Prepared statement (prevents SQL injection)
    $total_stmt = mysqli_prepare($connection, "SELECT COUNT(*) AS total FROM articles WHERE title LIKE ? OR content LIKE ?");
    mysqli_stmt_bind_param($total_stmt, "ss", $like, $like);
    mysqli_stmt_execute($total_stmt);
    $total_articles = mysqli_fetch_assoc(mysqli_stmt_get_result($total_stmt))['total'];
    mysqli_stmt_close($total_stmt);
    $total_pages = ceil($total_articles / $articles_per_page);

    // Perform the search operation
    $search_results = searchArticles($like, $articles_per_page, $offset);
}

function searchArticles($like, $limit, $offset) {
    // Fetch the articles matching the search keyword for the current page
    global $connection;

    $search_sql = "SELECT a.*, u.username, c2.category_name,
                        (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.article_id) AS comment_count
                    FROM articles a
                    JOIN users u ON a.author_id = u.user_id
                    JOIN categories c2 ON a.category_id = c2.category_id
                    WHERE a.title LIKE ?
                    OR a.content LIKE ?
                    ORDER BY a.published_date DESC
                    LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($connection, $search_sql);
    mysqli_stmt_bind_param($stmt, "ssii", $like, $like, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $results = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $results;
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
                        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Thumbnail" style="object-fit: cover; width: 40%; height: 200px;">
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
                <a href="search.php?query=<?php echo urlencode($search_query); ?>&page=<?php echo $current_page - 1; ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                <a href="search.php?query=<?php echo urlencode($search_query); ?>&page=<?php echo $page; ?>" class="<?php echo ($page == $current_page) ? 'active' : ''; ?>">
                    <?php echo $page; ?>
                </a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="search.php?query=<?php echo urlencode($search_query); ?>&page=<?php echo $current_page + 1; ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
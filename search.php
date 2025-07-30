<?php 

include 'config/db.php';

// Search Functionality - Allow users to search for articles by keywords.
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';
$search_results = [];

if (!empty($search_query)) {
    // Perform the search operation
    $search_results = searchArticles($search_query);
}

function searchArticles($keyword) {
    // This function should connect to the database and fetch articles matching the query
    global $connection;

    // Escapes special characters in a string for use in an SQL statement
    $keyword = mysqli_real_escape_string($connection, $keyword);

    $search_sql = "SELECT a.*, u.username
                    FROM articles a
                    JOIN users u ON a.author_id = u.user_id
                    WHERE a.title LIKE '%$keyword%'
                    OR a.content LIKE '%$keyword%'
                    ORDER BY a.published_date DESC";
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
</head>
<body>
    <h1>Search Results</h1>
    <?php if (!empty($search_results)): ?>
        <ul>
            <?php foreach ($search_results as $article): ?>
                <li>
                    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                    <p><?php echo htmlspecialchars($article['content']); ?></p>
                    <p>Author: <?php echo htmlspecialchars($article['username']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
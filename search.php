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
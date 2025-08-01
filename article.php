<?php

include 'config/db.php';

if(isset($_GET['id'])) {
    $article_id = intval($_GET['id']);

    // Fetch Article Details
    $article_sql = "SELECT a.*, u.username, c.category_name 
                    FROM articles a 
                    JOIN users u ON a.author_id = u.user_id 
                    JOIN categories c ON a.category_id = c.category_id 
                    WHERE a.article_id = $article_id";
    $article_result = mysqli_query($connection, $article_sql);
    $article = mysqli_fetch_assoc($article_result);
} else {
    die("Article ID not provided.");
}

// Handle Comment Submission
if(isset($_POST['submit_comment'])) {
    $comment_text = mysqli_real_escape_string($connection, $_POST['comment_text']);
    $user_id = 1; 

    $insert_comment_sql = "INSERT INTO comments (article_id, user_id, comment_text, timestamp) 
                            VALUES ($article_id, $user_id, '$comment_text', NOW())";
    mysqli_query($connection, $insert_comment_sql);
    header("Location: article.php?id=$article_id"); 
    exit();
}

// Fetch Comments for the Article
$comments_sql = "SELECT c.*, u.username 
                FROM comments c 
                JOIN users u ON c.user_id = u.user_id 
                WHERE c.article_id = $article_id 
                ORDER BY c.timestamp DESC";
$comments_result = mysqli_query($connection, $comments_sql);
$comments = mysqli_fetch_all($comments_result, MYSQLI_ASSOC);

// Fetch Related Articles
$related_sql = "SELECT article_id , title, image_url FROM articles
                WHERE category_id = {$article['category_id']}
                AND article_id != $article_id
                ORDER BY published_date DESC
                LIMIT 3";
$related_result = mysqli_query($connection, $related_sql);
$related_articles = mysqli_fetch_all($related_result, MYSQLI_ASSOC);

// Set timezone for time_ago function
date_default_timezone_set('Asia/Gaza');

// Function to format time ago
function time_ago($timestamp) {
    $current_time = time();
    $time_diff = $current_time - strtotime($timestamp);
    
    if ($time_diff < 60) {
        return 'just now';
    } elseif ($time_diff < 3600) {
        $minutes = floor($time_diff / 60);
        return $minutes . ' min' . ($minutes == 1 ? '' : 's') . ' ago';
    } elseif ($time_diff < 86400) {
        $hours = floor($time_diff / 3600);
        return $hours . ' hr' . ($hours == 1 ? '' : 's') . ' ago';
    } elseif ($time_diff < 604800) {
        $days = floor($time_diff / 86400);
        return $days . ' day' . ($days == 1 ? '' : 's') . ' ago';
    } elseif ($time_diff < 2592000) {
        $weeks = floor($time_diff / 604800);
        return $weeks . ' week' . ($weeks == 1 ? '' : 's') . ' ago';
    } elseif ($time_diff < 31536000) {
        $months = floor($time_diff / 2592000);
        return $months . ' month' . ($months == 1 ? '' : 's') . ' ago';
    } else {
        $years = floor($time_diff / 31536000);
        return $years . ' year' . ($years == 1 ? '' : 's') . ' ago';
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="layout-container">
    <main>
        <article class="single-article">
            <span class="article-category"><?php echo htmlspecialchars($article['category_name']); ?></span>
            <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>

            <div class="article-data">
                <span><i class="far fa-user"></i> By <?php echo htmlspecialchars($article['username']); ?></span>
                <span><i class="far fa-clock"></i> Published <?php echo date('F j, Y', strtotime($article['published_date'])); ?></span>
                <span><i class="far fa-comment"></i> <?php echo count($comments) ?> comments</span>
                <span><i class="fas fa-share-alt"></i> Share</span>
            </div>

            <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-featured-image">

            <div class="article-content">
                <?php echo htmlspecialchars($article['content']); ?>
            </div>

            <div class="article-actions">
                <div class="article-rating">
                    <span>Rate this article:</span>
                    <div class="stars">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
                <div class="share-buttons">
                    <button><i class="fa-brands fa-facebook-f"></i> Share</button>
                    <button><i class="fa-brands fa-x-twitter"></i> Tweet</button>
                    <button><i class="fa-brands fa-linkedin-in"></i> Share</button>
                </div>
            </div>
        </article>

        <section class="article-comments">
            <h2>Comments (<?php echo count($comments); ?>)</h2>
            <div class="comment-form">
                <h3>Leave a Comment</h3>
                <form action="" method="post">
                    <textarea name="comment_text" placeholder="Share your thoughts..." required></textarea>
                    <button type="submit" name="submit_comment">Post Comment</button>
                </form>
            </div>

            <?php foreach($comments as $comment): ?>
                <div class="comment">
                    <img src="https://via.placeholder.com/50" alt="User avatar">
                    <div class="comment-content">
                        <h4><?php echo htmlspecialchars($comment['username']); ?>
                            <span><?php echo time_ago($comment['timestamp']); ?></span>
                        </h4>
                        <p><?php echo htmlspecialchars($comment['comment_text']) ?></p>
                        <div class="comment-actions">
                            <a href="#">Reply</a>
                            <a href="#"><i class="far fa-thumbs-up"></i> 12</a>
                            <a href="#"><i class="far fa-thumbs-down"></i> 2</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </section>

        <section class="related-articles">
            <h2>Related Articles</h2>
            <div class="grid">

                <?php foreach($related_articles as $related) :?>
                    <article>
                        <img src="<?php echo htmlspecialchars($related['image_url']); ?>" alt="">
                        <h3><a href="article.php?id=<?php echo $related['article_id']; ?>">
                            <?php echo htmlspecialchars($related['title']); ?>
                        </a></h3>
                    </article>
                <?php endforeach; ?>
            </div>

        </section>
    </main>

    <aside class="sidebar">
        <h3>About the Author</h3>
        <div class="author-bio">
            <img src="https://via.placeholder.com/100" alt="Author">
            <h4>Author Name</h4>
            <p>Author Bio</p>
            <div class="author-social">
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>

        <h3>Trending in <?php echo htmlspecialchars($article['category_name']); ?></h3>
        <ul>
            <li><a href="#">Election Polls Show Tight Race</a></li>
            <li><a href="#">New Legislation on Tech Regulation</a></li>
            <li><a href="#">Supreme Court to Hear Key Case</a></li>
            <li><a href="#">Diplomatic Tensions Rise</a></li>
        </ul>

        <div class="ad">
            <p><strong>Advertisement</strong><br>
            Premium content space available<br>
            Contact us for rates</p>
        </div>
    </aside>
</div>

<?php include 'includes/footer.php'; ?>
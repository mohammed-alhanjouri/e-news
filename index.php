<?php

include 'config/db.php';

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

<?php include 'includes/header.php'; ?>

<div class="layout-container">
        
    <main>
        <section class="breaking-news">
            <h2><i class="fas fa-bolt"></i>Breaking News</h2>
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
                <?php foreach($categories as $category): ?>
                    <article>
                        <h3><?php echo htmlspecialchars($category['category_name']); ?></h3>
                        <p><?php echo htmlspecialchars($category['category_description']); ?></p>
                    </article>
                <?php endforeach;?>
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

<?php include 'includes/footer.php'; ?>
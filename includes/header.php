<?php
session_start();
// Fetch all categories from DB
$categories_result = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_id ASC");
$categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truth News</title>
    <link rel="icon" href="assets/truth-news-logo.png" sizes="48x48" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <header>

        <div class="logo">
            <img src="assets/truth-news-logo.png" alt="Truth News">
            <h1><a href="index.php">Truth News</a></h1>
        </div>

        <nav class="header-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>
                    <a href="#">Category</a>
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
            <!-- <button onclick="location.href='login.php'">Login</button>
            <button onclick="location.href='signup.php'">Sign Up</button> -->
            <?php if (isset($_SESSION['username'])): ?>
                <span style="color:white; font-size:1.1rem;">
                    Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                </span>
                <a href="logout.php">
                    <button>Logout</button>
                </a>
            <?php else: ?>
                <a href="login.php"><button>Login</button></a>
                <a href="signup.php"><button>Sign Up</button></a>
            <?php endif; ?>
        </div>
    </header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truth News</title>
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
                        <li><a href="#">Politics</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Entertainment</a></li>
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
                <h1>Politics</h1>
                <p class="category-description">Latest developments in domestic and international political affairs, policy changes, and government initiatives.</p>
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
                <article>
                    <img src="https://via.placeholder.com/300x200" alt="Article thumbnail">
                    <div class="article-content">
                        <span class="article-category">Politics</span>
                        <h2><a href="article.html">Global Leaders Gather for Climate Summit</a></h2>
                        <p class="article-description">World leaders convened in Paris to discuss new climate initiatives and set ambitious targets for carbon reduction by 2030.</p>
                        <div class="article-data">
                            <span><i class="far fa-user"></i> By John Smith</span>
                            <span><i class="far fa-clock"></i> 3 hours ago</span>
                            <span><i class="far fa-comment"></i> 24 comments</span>
                        </div>
                    </div>
                </article>

                <article>
                    <img src="https://via.placeholder.com/300x200" alt="Article thumbnail">
                    <div class="article-content">
                        <span class="article-category">Politics</span>
                        <h2><a href="article.html">New Legislation Proposed for Tech Regulation</a></h2>
                        <p class="article-description">A bipartisan group of senators introduced a bill that would impose new regulations on large technology companies to promote competition.</p>
                        <div class="article-data">
                            <span><i class="far fa-user"></i> By Sarah Johnson</span>
                            <span><i class="far fa-clock"></i> 1 day ago</span>
                            <span><i class="far fa-comment"></i> 42 comments</span>
                        </div>
                    </div>
                </article>

                <article>
                    <img src="https://via.placeholder.com/300x200" alt="Article thumbnail">
                    <div class="article-content">
                        <span class="article-category">Politics</span>
                        <h2><a href="article.html">Election Polls Show Tight Race in Key States</a></h2>
                        <p class="article-description">Latest polling data reveals a dead heat between candidates in several battleground states as election day approaches.</p>
                        <div class="article-data">
                            <span><i class="far fa-user"></i> By Michael Chen</span>
                            <span><i class="far fa-clock"></i> 2 days ago</span>
                            <span><i class="far fa-comment"></i> 18 comments</span>
                        </div>
                    </div>
                </article>

                <div class="pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fas fa-chevron-right"></i></a>
                </div>
            </section>
        </main>

        <aside class="sidebar">
            <h3>Related Categories</h3>
            <ul class="related-categories">
                <li><a href="category.html?cat=policy">Policy & Governance</a></li>
                <li><a href="category.html?cat=international">International Relations</a></li>
                <li><a href="category.html?cat=economy">Political Economy</a></li>
                <li><a href="category.html?cat=history">Political History</a></li>
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
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
            <article class="single-article">
                <span class="article-category">Politics</span>
                <h1 class="article-title">Global Leaders Gather for Climate Summit</h1>
                
                <div class="article-data">
                    <span><i class="far fa-user"></i> By John Smith</span>
                    <span><i class="far fa-clock"></i> Published 3 hours ago</span>
                    <span><i class="far fa-comment"></i> 24 comments</span>
                    <span><i class="fas fa-share-alt"></i> Share</span>
                </div>

                <img src="https://via.placeholder.com/800x450" alt="Climate Summit" class="article-featured-image">

                <div class="article-content">
                    <p class="article-intro">World leaders from over 100 countries convened in Paris today for the annual Global Climate Summit, with ambitious targets to reduce carbon emissions by 50% before 2030.</p>

                    <p>The summit, hosted by French President Emmanuel Macron, brings together heads of state, environmental experts, and business leaders to address what many are calling the defining challenge of our generation.</p>

                    <h2>Key Proposals</h2>
                    <p>Several major proposals were put forward during the opening sessions:</p>
                    <ul>
                        <li>A global carbon tax framework</li>
                        <li>Increased funding for renewable energy research</li>
                        <li>Stricter regulations on industrial emissions</li>
                        <li>International standards for sustainable agriculture</li>
                    </ul>

                    <blockquote>
                        "This is not just an environmental issue, but an economic imperative and a moral obligation to future generations," said UN Secretary-General António Guterres in his opening address.
                    </blockquote>

                    <h2>Controversial Discussions</h2>
                    <p>Not all nations were in agreement, however. Representatives from several developing nations argued that wealthier countries should bear more of the financial burden, citing historical emissions.</p>

                    <img src="https://via.placeholder.com/600x400" alt="Protesters outside summit" class="article-inline-image">

                    <p>Outside the summit venue, thousands of protesters gathered demanding more aggressive action, while climate activists staged demonstrations highlighting the urgency of the crisis.</p>

                    <div class="article-tags">
                        <span>Tags:</span>
                        <a href="#">Climate Change</a>
                        <a href="#">Paris Agreement</a>
                        <a href="#">Sustainability</a>
                        <a href="#">Global Policy</a>
                    </div>
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
                <h2>Comments (24)</h2>
                <div class="comment-form">
                    <h3>Leave a Comment</h3>
                    <textarea placeholder="Share your thoughts..."></textarea>
                    <button>Post Comment</button>
                </div>

                <div class="comment">
                    <img src="https://via.placeholder.com/50" alt="User avatar">
                    <div class="comment-content">
                        <h4>Jane Doe <span>2 hours ago</span></h4>
                        <p>Finally some meaningful action! Though I worry these targets still aren't ambitious enough given the scale of the crisis.</p>
                        <div class="comment-actions">
                            <a href="#">Reply</a>
                            <a href="#"><i class="far fa-thumbs-up"></i> 12</a>
                            <a href="#"><i class="far fa-thumbs-down"></i> 2</a>
                        </div>
                    </div>
                </div>

                <div class="comment">
                    <img src="https://via.placeholder.com/50" alt="User avatar">
                    <div class="comment-content">
                        <h4>Robert Johnson <span>1 hour ago</span></h4>
                        <p>All talk as usual. Where's the enforcement mechanism? These summits produce nice declarations but little real change.</p>
                        <div class="comment-actions">
                            <a href="#">Reply</a>
                            <a href="#"><i class="far fa-thumbs-up"></i> 8</a>
                            <a href="#"><i class="far fa-thumbs-down"></i> 5</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="related-articles">
                <h2>Related Articles</h2>
                <div class="grid">
                    <article>
                        <img src="https://via.placeholder.com/250" alt="Thumbnail">
                        <h3>New Climate Study Shows Accelerated Warming</h3>
                    </article>
                    <article>
                        <img src="https://via.placeholder.com/250" alt="Thumbnail">
                        <h3>Renewable Energy Investments Reach Record High</h3>
                    </article>
                    <article>
                        <img src="https://via.placeholder.com/250" alt="Thumbnail">
                        <h3>Youth Climate Activists Plan Global Strike</h3>
                    </article>
                </div>
            </section>
        </main>

        <aside class="sidebar">
            <h3>About the Author</h3>
            <div class="author-bio">
                <img src="https://via.placeholder.com/100" alt="John Smith">
                <h4>John Smith</h4>
                <p>Senior Political Correspondent with over 15 years experience covering international affairs and climate policy.</p>
                <div class="author-social">
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>

            <h3>Trending in Politics</h3>
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
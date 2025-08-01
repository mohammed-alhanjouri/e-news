CREATE DATABASE IF NOT EXISTS news_db;
USE news_db;
-- Create users Table
CREATE TABLE users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);
-- Insert sample users
INSERT INTO users (username, email, password, role)
VALUES (
        'admin',
        'admin@example.com',
        'password123',
        'admin'
    ),
    (
        'user1',
        'user1@example.com',
        'password123',
        'user'
    ),
    (
        'user2',
        'user2@example.com',
        'password234',
        'user'
    ),
    (
        'user3',
        'user3@example.com',
        'password345',
        'user'
    ),
    (
        'user4',
        'user4@example.com',
        'password456',
        'user'
    );
-- Create categories Tables
CREATE TABLE categories(
    category_id INT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    category_description VARCHAR(255) NOT NULL
);
-- Insert sample categories
INSERT INTO categories (category_id, category_name, category_description)
VALUES (
        1,
        'Politics',
        'Latest developments in domestic and international political affairs, government actions, policy changes, and diplomacy.'
    ),
    (
        2,
        'Sports',
        'Breaking news, match results, athlete achievements, and updates from tournaments and leagues around the world.'
    ),
    (
        3,
        'Technology',
        'Innovations, gadget launches, digital trends, and tech company news shaping the future of our connected world.'
    ),
    (
        4,
        'Health',
        'Updates on medical research, public health policies, mental wellness, and fitness advice to keep you informed and healthy.'
    ),
    (
        5,
        'Entertainment',
        'Celebrity news, movie and music releases, cultural trends, and behind-the-scenes coverage from the entertainment industry.'
    ),
    (
        6,
        'Business',
        'Economic insights, stock market updates, company news, startups, and financial trends influencing global markets.'
    ),
    (
        7,
        'Palestine News',
        'Latest news and updates about Palestine.'
    );
-- Create articles Tables
CREATE TABLE articles(
    article_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    is_breaking TINYINT(1) NOT NULL DEFAULT 0,
    image_url VARCHAR(255),
    category_id INT NOT NULL,
    author_id INT NOT NULL,
    published_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
-- Insert sample articles
INSERT INTO articles (
        title,
        content,
        is_breaking,
        image_url,
        category_id,
        author_id
    )
VALUES (
        'Breaking: New Government Policy Announced',
        'The government has announced a new policy that will affect millions of citizens. This comprehensive policy aims to address key issues in healthcare, education, and social welfare...',
        1,
        'https://i0.wp.com/www.middleeastmonitor.com/wp-content/uploads/2024/04/AA-20240402-34164174-34164172-PALESTINIAN_PRIME_MINISTER_MOHAMMAD_MUSTAFA-scaled.jpg?fit=2560%2C1707&ssl=1',
        1,
        1,
        '2025-07-27 21:12:49'
    ),
    (
        'Local Football Team Wins Championship',
        'In a thrilling match that went into overtime, the local football team secured their first championship in over a decade. The team showed exceptional teamwork and determination...',
        0,
        'https://media.gq-magazine.co.uk/photos/620bc452d40b784f5d470f27/master/pass/150222_Chelsea_02.jpg',
        2,
        5,
        '2025-07-27 21:12:49'
    ),
    (
        'Revolutionary AI Technology Unveiled',
        'Scientists have developed a groundbreaking AI system that could transform how we approach complex problems. The technology promises to revolutionize industries from healthcare to finance...',
        0,
        'https://govtkajawai.com/wp-content/uploads/2025/07/InShot_20250704_195258753.jpg',
        3,
        4,
        '2025-07-27 21:12:49'
    ),
    (
        'New Study Reveals Health Benefits of Mediterranean Diet',
        'A comprehensive 10-year study has confirmed the significant health benefits of following a Mediterranean diet. Researchers found reduced risks of heart disease and improved cognitive function...',
        0,
        'https://i0.wp.com/morethanourstory.com/wp-content/uploads/2024/12/mediterranean-diet-hdr.jpg?fit=2000%2C1333&ssl=1',
        4,
        2,
        '2025-07-27 21:12:49'
    ),
    (
        'Movie Awards Season Kicks Off',
        'The entertainment industry is buzzing as award season begins. This year features exceptional performances and groundbreaking films that have captivated audiences worldwide...',
        0,
        'https://platform.vox.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/15267034/oscarguys.0.0.1424363459.jpg?quality=90&strip=all&crop=0,0.02498750624688,100,99.950024987506',
        5,
        3,
        '2025-07-27 21:12:49'
    ),
    (
        'Stock Market Reaches Record Highs',
        'Financial markets closed at record highs today, driven by strong earnings reports and positive economic indicators. Investors remain optimistic about future growth prospects...',
        1,
        'https://cdn.mos.cms.futurecdn.net/bfx3YMfJ3nojGCcXv2JgqJ.jpg',
        6,
        1,
        '2025-07-27 21:12:49'
    ),
    (
        'Climate Change Summit Begins Next Week',
        'World leaders will gather for the annual climate summit to discuss urgent environmental policies. The focus will be on renewable energy initiatives and carbon reduction strategies...',
        0,
        'https://static01.nyt.com/images/2022/11/07/world/07cop27-morning-lede-family-photo/07cop27-morning-lede-family-photo-videoSixteenByNine3000-v2.jpg',
        1,
        2,
        '2025-07-27 21:12:49'
    ),
    (
        'Tech Giants Report Strong Quarter',
        'Major technology companies have reported better-than-expected quarterly results, with cloud computing and AI services driving growth across the sector...',
        0,
        'https://www.ft.com/__origami/service/image/v2/images/raw/https%3A%2F%2Fd1e00ek4ebabms.cloudfront.net%2Fproduction%2F26898d28-cfe2-42cd-a9ea-f52be3573958.jpg?source=next-article&fit=scale-down&quality=highest&width=700&dpr=1',
        6,
        4,
        '2025-07-27 21:12:49'
    ),
    (
        'Parliament Approves New Economic Bill',
        'Lawmakers passed a controversial bill aimed at reviving the post-pandemic economy through stimulus packages and tax reforms.',
        0,
        'https://gowharshadmedia.com/wp-content/uploads/2025/02/uk-parliament.jpeg',
        1,
        2,
        '2025-07-29 12:01:08'
    ),
    (
        'International Summit on Peace Talks Begins',
        'Global leaders are gathering in Geneva to engage in high-stakes peace negotiations to resolve ongoing regional conflicts.',
        0,
        'https://i2.obozrevatel.com/gallery/2024/6/16/photo2024-06-1611-36-041.jpg',
        1,
        3,
        '2025-07-29 12:01:08'
    ),
    (
        'Star Player Sets New Scoring Record',
        'With a stunning performance last night, the athlete broke the league’s single-season scoring record.',
        0,
        'https://semprebarca.com/wp-content/uploads/2024/12/Pedri-10.jpg',
        2,
        4,
        '2025-07-29 12:01:08'
    ),
    (
        'Olympic Committee Releases Host City Plans',
        'The upcoming Olympic Games will feature a state-of-the-art stadium and expanded athlete village.',
        0,
        'https://img.olympics.com/images/image/private/t_s_16_9_g_auto/t_s_w960/f_auto/primary/pbehk7af3ffeaygojywv',
        2,
        1,
        '2025-07-29 12:01:08'
    ),
    (
        'Breakthrough in Quantum Computing Announced',
        'Researchers claim their new prototype quantum computer performs calculations thousands of times faster than classical computers.',
        0,
        'https://www.cnet.com/a/img/resize/20282bf61efbd577d4184f2d6033c645691df5cb/hub/2025/02/20/be2b4fae-2b06-450d-8bb0-899c8d105e01/screenshot-2025-02-20-at-9-32-41am.png?auto=webp&fit=crop&height=675&width=1200',
        3,
        1,
        '2025-07-29 12:01:08'
    ),
    (
        'Social Media Platform Launches AI Moderator',
        'To combat misinformation, the platform has rolled out a new AI-powered content review system.',
        0,
        'https://cdn.colombia.com/sdi/2024/10/09/diez-nuevas-actualizaciones-en-las-redes-sociales-de-meta-1258127-0.jpg',
        3,
        3,
        '2025-07-29 12:01:08'
    ),
    (
        'Vaccine Study Shows Promising Results',
        'A new vaccine candidate has demonstrated 95% efficacy in preventing disease during late-stage trials.',
        0,
        'https://thalassaemia.org.cy/wp-content/uploads/2020/07/ezgif.com-webp-to-jpg.jpg',
        4,
        5,
        '2025-07-29 12:01:08'
    ),
    (
        'Mental Health Support Increased in Schools',
        'Education departments announce expanded mental health services for students amid rising stress levels.',
        0,
        'https://theciomedia.com/wp-content/uploads/2024/06/The-Importance-of-Mental-Health-Support-in-Schools.jpg',
        4,
        2,
        '2025-07-29 12:01:08'
    ),
    (
        'Streaming Service Drops Surprise Series',
        'A major platform released a new sci-fi drama with no prior announcement, catching fans off guard.',
        0,
        'https://imageio.forbes.com/specials-images/imageserve/63a1bea7b0ec401a990c44d1/0x0.jpg?format=jpg&crop=2745,1544,x0,y136,safe&height=600&width=1200&fit=bounds',
        5,
        2,
        '2025-07-29 12:01:08'
    ),
    (
        'Broadway Reopens with New Musicals',
        'After a long hiatus, Broadway theaters welcome audiences back with a fresh lineup of musicals and performances.',
        0,
        'https://imaging.broadway.com/images/regular-43/w735/119857-12.jpg',
        5,
        4,
        '2025-07-29 12:01:08'
    ),
    (
        'Stock Market Rallies Amid Optimism',
        'Investor confidence is surging following announcements of strong earnings across key sectors.',
        0,
        'https://cdn.ainvest.com/aigc/hxcmp/images/compress-1aa5cbc4a3938001.png',
        6,
        3,
        '2025-07-29 12:01:08'
    ),
    (
        'Startup Secures $50M in Series B Funding',
        'The fintech startup plans to scale its operations globally after a successful funding round.',
        0,
        'https://peopleofcolorintech.com/wp-content/uploads/2024/12/9fin-ezgif.com-webp-to-png-converter-1080x635.png',
        6,
        5,
        '2025-07-29 12:01:08'
    ),
    (
        'Israeli Occupation Airstrikes Pound Gaza City, Dozens Reported Dead',
        'Israeli airstrikes have intensified across Gaza City overnight, with local health officials reporting at least 50 Palestinians killed in the latest bombardment. The attacks targeted residential buildings in the Rimal neighborhood, reducing several high-rise apartments to rubble.\r\n\r\nEmergency crews are still searching for survivors in the debris as international calls for a ceasefire grow louder. Hamas officials claim the strikes hit civilian areas with no military presence, while the Israeli military says it was targeting Hamas command centers.\r\n\r\nUN Secretary-General Antonio Guterres has called the situation \"a humanitarian catastrophe\" and urged both sides to de-escalate immediately. Hospitals in Gaza report being overwhelmed with casualties and running critically low on medical supplies.',
        1,
        'https://www.aljazeera.com/wp-content/uploads/2023/12/346P72N-highres-1701418403.jpg?resize=730%2C410&quality=80',
        7,
        4,
        '2025-07-30 21:02:30'
    ),
    (
        'Voices from Jerusalem: Life Under Occupation',
        'Daily life in Jerusalem is marked by military presence, checkpoints, and resilience. We spoke to residents about their experiences and hopes.\r\n',
        0,
        'https://www.unescwa.org/sites/default/files/news/images/whatsapp_image_2023-07-27_at_2.58.28_pm_1.jpeg',
        7,
        4,
        '2025-07-30 21:03:38'
    ),
    (
        'Cultural Resistance: Ramallah’s Artists Speak Up',
        'Despite the pressures, Ramallah’s vibrant arts scene continues to raise its voice. Exhibitions and poetry readings inspire hope and defiance.\r\n',
        0,
        'https://www.newhavenarts.org/hubfs/Arts%20Paper/April%202025/Embr/Embroidery_exh4.jpg',
        7,
        2,
        '2025-07-30 21:04:37'
    );
-- Create comments Table
CREATE TABLE comments(
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- Insert sample comments
INSERT INTO comments (article_id, user_id, comment_text, timestamp)
VALUES (
        1,
        2,
        'This policy could really make a difference in our community. Looking forward to seeing how it is implemented.',
        '2025-07-27 21:12:49'
    ),
    (
        1,
        3,
        'I have some concerns about the funding for this initiative. Hope they address this in the details.',
        '2025-07-27 21:12:49'
    ),
    (
        2,
        3,
        'What an amazing game! I was there and the atmosphere was incredible.',
        '2025-07-27 21:12:49'
    ),
    (
        2,
        4,
        'Congratulations to the team! They really deserved this win after all their hard work.',
        '2025-07-27 21:12:49'
    ),
    (
        3,
        2,
        'The potential applications of this AI technology are mind-blowing. Cannot wait to see it in action.',
        '2025-07-27 21:12:49'
    ),
    (
        3,
        5,
        'I wonder about the ethical implications of such advanced AI systems.',
        '2025-07-27 21:12:49'
    ),
    (
        4,
        4,
        'I have been following the Mediterranean diet for years and can confirm these benefits.',
        '2025-07-27 21:12:49'
    ),
    (
        5,
        5,
        'Excited to see which films will take home the top awards this year!',
        '2025-07-27 21:12:49'
    ),
    (
        6,
        2,
        'Great news for investors, but I hope this growth is sustainable.',
        '2025-07-27 21:12:49'
    ),
    (
        7,
        3,
        'Climate action cannot wait any longer. Hope this summit leads to real commitments.',
        '2025-07-27 21:12:49'
    ),
    (
        8,
        4,
        'The growth in AI services is really impressive. The future looks bright for tech.',
        '2025-07-27 21:12:49'
    ),
    (
        1,
        4,
        'Thanks for the detailed coverage of this important policy announcement.',
        '2025-07-27 21:12:49'
    ),
    (
        6,
        2,
        'This bill could be a game-changer for the economy. Smart move!',
        '2025-07-29 12:06:30'
    ),
    (
        6,
        4,
        'More government spending again? Not sure this will help anyone.',
        '2025-07-29 12:06:30'
    ),
    (
        7,
        1,
        'Diplomatic dialogue is always a good step forward.',
        '2025-07-29 12:06:30'
    ),
    (
        7,
        5,
        'Peace talks rarely change anything. Let’s not get our hopes up.',
        '2025-07-29 12:06:30'
    ),
    (
        8,
        3,
        'What an amazing achievement! Truly deserved.',
        '2025-07-29 12:06:30'
    ),
    (
        8,
        2,
        'Records mean nothing without a championship win.',
        '2025-07-29 12:06:30'
    ),
    (
        9,
        4,
        'Can’t wait to see the new Olympic stadium in action!',
        '2025-07-29 12:06:30'
    ),
    (
        9,
        1,
        'Waste of taxpayer money for a two-week event.',
        '2025-07-29 12:06:30'
    ),
    (
        10,
        5,
        'Quantum computing is the future. This is incredible.',
        '2025-07-29 12:06:30'
    ),
    (
        10,
        3,
        'Still years away from being practical. Hype much?',
        '2025-07-29 12:06:30'
    ),
    (
        11,
        2,
        'Great move against misinformation.',
        '2025-07-29 12:06:30'
    ),
    (
        11,
        4,
        'AI moderation will just lead to censorship.',
        '2025-07-29 12:06:30'
    ),
    (
        12,
        1,
        'Glad to see vaccine trials are progressing well.',
        '2025-07-29 12:06:30'
    ),
    (
        12,
        3,
        'Probably rushed and not safe. I’m skeptical.',
        '2025-07-29 12:06:30'
    ),
    (
        13,
        2,
        'Mental health support in schools is so important.',
        '2025-07-29 12:06:30'
    ),
    (
        13,
        5,
        'Schools should focus on education, not therapy.',
        '2025-07-29 12:06:30'
    ),
    (
        14,
        4,
        'I loved the surprise release — great show!',
        '2025-07-29 12:06:30'
    ),
    (
        14,
        1,
        'Felt like a cheap gimmick to boost ratings.',
        '2025-07-29 12:06:30'
    ),
    (
        15,
        3,
        'Broadway is back! Can’t wait to attend.',
        '2025-07-29 12:06:30'
    ),
    (
        15,
        2,
        'Tickets are too expensive. Not worth it.',
        '2025-07-29 12:06:30'
    ),
    (
        16,
        5,
        'Finally some positive market momentum!',
        '2025-07-29 12:06:30'
    ),
    (
        16,
        4,
        'This won’t last. Another bubble incoming.',
        '2025-07-29 12:06:30'
    ),
    (
        17,
        1,
        'Great to see innovation being funded.',
        '2025-07-29 12:06:30'
    ),
    (
        17,
        3,
        'Too many startups get money without real ideas.',
        '2025-07-29 12:06:30'
    ),
    (21, 3, 'Ceasefire NOW! ', '2025-07-31 23:50:00'),
    (
        14,
        1,
        'LOL! No privacy anymore!',
        '2025-08-01 00:12:35'
    ),
    (
        23,
        1,
        'So many ways, and one goal: Resistant!',
        '2025-08-01 00:16:01'
    ),
    (11, 1, 'Good Job!', '2025-08-01 00:27:20');
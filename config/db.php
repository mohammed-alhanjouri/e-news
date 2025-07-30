<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'Moha');
define('DB_PASSWORD', '01001101');
define('DB_NAME', 'news_db');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} 
// else {
//     echo "Connected successfully";
// }


?>
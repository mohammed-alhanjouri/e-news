<?php 

include 'config/db.php';
session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $success_message = "You are Logged In!<br>Redirecting to Homepage...";
        header("refresh:2; url=index.php");
    } else {
        $error_message = "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Truth News</title>
    <link rel="icon" href="assets/truth-news-logo.png" sizes="48x48" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
        
    <main class="auth-container">
        <h1>Login to Truth News</h1>
        <div class="auth-form">
            <form action="" method="POST">
                <h2>Login</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="submit">Login</button>

                <?php if (isset($error_message)): ?>
                    <p style="color:red; text-align:center;"><?= $error_message ?></p>
                <?php elseif (isset($success_message)): ?>
                    <p style="color:green; text-align:center;"><?= $success_message ?></p>
                <?php endif; ?>

                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </main>
</body>
</html>
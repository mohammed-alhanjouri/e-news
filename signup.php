<?php

include 'config/db.php';
session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result = mysqli_query($connection, $check_query);
    $checked = mysqli_fetch_assoc($check_result);

    if ($checked) {
        $error_message = "Username or Email already exists.";
    } else {
        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if (mysqli_query($connection, $insert_query)) {
            $_SESSION['user_id'] = mysqli_insert_id($connection);
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'user'; // Default role
            $success_message = "Registration successful! You can now <a href='login.php'>Log In</a>.";
        } else {
            $error_message = "Registration failed. Please try again.";
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Truth News</title>
    <link rel="icon" href="assets/truth-news-logo.png" sizes="48x48" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <main class="auth-container">
        <h1>Create an Account</h1>
        <div class="auth-form">
            <form action="" method="POST">
                <h2>Sign Up</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="submit">Sign Up</button>

                <?php if (isset($error_message)): ?>
                    <p style="color:red; text-align:center;"><?= $error_message ?></p>
                <?php elseif (isset($success_message)): ?>
                    <p style="color:green; text-align:center;"><?= $success_message ?></p>
                <?php endif; ?>

                <p>Already have an account? <a href="login.php">Log In</a></p>
            </form>
        </div>
    </main>
</body>
</html>
<?php
require 'db.php';
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to homepage after successful login
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Invalid username or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="logo">THEGEMS&CO.</h1>
        <h2>Login</h2>
        <form method="POST" action="">
            <label class="form-label" for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
            <label class="form-label" for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
            <button type="submit" class="btn-custom">Login</button>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</ html>
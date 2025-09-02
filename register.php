<?php
require 'db.php'; // Include your database connection file
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']); // Get the username and trim whitespace
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the password

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $existingUser  = $stmt->fetch();

    if ($existingUser ) {
        echo "<p style='color:red; text-align:center;'>Username already exists. Please choose another.</p>";
    } else {
        // Insert new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        if ($stmt->execute(['username' => $username, 'password' => $password])) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            // Handle SQL execution error
            echo "<p style='color:red; text-align:center;'>Registration failed. Please try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="logo">THEGEMS&CO.</h1>
        <h2>Register</h2>
        <form method="POST" action="">
            <label class="form-label" for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
            <label class="form-label" for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
            <button type="submit" class="btn-custom">Register</button>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
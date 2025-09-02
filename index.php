<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gems & Co. India | Luxury Jewelry, Gifts & Accessories Since 2024</title>
    <link rel="stylesheet" href="index.css">
    <script src="cart.js" defer></script> <!-- Include your JavaScript file -->
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">THEGEMS&CO.</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="logout.php" class="btn-custom">Logout</a></li>
                    <?php else: ?>
                        <li><a href="register.php" class="btn-custom">Register</a></li>
                        <li><a href="login.php" class="btn-custom">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-content">
            <h2>Discover the Beauty of Minimal Jewelry</h2>
            <a href="shop.html" class="btn">Shop Now</a>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <h2>Our Collection</h2>
            <div class="product-grid">
                <div class="product">
                    <img src="gold.jpg" alt="Gold Necklace">
                    <h3>Gold Necklace</h3>
                    <p>Rs 1329/-</p>
                    <button class="add-to-cart" data-name="Gold Necklace" data-price="1329">Add to Cart</button>
                </div>
                <div class="product">
                    <img src="silverring.jpg" alt="Silver Ring">
                    <h3>Silver Ring</h3>
                    <p>Rs 599/-</p>
                    <button class="add-to-cart" data-name="Silver Ring" data-price="599">Add to Cart</button>
                </div>
                <div class="product">
                    <img src="diamondear.jpg" alt="Diamond Earrings">
                    <h3>Diamond Earrings</h3>
                    <p>Rs 2999/-</p>
                    <button class="add-to-cart" data-name="Diamond Earrings" data-price="2999">Add to Cart</button>
                </div>
                <!-- Add more products as needed -->
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 TG&CO. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
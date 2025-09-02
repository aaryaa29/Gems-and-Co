<?php
session_start();
require 'db.php'; // Include your database connection

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$cartItems = [];

if ($userId) {
    $stmt = $pdo->prepare("SELECT product_name, product_price FROM cart_items WHERE user_id = ?");
    $stmt->execute([$userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
    </header>

    <section class="cart">
        <div class="container">
            <?php if (count($cartItems) > 0): ?>
                <ul>
                    <?php foreach ($cartItems as $item): ?>
                        <li>
                            <span><?php echo htmlspecialchars($item['product_name']); ?></span>
                            <span>Rs <?php echo htmlspecialchars($item['product_price']); ?>/-</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="checkout">Proceed to Checkout</button>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 TG&CO. All Rights Reserved.</p>
    </footer>
</body>
</html>
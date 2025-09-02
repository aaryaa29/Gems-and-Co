<?php
session_start();
require 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if ($data['action'] === 'add') {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Get user ID from session
        $productName = $data['name'];
        $productPrice = $data['price'];

        if ($userId) {
            // Insert into cart_items
            $stmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_name, product_price) VALUES (?, ?, ?)");
            if ($stmt->execute([$userId, $productName, $productPrice])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Database error']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'User  not logged in']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
    }
}
?>
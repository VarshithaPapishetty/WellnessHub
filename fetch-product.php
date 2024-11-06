<?php
// fetch_product.php

// Include database connection file
include('db_connection.php');

// Check if product_id is provided
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Query to fetch product details based on product_id
    $query = "SELECT product_name, price FROM products WHERE product_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return product details as JSON
    if ($product) {
        header('Content-Type: application/json');
        echo json_encode($product);
        exit;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Product not found.']);
        exit;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing product_id parameter.']);
    exit;
}

<?php
// Database connection
$host = 'localhost'; // Replace with your database host
$db = 'tbp'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = '@Sreedhar123'; // Replace with your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['action']) && $data['action'] === 'add_to_cart') {
    $productId = $data['product_id'];
    $productName = $data['product_name'];
    $quantity = $data['quantity'];
    $cartPrice = $data['cart_price'];

    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO cart (product_id, product_name, quantity, cart_price) VALUES (:product_id, :product_name, :quantity, :cart_price)");
    $stmt->bindParam(':product_id', $productId);
    $stmt->bindParam(':product_name', $productName);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':cart_price', $cartPrice);

    // Execute and check result
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add item to cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>

<?php
session_start(); // Start the session

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "@Sreedhar123";
$dbname = "tbp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$cart_price = $_POST['cart_price'];
$user_id = $_SESSION['user_id']; // Get user_id from session

// Check if the product already exists in the cart for this user
$check_query = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
$check_query->bind_param("ii", $user_id, $product_id);
$check_query->execute();
$check_query->store_result();
$check_query->bind_result($existing_quantity);
$check_query->fetch();

if ($check_query->num_rows > 0) {
    // Product exists, update the quantity and price
    $new_quantity = $existing_quantity + $quantity;
    $new_cart_price = ($cart_price / $quantity) * $new_quantity;

    $update_query = $conn->prepare("UPDATE cart SET quantity = ?, cart_price = ? WHERE user_id = ? AND product_id = ?");
    $update_query->bind_param("idii", $new_quantity, $new_cart_price, $user_id, $product_id);

    if ($update_query->execute()) {
        echo "success";
    } else {
        echo "Error: " . $update_query->error;
    }

    $update_query->close();
} else {
    // Product does not exist, insert a new row
    $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, cart_price, quantity, user_id) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("issii", $product_id, $product_name, $cart_price, $quantity, $user_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$check_query->close();
$conn->close();
?>

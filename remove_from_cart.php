<?php
session_start();

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

// Remove item from cart
if (isset($_POST['product_name']) && isset($_SESSION['user_id'])) {
    $product_name = $_POST['product_name'];
    $user_id = $_SESSION['user_id'];

    // Remove all quantities of the product for the user
    $stmt = $conn->prepare("DELETE FROM cart WHERE product_name = ? AND user_id = ?");
    $stmt->bind_param("si", $product_name, $user_id);

    if ($stmt->execute()) {
        echo "Product removed from cart.";
    } else {
        echo "Error removing product: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>

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

// Fetch and display cart items
$user_id = $_SESSION['user_id'];
$cart_query = $conn->prepare("SELECT product_name, SUM(quantity) as total_quantity, SUM(cart_price) as total_price FROM cart WHERE user_id = ? GROUP BY product_name ORDER BY product_name");
$cart_query->bind_param("i", $user_id);
$cart_query->execute();
$cart_query->store_result();
$cart_query->bind_result($product_name, $total_quantity, $total_price);

// Initialize total amount
$total_amount = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 160px 0 0 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
	    overflow-y: hidden; /* Disable vertical scrolling of the body */
        }
        .header {
            width: 100%;
            background-color: #a3a375;
            color: rgb(12, 12, 12);
            padding: 10px 20px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 160px;
            font-family: "Garamond", cursive;
        }
        .back-button {
            background-color: #a3a375;
            color: black;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .back-button:hover {
            background-color: #ddd;
        }
        .header img {
            height: 140px;
            margin-right: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 45px;
            flex-grow: 1;
            text-align: center;
        }
        .support {
            display: flex;
            align-items: center;
            margin-right: 1in;
        }
        .support-button {
            background-color: #000000;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .support-button:hover {
            background-color: #333;
        }
        .support-button img {
            height: 24px;
            margin-right: 5px;
        }

        .cart-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 80%;
    max-width: 800px;
    text-align: center;
    max-height: calc(100vh - 200px); /* Adjust the height to fit within the viewport */
    overflow-y: auto; /* Enable scrolling inside the container */
}
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-total {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .checkout-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .checkout-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <button class="back-button" onclick="window.location.href='e-shopping.php'">←Back</button>
        <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>
        <h1>Your Cart</h1>
        <div class="support">
            <button class="support-button" onclick="callSupport()">
                <img src="phone2.png" alt="Phone Icon">
                Contact Us: (123) 456-7890
            </button>
        </div>
    </div>
</header>
<div id="cart-page" class="container">
        <div id="cart-items">
        <?php
        if ($cart_query->num_rows > 0) {
            while ($cart_query->fetch()) {
                $total_amount += $total_price;
                echo "<div class='cart-item'>
                        <p>{$product_name} - Quantity: {$total_quantity} - Total Price: ₹" . number_format($total_price, 2) . "</p>
                        <button onclick='removeFromCart(\"{$product_name}\")'>Remove</button>
                      </div>";
            }
            // Display total amount
            echo "<div class='cart-total'>
                    <p><strong>Total Amount: ₹" . number_format($total_amount, 2) . "</strong></p>
                  </div>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        // Store total amount in session
        $_SESSION['total_amount'] = $total_amount;

        $cart_query->close();
        $conn->close();
        ?>
    </div>
    <button class="checkout-button" onclick="checkout()">Checkout</button>
</div>

<script>
    function removeFromCart(productName) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_from_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Reload the page to reflect the changes
                location.reload();
            } else {
                alert('An error occurred while removing the product from the cart.');
            }
        };
        xhr.send('product_name=' + encodeURIComponent(productName));
    }

    function checkout() {
        // Redirect to payment.php
        window.location.href = 'payment.php';
    }

    function callSupport() {
        // Implement support call functionality here
        alert('Contacting support');
    }
</script>
</body>
</html>

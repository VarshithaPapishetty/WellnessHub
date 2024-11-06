<?php
session_start();

// Assuming user_id is stored in session during login
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shopping</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
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
            margin-top: -0.1in;
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
        .container {
            text-align: center;
            margin-top: 180px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1in;
        }
        h1 {
            text-align: center;
        }
        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .product {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 20px 0;
            cursor: pointer;
        }
        .product img {
            max-width: 150px;
            max-height: 150px;
            margin-right: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h3 {
            margin: 10px 0 5px;
        }
        .product-info p {
            margin: 5px 0;
        }
        .product-buttons {
            display: none;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }
        .product button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .quantity-selector {
            display: none;
            align-items: center;
            gap: 5px;
        }
        .quantity-selector button {
            padding: 5px 10px;
            background-color: #ccc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .quantity-selector input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #cart-page {
            display: none;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .cart-item p {
            margin: 0;
        }
	.view-cart-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000; /* Ensure the button is on top of other elements */
}

.view-cart-button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <header>
        <div class="header">
            <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>
            <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>
            <h1>E-Shopping</h1>
            <div class="support">
                <button class="support-button" onclick="callSupport()">
                    <img src="phone2.png" alt="Phone Icon">
                    Contact Us: (123) 456-7890
                </button>
            </div>
        </div>
    </header>
    <div id="products-page" class="container">
        <h1>E-Shopping</h1>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search products...">
        </div>
        <div id="products">
	     <div class="product" data-name="Dolo" data-price="32" onclick="showQuantitySelector(this)">
    <img src="dolo.webp" alt="Dolo 650mg">
    <div class="product-info">
        <h3>Dolo 650mg - Strip of 15 tablets</h3>
        <p>Composition: Each uncoated tablet contains: Paracetamol IP 650mg. Dosage: As directed by physician</p>
        <p>Price: ₹32.00</p>
        <div class="product-buttons">
            <div class="quantity-selector">
                <button onclick="changeQuantity(this, -1)">-</button>
                <input type="number" value="1" min="1" onchange="showAddToCartButton(this)">
                <button onclick="changeQuantity(this, 1)">+</button>
            </div>
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
    </div>
</div>
            
            <<div class="product" data-name="Saridon" data-price="43" onclick="showQuantitySelector(this)">
    <img src="saridon.webp" alt="Saridon">
    <div class="product-info">
        <h3>Saridon - Strip of 10 tablets</h3>
        <p>Composition: CAFFEINE (50 MG) + PARACETAMOL/ACETAMINOPHEN (650 MG)</p>
        <p>Price: ₹43.00</p>
        <div class="product-buttons">
            <div class="quantity-selector">
                <button onclick="changeQuantity(this, -1)">-</button>
                <input type="number" value="1" min="1" onchange="showAddToCartButton(this)">
                <button onclick="changeQuantity(this, 1)">+</button>
            </div>
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
    </div>
</div>
<div class="product" data-name="Soframycin" data-price="44.62" onclick="showQuantitySelector(this)">
        <img src="soframycin.jpg" alt="Soframycin">
        <div class="product-info">
            <h3>Soframycin cream - 30gm</h3>
            <p>It is used for the treatment of skin, hair, and nail infections caused by bacteria</p>
            <p>Price: ₹44.62</p>
            <div class="product-buttons">
                <div class="quantity-selector">
                    <button onclick="changeQuantity(this, -1)">-</button>
                    <input type="number" value="1" min="1" onchange="showAddToCartButton(this)">
                    <button onclick="changeQuantity(this, 1)">+</button>
                </div>
                <button onclick="addToCart(this)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="product" data-name="Combiflam" data-price="40.52" onclick="showQuantitySelector(this)">
        <img src="combiflam.webp" alt="Combiflam">
        <div class="product-info">
            <h3>Combiflam Tablet - pack of 20 tablets</h3>
            <p>Composition: IBUPROFEN (400 MG) + PARACETAMOL/ACETAMINOPHEN (325 MG)</p>
            <p>Price: ₹40.52</p>
            <div class="product-buttons">
                <div class="quantity-selector">
                    <button onclick="changeQuantity(this, -1)">-</button>
                    <input type="number" value="1" min="1" onchange="showAddToCartButton(this)">
                    <button onclick="changeQuantity(this, 1)">+</button>
                </div>
                <button onclick="addToCart(this)">Add to Cart</button>
            </div>
        </div>
    </div>
    <div class="product" data-name="Zincovit" data-price="137.44" onclick="showQuantitySelector(this)">
        <img src="zincovit.jpg" alt="Zincovit">
        <div class="product-info">
            <h3>Zincovit Syrup - 200ml</h3>
            <p>Zincovit contains vitamins and minerals that restore the body's nutrient reserves and aid in the healthy functioning of the heart, nervous system, and immunity.</p>
            <p>Price: ₹137.44</p>
            <div class="product-buttons">
                <div class="quantity-selector">
                    <button onclick="changeQuantity(this, -1)">-</button>
                    <input type="number" value="1" min="1" onchange="showAddToCartButton(this)">
                    <button onclick="changeQuantity(this, 1)">+</button>
                </div>
                <button onclick="addToCart(this)">Add to Cart</button>
            </div>
        </div>
    </div>
<!-- View Cart Button -->
    <button class="view-cart-button" onclick="window.location.href='cart.php'">View Cart</button>
    <div id="cart-page" class="container">
        <h1>Your Cart</h1>
        <div id="cart-items">
            <!-- Cart items will be added here -->
        </div>
        <button onclick="checkout()">Checkout</button>
    </div>
    <script>
	document.getElementById('search-input').addEventListener('input', function() {
    const searchQuery = this.value.toLowerCase();
    const products = document.querySelectorAll('.product');

    products.forEach(function(product) {
        const productName = product.getAttribute('data-name').toLowerCase();
        if (productName.includes(searchQuery)) {
            product.style.display = 'flex'; // Show matching product
        } else {
            product.style.display = 'none'; // Hide non-matching product
        }
    });
});

	
        function showQuantitySelector(productElement) {
    const quantitySelector = productElement.querySelector('.quantity-selector');
    const buttons = productElement.querySelector('.product-buttons');
    quantitySelector.style.display = 'flex';
    buttons.style.display = 'flex';
}

function changeQuantity(button, change) {
    const input = button.parentElement.querySelector('input');
    let value = parseInt(input.value);
    value += change;
    if (value < 1) value = 1;
    input.value = value;
}

function showAddToCartButton(input) {
    const button = input.closest('.product').querySelector('button');
    button.style.display = 'inline-block';
}

function addToCart(button) {
    const product = button.closest('.product');
    const name = product.getAttribute('data-name');
    const price = parseFloat(product.getAttribute('data-price'));
    const quantity = parseInt(product.querySelector('input').value);
    const cartPrice = price * quantity;

    // Set default values for products
    const defaults = {
        'Dolo': { id: 1, name: 'Dolo', price: 32 },
        'Saridon': { id: 2, name: 'Saridon', price: 43 },
        'Soframycin': { id: 3, name: 'Soframycin', price: 44.62 },
        'Combiflam': { id: 4, name: 'Combiflam', price: 40.52 },
        'Zincovit': { id: 5, name: 'Zincovit', price: 137.44 }
    };

    // Use default values if product name matches the defaults
    const defaultValues = defaults[name] || { id: 0, name: name, price: price };
	
	
    
    // Send product details to PHP script via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response from the server
            if (xhr.responseText === "success") {
                alert(`${defaultValues.name} has been added to your cart!`);
                addCartItemToDisplay(defaultValues.name, defaultValues.price, quantity, cartPrice);
            } else {
                alert("Failed to add item to cart. " + xhr.responseText);
            }
        }
    };
    xhr.send(`product_id=${defaultValues.id}&product_name=${encodeURIComponent(defaultValues.name)}&quantity=${quantity}&cart_price=${cartPrice}`);
}

function removeFromCart(button) {
    button.parentElement.remove();
}

function checkout() {
    if (document.querySelectorAll('#cart-items .cart-item').length === 0) {
        alert('Your cart is empty!');
        return;
    }
    // Add your checkout logic here
    alert('Checkout functionality is being developed.');
}

function addCartItemToDisplay(name, price, quantity, cartPrice) {
    const cartItem = document.createElement('div');
    cartItem.className = 'cart-item';
    cartItem.innerHTML = `
        <p>${name} - Price: ₹${price.toFixed(2)} x ${quantity} = ₹${cartPrice.toFixed(2)}</p>
        <button onclick="removeFromCart(this)">Remove</button>
    `;
    document.getElementById('cart-items').appendChild(cartItem);
}

    </script>
</body>
</html>

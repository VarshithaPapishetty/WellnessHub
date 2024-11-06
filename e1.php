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
            padding: 10px 20px; /* Adjust padding for logo and contact */
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            display: flex; /* Flex container for logo, header text, and contact */
            align-items: center; /* Center vertically */
            justify-content: space-between; /* Align items from left to right with space in between */
            height: 160px; /* Decreased height by 1 inch (176 pixels) */
            font-family: "Garamond", cursive;
        }
         .back-button {
            background-color: #a3a375;/* Changed background color to match the header */
            color: black; /* Changed text color to black */
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            position: absolute;
            top: 10px;
            left: 10px;
	    margin-top:-0.1in;
        }

        .back-button:hover {
            background-color: #ddd; /* Light gray on hover */
        }

        .header img {
            height: 140px; /* Adjust height of logo */
            margin-right: 10px; /* Add space between logo and text */
        }

        .header h1 {
            margin: 0; /* Remove default margin */
            font-size: 45px; /* Adjust font size as needed */
            flex-grow: 1; /* Allow header text to grow and take remaining space */
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
            background-color: #333; /* Darker gray on hover */
        }

        .support-button img {
            height: 24px;
            margin-right: 5px; /* Adjust spacing between icon and text */
        }        .container {
            text-align: center;
            margin-top: 180px; /* Adjust margin to leave space for the fixed header */
        }


        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	    margin-top:1in;
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
            display: flex;
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
            display: flex;
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
    </style>
</head>
<body>
     <header>
        <div class="header">
	     <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>
            <img src="logo3.png" alt="Wellness Hub Logo" class="logo">
            <h1>E-Shoppping</h1>
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
        <div id="products-page" class="container">
            <!-- Product listing -->
            <button onclick="goToCart()">Go to Cart</button>
        </div>
        <div id="products">
            <div class="product" data-id="1" data-name="Dolo 650mg" data-description="Each uncoated tablet contains: Paracetamol IP 650mg. Dosage: As directed by physician" data-price="28.00">
                <img src="dolo.webp" alt="Dolo 650mg">
                <div class="product-info">
                    <h3>Dolo 650mg - Strip of 15 tablets</h3>
                    <p>Composition: Each uncoated tablet contains: Paracetamol IP 650mg. Dosage: As directed by physician</p>
                    <p>Price: ₹28.00</p>
                    <div class="product-buttons">
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" value="1" min="1">
                            <button onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button onclick="addToCart(this)">Add to Cart</button>
                    </div>
                </div>
            </div>            <div class="product" data-name="Saridon" data-description="CAFFEINE (50 MG) + PARACETAMOL/ACETAMINOPHEN (650 MG)" data-price="43.00">
                <img src="saridon.webp" alt="Saridon">
                <div class="product-info">
                    <h3>Saridon - Strip of 10 tablets</h3>
                    <p>Composition: CAFFEINE (50 MG) + PARACETAMOL/ACETAMINOPHEN (650 MG)</p>
                    <p>Price: ₹43.00</p>
                    <div class="product-buttons">
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" value="1" min="1">
                            <button onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button onclick="addToCart(this)">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="product" data-name="Soframycin" data-description="It is used for the treatment of skin, hair, and nail infections caused by bacteria" data-price="44.62">
                <img src="soframycin.jpg" alt="Soframycin">
                <div class="product-info">
                    <h3>Soframycin cream - 30gm</h3>
                    <p>It is used for the treatment of skin, hair, and nail infections caused by bacteria</p>
                    <p>Price: ₹44.62</p>
                    <div class="product-buttons">
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" value="1" min="1">
                            <button onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button onclick="addToCart(this)">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="product" data-name="Combiflam" data-description="IBUPROFEN (400 MG) + PARACETAMOL/ACETAMINOPHEN (325 MG)" data-price="40.52">
                <img src="combiflam.webp" alt="Combiflam Tablet">
                <div class="product-info">
                    <h3>Combiflam Tablet - pack of 20 tablets</h3>
                    <p>Composition: IBUPROFEN (400 MG) + PARACETAMOL/ACETAMINOPHEN (325 MG)</p>
                    <p>Price: ₹40.52</p>
                    <div class="product-buttons">
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" value="1" min="1">
                            <button onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button onclick="addToCart(this)">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="product" data-name="Zincovit" data-description="Zincovit contains vitamins and minerals that restore the body's nutrient reserves and aid in the healthy functioning of the heart, nervous system, and immunity." data-price="137.44">
                <img src="zincovit.jpg" alt="Zincovit Syrup">
                <div class="product-info">
                    <h3>Zincovit Syrup - 200ml</h3>
                    <p>Zincovit contains vitamins and minerals that restore the body's nutrient reserves and aid in the healthy functioning of the heart, nervous system, and immunity.</p>
                    <p>Price: ₹137.44</p>
                    <div class="product-buttons">
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(this, -1)">-</button>
                            <input type="number" value="1" min="1">
                            <button onclick="changeQuantity(this, 1)">+</button>
                        </div>
                        <button onclick="addToCart(this)">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-page" class="container">
        <h1>Your Cart</h1>
        <div id="cart-items">
            <!-- Cart items will be displayed here -->
        </div>
        <button onclick="goBack()">Back to Shopping</button>
    </div>

    <script>
        let cart = [];

        function changeQuantity(button, delta) {
            const quantityInput = button.parentElement.querySelector('input');
            let currentValue = parseInt(quantityInput.value);
            currentValue += delta;
            if (currentValue < 1) currentValue = 1; // Ensure the quantity is at least 1
            quantityInput.value = currentValue;
        }

        function addToCart(button) {
            const productElement = button.closest('.product');
            const productName = productElement.getAttribute('data-name');
            const productPrice = parseFloat(productElement.getAttribute('data-price'));
            const productQuantity = parseInt(productElement.querySelector('.quantity-selector input').value);

            const existingProduct = cart.find(product => product.name === productName);

            if (existingProduct) {
                existingProduct.quantity += productQuantity;
            } else {
                cart.push({ name: productName, price: productPrice, quantity: productQuantity });
            }

            alert('Added to cart: ' + productName);
            console.log(cart);

            // Open cart page after adding the product
            displayCart();
        }
	function sendToServer(productId, productName, productPrice, productQuantity) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Server response:', xhr.responseText);
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };
            xhr.send(`id=${productId}&name=${productName}&price=${productPrice}&quantity=${productQuantity}`);
        }
        function displayCart() {
            const cartPage = document.getElementById('cart-page');
            const productsPage = document.getElementById('products-page');
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';

            cart.forEach(product => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                    <p>${product.name}</p>
                    <p>Price: ₹${product.price.toFixed(2)}</p>
                    <p>Quantity: ${product.quantity}</p>
                    <p>Total: ₹${(product.price * product.quantity).toFixed(2)}</p>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            productsPage.style.display = 'none';
            cartPage.style.display = 'block';
        }

        function goBack() {
            const cartPage = document.getElementById('cart-page');
            const productsPage = document.getElementById('products-page');
            cartPage.style.display = 'none';
            productsPage.style.display = 'block';
        }

        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const products = document.querySelectorAll('.product');
            
            products.forEach(function(product) {
                const name = product.getAttribute('data-name').toLowerCase();
                const description = product.getAttribute('data-description').toLowerCase();
                
                if (name.includes(query) || description.includes(query)) {
                    product.style.display = 'flex';
                } else {
                    product.style.display = 'none';
                }
            });
        });
        function addToCart(button) {
            const productElement = button.closest('.product');
            const productName = productElement.getAttribute('data-name');
            const productPrice = parseFloat(productElement.getAttribute('data-price'));
            const productQuantity = parseInt(productElement.querySelector('.quantity-selector input').value);

            const existingProduct = cart.find(product => product.name === productName);

            if (existingProduct) {
                existingProduct.quantity += productQuantity;
            } else {
                cart.push({ name: productName, price: productPrice, quantity: productQuantity });
            }

            alert('Added to cart: ' + productName);
            console.log(cart);

            // Store cart items in local storage
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function goToCart() {
            window.location.href = 'cart.html';
        }

    </script>
</body>
</html>

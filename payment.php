<?php
session_start(); // Start the session

// Get the total amount from the session
$total_amount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : 0.00;
?>
<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
	font-family: Arial;
	font-size: 17px;
	padding: 8px;
}

* {
	box-sizing: border-box;
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


.row {
	display: -ms-flexbox; /* IE10 */
	display: flex;
	-ms-flex-wrap: wrap; /* IE10 */
	flex-wrap: wrap;
	margin: 0 -16px;
}

.col-25 {
	-ms-flex: 25%; /* IE10 */
	flex: 25%;
}

.col-50 {
	-ms-flex: 50%; /* IE10 */
	flex: 50%;
}

.col-75 {
	-ms-flex: 75%; /* IE10 */
	flex: 75%;
}

.col-25, .col-50, .col-75 {
	padding: 0 16px;
}

.container {
	background-color: #f2f2f2;
	padding: 5px 20px 15px 20px;
	border: 1px solid lightgrey;
	border-radius: 3px;
}

input[type=text] {
	width: 100%;
	margin-bottom: 20px;
	padding: 12px;
	border: 1px solid #ccc;
	border-radius: 3px;
}

label {
	margin-bottom: 10px;
	display: block;
}

.icon-container {
	margin-bottom: 20px;
	padding: 7px 0;
	font-size: 24px;
}

.btn {
	background-color: #4CAF50;
	color: white;
	padding: 12px;
	margin: 10px 0;
	border: none;
	width: 100%;
	border-radius: 3px;
	cursor: pointer;
	font-size: 17px;
}

.btn:hover {
	background-color: #45a049;
}

a {
	color: #2196F3;
}

hr {
	border: 1px solid lightgrey;
}

span.price {
	float: right;
	color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media ( max-width : 800px) {
	.row {
		flex-direction: column-reverse;
	}
	.col-25 {
		margin-bottom: 20px;
	}
}

/* Success message box */
.success-message {
	display: none;
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background-color: #d4edda;
	color: #155724;
	padding: 20px;
	border: 1px solid #c3e6cb;
	border-radius: 5px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	z-index: 1000;
	text-align: center;
}

.success-message i {
	color: #28a745;
	font-size: 24px;
}
</style>
</head>
<body>
	<header>
        <div class="header">
            <button class="back-button" onclick="window.location.href='cart.php'">←Back</button>
            <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>
            <h1>Your Payment</h1>
            <div class="support">
                <button class="support-button" onclick="callSupport()">
                    <img src="phone2.png" alt="Phone Icon">
                    Contact Us: (123) 456-7890
                </button>
            </div>
        </div>
    </header>
<br>
<br>
<br>
<br>
	<h2>Complete Your Payment Here</h2>
	<div class="row">
		<div class="col-75">
			<div class="container">
				<form method="post" onSubmit="return paid()" name="payment"
					id="payment-form" action="/ordersubmit">
					
					<div class="row">
						<div class="col-50">
							<h3>Billing Address</h3>
							<label for="fname"><i class="fa fa-user"></i> Full Name</label> <input
								type="text" pattern="[a-zA-Z\s]+" id="fname" name="firstname"
								placeholder="John M. Doe" required="required"> <label
								for="email"><i class="fa fa-envelope"></i> Email</label> <input
								type="text" id="email" name="email"
								pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"
								placeholder="john@example.com" required="required"> <label
								for="adr"><i class="fa fa-address-card-o"></i>Address</label> <input
								type="text" id="adr" name="address"
								placeholder="542 W. 15th Street" required="required"> <label
								for="city"><i class="fa fa-institution"></i> City</label> <input
								type="text" pattern="[a-zA-Z\s]+" id="city" name="city"
								placeholder="New York" required="required">

							<div class="row">
								<div class="col-50">
									<label for="state">State</label> <input type="text"
										pattern="[a-zA-Z\s]+" id="state" name="state" placeholder="NY"
										required="required">
								</div>
								<div class="col-50">
									<label for="zip">Zip</label> <input type="text" id="zip"
										name="zip" pattern="[1-9]{1}[0-9]{4}" placeholder="10001"
										required="required">
								</div>
							</div>
						</div>

						<div class="col-50">
							<h3>Payment</h3>
							<label for="fname">Accepted Cards</label>
							<div class="icon-container">
								<i class="fa fa-cc-visa" style="color: navy;"></i> <i
									class="fa fa-cc-amex" style="color: blue;"></i> <i
									class="fa fa-cc-mastercard" style="color: red;"></i> <i
									class="fa fa-cc-discover" style="color: orange;"></i>
							</div>
							<label for="cname">Name on Card</label> <input type="text"
								pattern="[a-zA-Z\s]+" id="cname" name="cardname"
								placeholder="John More Doe" required="required"> <label
								for="ccnum">Credit card number</label> <input type="text"
								id="ccnum" name="cardnumber" pattern="[1-9]{1}[0-9]{15}"
								placeholder="1111222233334444" required="required"> <label
								for="expmonth">Exp Month</label> <input type="number"
								id="expmonth" name="expmonth" min="01" max="12" placeholder="02"
								required="required">
							<div class="row">
								<div class="col-50">
									<label for="expyear">Exp Year</label> <input type="text"
										id="expyear" name="expyear" pattern="^[23]\d{1}$"
										placeholder="20" required="required">
								</div>
								<div class="col-50">
									<label for="cvv">CVV</label> <input type="text" id="cvv"
										name="cvv" pattern="[0-9]{3}" placeholder="352"
										required="required">
								</div>
								<div class="col-50">
									<label for="amount">Amount</label> <input type="text"
										id="amount" name="amount"
										value="<?php echo number_format($total_amount, 2); ?>"
										required="required" readonly="readonly">
								</div>
							</div>
						</div>
					</div>
					<label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
					<input type="submit" value="Pay" class="btn">
				</form>
			</div>
		</div>
	</div>
	<!-- Success Message Box -->
	<div id="success-message" class="success-message">
		<i class="fa fa-check-circle"></i>
		<p>Payment Done Successfully!</p>
	</div>
	<script>
	function paid() {
		// Prevent the default form submission
		event.preventDefault();
		// Display the success message
		document.getElementById('success-message').style.display = 'block';
		// Optionally, you can redirect after a delay
		setTimeout(function() {
			window.location.href = 'dashboard.php';
		}, 5000);
		return false; // Prevent the form from submitting
	}
	</script>
</body>
</html>

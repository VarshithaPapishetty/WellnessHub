<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            background-color: white; /* Background color */
            color: #000000; /* Text color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            height: 180px; /* Set header height */
            padding: 20px; /* Adjusted padding */
            color: rgb(12, 12, 12);
            display: flex;
            flex-direction: column; /* Arrange elements in a column */
            justify-content: flex-start; /* Align elements at the top initially */
            width: 100%;
            background-color: #a3a375;
            box-sizing: border-box;
            position: relative; /* Relative positioning for absolute children */
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
            height: 100%;
        }

        .logo {
            height: 150px; /* Adjust the size of the logo */
            position: absolute;
            left: 20px;
            top: -12px; /* Moved 1 inch (96px) up from the original 30px */
        }

        .header-container h1 {
            margin: 0;
            text-align: center;
            font-size: 50px;
            font-family: "Garamond", cursive;
        }

        .support {
            display: flex;
            align-items: center;
            font-size: 1em;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .support-button {
            background-color: #000000;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: white;
            padding: 8px 15px;
        }

        .support-button:hover {
            color: #45a049;
        }

        .support-button img {
            height: 24px;
            margin-right: 5px;
        }

        .dashboard-options {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between options */
            position: absolute;
            bottom: 10px; /* Move options to the bottom within the header */
            width: 100%;
        }

        .option a {
            text-decoration: none;
            color: black; /* Link color */
            font-size: 14px; /* Font size for options */
            padding: 8px 15px; /* Padding for options */
            border: 2px solid white;
            border-radius: 10px;
            display: inline-block; /* Display as inline block */
            white-space: nowrap; /* Prevent wrapping */
        }

        .option a:hover {
            background-color: white;
            color: black;
        }

        .slideshow {
            position: relative;
            width: 100%;
            height: 530px; /* Adjust the height as needed */
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            animation: slide 15s infinite;
        }

        .slide1 {
            background-image: url('scroll9.jpg'); /* Replace with your image path */
            animation-delay: 0s;
        }

        .slide2 {
            background-image: url('scroll8.jpeg'); /* Replace with your image path */
            animation-delay: 5s;
        }

        .slide3 {
            background-image: url('scroll4.jpg'); /* Replace with your image path */
            animation-delay: 10s;
        }

        @keyframes slide {
            0%, 33.33% {
                opacity: 1;
            }
            33.34%, 100% {
                opacity: 0;
            }
        }

        @media (max-width: 600px) {
            .header-container h1 {
                font-size: 30px; /* Smaller font size for smaller screens */
            }
            .option a {
                font-size: 12px;
                padding: 6px 10px;
            }
            .dashboard-options {
                flex-direction: column; /* Stack options vertically on small screens */
                align-items: center;
                bottom: auto; /* Reset bottom position */
                position: static; /* Reset positioning */
                padding-top: 20px; /* Add padding */
            }
        }
	.logout-button {
            background-color: #000000; /* Background color for button */
            color: white; /* Text color for button */
            border: none; /* Remove border */
            border-radius: 50%; /* Make button round */
            padding: 10px 20px; /* Adjust padding as needed */
            font-size: 14px; /* Font size */
            cursor: pointer; /* Pointer cursor on hover */
            position: absolute; /* Positioning */
            right: 20px; /* Distance from the right edge */
            bottom: 20px; /* Distance from the bottom edge */
            z-index: 10; /* Ensure it's on top of other elements */
        }

        .logout-button:hover {
            background-color: #45a049; /* Change background color on hover */
        }    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="logo3.png" alt="Wellness Hub Logo" class="logo">
            <h1>Your Dashboard</h1>
            <div class="support">
                <button class="support-button" onclick="callSupport()">
                    <img src="phone2.png" alt="Phone Icon">
                    Contact Us: (123) 456-7890
                </button>
            </div>
		<button class="logout-button" onclick="window.location.href='index.php'">Log-Out</button>
        </div>
        <div class="dashboard-options">
            <div class="option">
                <a href="book-appointment.php" aria-label="Book an Appointment">Book an Appointment</a>
            </div>
            <div class="option">
                <a href="ai-doctor-chatbot.php">AI Doctor Chat Bot</a>
            </div>
            <div class="option">
                <a href="bmi.php" aria-label="Fitness Tracker">Fitness Tracker</a>
            </div>
            <div class="option">
                <a href="e-shopping.php" aria-label="E-Shopping">E-Shopping</a>
            </div>
        </div>
    </header>
    
    <div class="slideshow">
        <div class="slide slide1"></div>
        <div class="slide slide2"></div>
        <div class="slide slide3"></div>
    </div>

    <div class="dashboard-container">
        <!-- Additional content can go here -->
    </div>

    <script>
        function callSupport() {
            window.location.href = "tel:+11234567890";
        }
    </script>
</body>
</html>

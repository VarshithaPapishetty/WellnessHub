<?php
// Start session to store hospital_id
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Hospitals</title>
    <style>
        /* CSS styles for the entire page */
        body {
            background-color: #f0f0f0; /* Background acolor */
            color: black; /* Text color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            flex-direction: column; /* Align items in a column */
            height: 100vh;
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

        .hospital-list {
            text-align: left;
            width: 800px; /* Increased width for the hospital list */
            margin-top: 20px;
        }

        .hospital-item {
            display: flex;
            align-items: center; /* Center items vertically */
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px; /* Padding around each hospital item */
            margin-bottom: 20px; /* Adjust spacing between hospital items */
            cursor: pointer; /* Add pointer cursor to indicate clickable */
        }

        .hospital-item .logo {
            flex: 0 0 120px; /* Fixed width for the logo */
            margin-right: 20px; /* Space between logo and description */
        }

        .hospital-item .logo img {
            max-width: 100%; /* Ensure the logo fits within the fixed width */
            height: auto; /* Maintain aspect ratio */
        }

        .hospital-item .hospital-details {
            flex-grow: 1; /* Hospital details take remaining space */
        }

        .hospital-item h2 {
            margin-top: 0; /* Remove top margin for consistency */
        }

        .hospital-item p {
            margin-bottom: 10px; /* Space between paragraphs */
        }
    </style>
</head>
<body>
    <div class="header">
    <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>
    <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>
    <h1>List of Hospitals</h1>
    <div class="support">
        <button class="support-button" onclick="callSupport()">
            <img src="phone2.png" alt="Phone Icon">
            Contact Us: (123) 456-7890
        </button>
    </div>
</div>

    <br>
    <div class="container">
        <div class="hospital-list">
            <br>
            <br>
            <div class="hospital-item" onclick="window.location.href='apollo.php'">
                <div class="logo">
                    <img src="apollologo.png" alt="Apollo Logo"> <!-- Replace with actual logo -->
                </div>
                <div class="hospital-details">
                    <h2>Apollo Hospitals</h2>
                    <p>Location: Jubilee Hills, Hyderabad, Telangana, India</p>
                    <p>Contact: +1234567890</p>
                    <p>Email: apollo@cityhospital.com</p>
                </div>
            </div>
            <div class="hospital-item" onclick="window.location.href='kims.php'">
                <div class="logo">
                    <img src="kimslogo.jpg" alt="Kims Logo"> <!-- Replace with actual logo -->
                </div>
                <div class="hospital-details">
                    <h2>Kims Hospital</h2>
                    <p>Location: Secunderabad, Hyderabad, Telangana, India</p>
                    <p>Contact: +9234567890 </p>
                    <p>Email: kims@cityhospital.com</p>
                </div>
            </div>
            <div class="hospital-item" onclick="window.location.href='kamineni.php'">
                <div class="logo">
                    <img src="kaminenilogo.png" alt="Kamineni Logo"> <!-- Replace with actual logo -->
                </div>
                <div class="hospital-details">
                    <h2>Kamineni Hospitals</h2>
                    <p>Location: LB Nagar, Hyderabad, Telangana, India</p>
                    <p>Contact: +9876543212</p>
                    <p>Email: kamineni@cityhospital.com</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to call support
        function callSupport() {
            alert("Calling support at (123) 456-7890");
        }
    </script>
</body>
</html>
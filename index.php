<?php
session_start();

// Initialize variables and connect to database
$username = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '@Sreedhar123', 'tbp');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login form submission
if (isset($_POST['login_user'])) {
    // Get form input values and sanitize
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Validate form input
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Check database for matching username and password
    if (count($errors) == 0) {
        $password = md5($password); // Encrypt the password
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (!$results) {
            die('Query Failed: ' . mysqli_error($db));
        }

        // If user found, set session variables and redirect
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_assoc($results);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['success'] = "You are now logged in";
            header('location: dashboard.php'); // Redirect to dashboard or desired page
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Hub</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            padding: 60px 20px;
            color: rgb(12, 12, 12);
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background-color: #a3a375;
            box-sizing: border-box;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 900;
            position: relative;
        }

        .logo {
            height: 150px; /* Adjust the size of the logo as needed */
            position: absolute;
            left: 20px;
        }

        .header-container h1 {
            margin: 0;
            text-align: center;
            width: 100%;
            font-size: 50px;
            margin-left: 2in;
            font-family: "Garamond", cursive;
        }

        .support {
            display: flex;
            align-items: center;
            font-size: 1em;
        }

        .support-button {
            background-color: #000000;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: white;
        }

        .support-button:hover {
            color: #45a049;
        }

        .support-button img {
            height: 24px;
            margin-right: 5px;
        }

        .login-container {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
            backdrop-filter: blur(10px);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
        }

        a {
            color: black; /* Changed text color to black */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <img src="logo3.png" alt="Wellness Hub Logo" class="logo">
        <h1>Wellness Hub</h1>
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
<div class="login-container">
    <form method="post" action="index.php">
        <?php include('errors.php'); ?>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login_user">Login</button>
        <p>Don't have an account? <a href="signup.php" style="color: black;">Sign Up</a></p>
    </form>
</div>
<script>
    function callSupport() {
        // Implement your call support function here
        // You can use JavaScript to make a call or open a support page
        console.log("Calling support...");
    }
</script>
</body>
</html>

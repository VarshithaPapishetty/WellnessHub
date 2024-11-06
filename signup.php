<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables and connect to database
$username = "";
$email    = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '@Sreedhar123', 'tbp');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle registration form submission
if (isset($_POST['reg_user'])) {
    // Get form input values and sanitize
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Validate form input
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Check database for existing user with same username or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    if (!$result) {
        die('Query Failed: ' . mysqli_error($db));
    }

    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['username'] == $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] == $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Register user if no errors
    if (count($errors) == 0) {
        // Encrypt the password (consider using password_hash for better security)
        $password = md5($password_1);
        
        // Insert user details into database
        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die('Query Failed: ' . mysqli_error($db));
        }

        // Set session variables and redirect
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php'); // Redirect to index.php after successful registration
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Hub - Sign Up</title>
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
            height: 150px;
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

        .signup-container {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.5);
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
        input[type="email"],
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
            color: black;
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
    <div class="signup-container">
        <form method="post" action="signup.php">
            <?php include('errors.php'); ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password_1">Password:</label>
                <input type="password" id="password_1" name="password_1" required>
            </div>
            <div class="form-group">
                <label for="password_2">Confirm Password:</label>
                <input type="password" id="password_2" name="password_2" required>
            </div>
            <button type="submit" name="reg_user">Sign Up</button>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </form>
    </div>
    <script>
        function callSupport() {
            console.log("Calling support...");
        }
    </script>
</body>
</html>

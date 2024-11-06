<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Your Goals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('fitpic3.webp');
            background-size: cover;
            background-position: center;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #d9d9d9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin: 20px 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group .scrollable {
            max-height: 100px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group .radio-group {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        .form-group .radio-group label {
            background-color: #ddd;
            color: #333;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-bottom: 5px;
            text-align: center;
            font-size: 0.9em;
        }

        .form-group .radio-group input[type="radio"] {
            display: none;
        }

        .form-group .radio-group input[type="radio"]:checked + label {
            background-color: #bbb;
        }

        #submitBtn {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="logo3.png" alt="Wellness Hub Logo" class="logo">
            <h1>Fitness: Our Ultimate Health Priority</h1>
            <div class="support">
                <button class="support-button" onclick="callSupport()">
                    <img src="phone2.png" alt="Phone Icon">
                    Contact Us: (123) 456-7890
                </button>
            </div>
        </div>
    </header>
    <div class="container">
        <h1>Set Your Goals</h1>
        <form id="goalForm">
            <div class="form-group">
                <label for="gender">Gender:</label>
                <div class="scrollable">
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="male" required>
                        <label for="male">Male</label>
                        
                        <input type="radio" id="female" name="gender" value="female" required>
                        <label for="female">Female</label>
                        
                        <input type="radio" id="other" name="gender" value="other" required>
                        <label for="other">Other</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="currentWeight">Current Weight (kg):</label>
                <input type="number" id="currentWeight" name="currentWeight" required>
            </div>
            <div class="form-group">
                <label for="currentHeight">Height (ft):</label>
                <input type="number" id="currentHeight" name="currentHeight" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <button type="submit" id="submitBtn">Submit</button>
        </form>
    </div>
    <script>
        document.getElementById('goalForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const currentWeight = parseInt(document.getElementById('currentWeight').value);
            const currentHeight = parseInt(document.getElementById('currentHeight').value);
            const age = parseInt(document.getElementById('age').value);

            if (currentWeight >= 60 && currentHeight < 5 && age < 30) {
                window.location.href = 'todo.php';
            } else if (currentWeight >= 60 && currentHeight < 5 && age >= 30) {
                window.location.href = 'todo4.php';
            } 
            else if (currentWeight >= 60 && currentHeight >= 5 && age >= 30) {
                window.location.href = 'todo5.php';}
            else if (currentWeight >= 60 && currentHeight >= 5 && age < 30) {
                window.location.href = 'todo6.php';}
            else if (currentWeight < 60 && currentHeight < 5 && age < 30) {
                    window.location.href = 'todo7.php';}
            else if (currentWeight < 60 && currentHeight < 5 && age >= 30) {
                    window.location.href = 'todo8.php';}
            else if (currentWeight < 60 && currentHeight >= 5 && age >= 30) {
                    window.location.href = 'todo9.php';}
            else if (currentWeight < 60 && currentHeight >= 5 && age < 30) {
                    window.location.href = 'todo10.php';}
            else {
                alert('Please check your inputs.');
            }
        });
    </script>
</body>
</html>

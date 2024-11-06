<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker</title>
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
            background-color: rgba(255, 255, 255, 0); /* Transparent background */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	    margin-top:2.5in;
        }

        h1 {
            text-align: center;
        }

        .goal {
            text-align: center;
            margin-top: 20px;
        }

        .goal label {
            display: block;
            width: 300px;
            padding: 10px;
            background-color: #fff; /* White background */
            color: #000; /* Black text */
            border-radius: 5px;
            margin: 5px auto;
            cursor: pointer;
            text-align: center;
            border: 2px solid #000000; /* Black outline */
        }

        .goal input[type="radio"] {
            display: none;
        }

        .goal input[type="radio"]:checked + label {
            background-color: #4CAF50; /* Green background when checked */
            border-color: #000000; /* Black outline */
            color: #000; /* Black text */
        }

        #nextBtn {
            display: none;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
	    margin-left:7.5in;
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
	     <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>
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
        <h1>Fitness Tracker</h1>
        <div class="goal">
            <h2>What is your goal?</h2>
            <input type="radio" id="loseWeight" name="goal" value="loseWeight">
            <label for="loseWeight">Lose Weight</label>

            <input type="radio" id="muscleGain" name="goal" value="muscleGain">
            <label for="muscleGain">Muscle Gain</label>

            <input type="radio" id="modifyDiet" name="goal" value="modifyDiet">
            <label for="modifyDiet">Modify Diet</label>

            <button id="nextBtn">Next</button>
        </div>
    </div>

    <script>
        const goalInputs = document.querySelectorAll('.goal input[type="radio"]');
        const nextBtn = document.getElementById('nextBtn');

        goalInputs.forEach(input => {
            input.addEventListener('change', () => {
                nextBtn.style.display = 'block';
            });
        });

        nextBtn.addEventListener('click', () => {
            const selectedGoal = document.querySelector('.goal input[type="radio"]:checked').value;
            if (selectedGoal === 'loseWeight') {
                window.location.href = 'goals.php?goal=' + selectedGoal;
            } 
            else if(selectedGoal === 'muscleGain') {
                window.location.href = 'goals2.php?goal=' + selectedGoal;
            }
            else {
                window.location.href = 'goals3.php?goal=' + selectedGoal;
            }
        });
    </script>
</body>
</html>

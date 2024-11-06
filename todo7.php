<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List for Losing Weight</title>
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

        .info-list {
            margin-top: 20px;
            padding: 10px;
            background-color: #d9d9d9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .info-item {
            padding: 10px 0;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .todo-list {
            margin-top: 20px;
        }

        .todo-item {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
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
        <h1>Based on inputs, Your Todo list is:</h1>
        <div id="infoList" class="info-list"></div>
        <div id="todoList" class="todo-list"></div>
    </div>
    <script>
                // Generate to-do list items
        const todoList = [
            '1. Mental Health: Practice stress-reducing activities like meditation, yoga, or deep breathing exercises.',
            '2. Consult a Healthcare Professional :Schedule an appointment with your doctor or a dietitian to get personalized advice based on your specific needs and health status.',
            '3. Drink plenty of water.',
            '4. Monitor your progress weekly.',
            '5. Get adequate sleep.',
            '6. Stay motivated and consistent.'
        ];

        const todoListContainer = document.getElementById('todoList');
        todoList.forEach(item => {
            const todoItem = document.createElement('div');
            todoItem.className = 'todo-item';
            todoItem.textContent = item;
            todoListContainer.appendChild(todoItem);
        });
    </script>
</body>
</html>

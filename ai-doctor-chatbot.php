<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Doctor Chat Bot</title>
    <style>
         body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-y: auto; /* Make the page scrollable */
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #a3a375;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            position: relative;
            top: -0.1in; /* Move header 1 inch up */
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo {
            height: 120px;
            margin-right: 20px;
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
	    margin-top:-0.2in;
	    margin-left:-0.4in;
        }

        .back-button:hover {
            background-color: #ddd; /* Light gray on hover */
        }


        .support {
            margin-left: auto;
            display: flex;
            align-items: center;
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
        }

        .support-button img {
            height: 24px;
            margin-right: 5px;
        }

        .container {
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            font-size: 45px; /* Adjusted font size */
            font-family: 'Times New Roman', Times, serif; /* Adjusted font family */
        }
	 h2 {
            text-align: center;
            font-size: 30px; /* Adjusted font size */
            font-family: 'Times New Roman', Times, serif; /* Adjusted font family */
		margin-bottom: 2in; /* Move the h2 element 1 inch up */
        }


        .chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }

        .user-message {
            text-align: right;
            color: #007bff;
        }

        .bot-message {
            text-align: left;
            color: #28a745;
        }

        .message {
            margin-bottom: 10px;
        }

       input[type="text"] {
            width: calc(100% - 70px);
            padding: 8px;
            border-radius: 0; /* Make the corners square */
            border: 1px solid #ccc;
            height: 100px; /* Set a fixed height */
	    margin-top: -2in;
        }

        input[type="submit"] {
            width: 60px;
            padding: 8px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .image-container {
            margin-top: 0.1in;
	margin-left: 2.5in;
            text-align: left;
            position: absolute;
            left: 2in;
        }

        .image-container img {
            width: 140px; /* Adjust image width as needed */
            height: 130px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
    <div class="header-container">
        <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>
        <a href="dashboard.php">
            <img src="logo3.png" alt="Wellness Hub Logo" class="logo">
        </a>
        <h1 style="position: absolute; right: 6.3in;">Your AI Doctor</h1>
        <div class="support">
            <button class="support-button" onclick="callSupport()">
                <img src="phone2.png" alt="Phone Icon">
                Contact Us: (123) 456-7890
            </button>
        </div>
    </div>
</header>
<h2>Ask your AI here...</h2>
    <input type="text" id="text">
    <br>
    <br>
    <button onclick="generateResponse();">Generate Response</button>
    <br>
    <br>
    <div id="response"></div>

    <div class="image-container">
        <img src="aipic.webp" alt="Your Image">
    </div>

    <script>
        function generateResponse(){
            var text=document.getElementById("text")
            var response =document.getElementById("response")

            fetch("response.php",{
                method: "post",
                body: JSON.stringify({
                    text: text.value,
                }),
            }).then(res=>res.text()).then(res=>{
                response.innerHTML = res;
            });
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BMI Calculator</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap");

      :root {
        --underweight: orange;
        --normal: green;
        --overweight: lightcoral;
        --obese: crimson;
      }

      * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        font-family: "Jost", sans-serif;
      }

      body {
	background: url('fitpic.webp') no-repeat center center fixed;
        background-size: cover;
        display: grid;
        place-items: center;
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
        background-color: #a3a375; /* Changed background color to match the header */
        color: black; /* Changed text color to black */
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
      }
      .container {
        text-align: center;
        margin-top: 180px; /* Adjust margin to leave space for the fixed header */
      }

      h1 {
        text-align: center;
      }

      .container {
        width: 90%;
        max-width: 420px;
        background: #fff;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.25);
        display: grid;
        gap: 1rem;
      }

      .calculator {
        display: grid;
        gap: 1rem;
      }

      .calculator div {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .calculator label {
        flex: 0 1 120px;
        font-weight: 600;
      }

      .calculator input {
        flex: 1;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        outline-color: #555;
        font-size: 1.25rem;
        text-align: center;
      }

      .calculator button {
        width: 50%;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        padding: 10px;
        background: #00a1a3;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      .calculator button[type="reset"] {
        background: #444;
      }

      .calculator button:hover {
        filter: brightness(120%);
      }

      .output {
        text-align: center;
      }

      .output #bmi {
        font-size: 4rem;
      }

      .output #desc strong {
        text-transform: uppercase;
      }

      .bmi-scale {
        display: flex;
      }

      .bmi-scale div {
        flex: 1;
        text-align: center;
        text-transform: uppercase;
        border-top: 5px solid var(--color);
        padding: 10px;
      }

      .bmi-scale h4 {
        font-size: 0.75rem;
        color: slategray;
      }

      .underweight {
        color: var(--underweight);
      }

      .healthy {
        color: var(--normal);
      }

      .overweight {
        color: var(--overweight);
      }

      .obese {
        color: var(--obese);
      }

      #view-todo {
        margin-top: 1rem;
        padding: 10px 20px;
        background-color: #00a1a3;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: none; /* Hide the button initially */
        transition: background-color 0.3s;
      }

      #view-todo:hover {
        background-color: #007d7f;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <button class="back-button" onclick="window.location.href='dashboard.php'">←Back</button>

      <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>
      <!-- Replace with your actual logo path -->
      <h1>Your BMI Calculator</h1>
      <div class="support">
        <button class="support-button" onclick="callSupport()">
          <img src="phone2.png" alt="Phone Icon" />
          Contact Us: (123) 456-7890
        </button>
      </div>
    </div>

    <div class="container">
      <form class="calculator">
        <div>
          <label for="weight">Weight (kg)</label>
          <input type="number" id="weight" min="0" step="0.01" value="0" />
        </div>

        <div>
          <label for="height">Height (cm)</label>
          <input type="number" id="height" min="0" step="0.01" value="0" />
        </div>

        <div>
          <button type="reset">Reset</button>
          <button type="submit">Submit</button>
        </div>
      </form>

      <section class="output">
        <h3>Your BMI is</h3>
        <p id="bmi">0</p>
        <p id="desc">N/A</p>
        <button id="view-todo" onclick="window.location.href='todo.php'">View Your To-Do List</button>
      </section>

      <section class="bmi-scale">
        <div style="--color: var(--underweight)">
          <h4>Underweight</h4>
          <p>&lt; 18.5</p>
        </div>

        <div style="--color: var(--normal)">
          <h4>Normal</h4>
          <p>18.5 – 25</p>
        </div>

        <div style="--color: var(--overweight)">
          <h4>Overweight</h4>
          <p>25 – 30</p>
        </div>

        <div style="--color: var(--obese)">
          <h4>Obese</h4>
          <p>≥ 30</p>
        </div>
      </section>
    </div>
  </body>
  <script>
    const bmiText = document.getElementById("bmi");
    const descText = document.getElementById("desc");
    const form = document.querySelector("form");
    const viewTodoButton = document.getElementById("view-todo");

    form.addEventListener("submit", onFormSubmit);
    form.addEventListener("reset", onFormReset);

    function onFormReset() {
      bmiText.textContent = 0;
      bmiText.className = "";
      descText.textContent = "N/A";
      viewTodoButton.style.display = "none"; // Hide the button on reset
    }

    function onFormSubmit(e) {
      e.preventDefault();

      const weight = parseFloat(form.weight.value);
      const height = parseFloat(form.height.value);

      if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
        alert("Please enter a valid weight and height");
        return;
      }

      const heightInMeters = height / 100; // cm -> m
      const bmi = weight / Math.pow(heightInMeters, 2);
      const desc = interpretBMI(bmi);

      bmiText.textContent = bmi.toFixed(2);
      bmiText.className = desc;
      descText.innerHTML = `You are <strong>${desc}</strong>`;
      viewTodoButton.style.display = "inline-block"; // Show the button after calculation

      // Update the onclick attribute based on the BMI category
      switch (desc) {
        case "underweight":
          viewTodoButton.setAttribute("onclick", "window.location.href='todo.php'");
          break;
        case "healthy":
          viewTodoButton.setAttribute("onclick", "window.location.href='todo4.php'");
          break;
        case "overweight":
          viewTodoButton.setAttribute("onclick", "window.location.href='todo5.php'");
          break;
        case "obese":
          viewTodoButton.setAttribute("onclick", "window.location.href='todo6.php'");
          break;
        default:
          viewTodoButton.setAttribute("onclick", "window.location.href='todo.php'");
          break;
      }
    }

    function interpretBMI(bmi) {
      if (bmi < 18.5) {
        return "underweight";
      } else if (bmi < 25) {
        return "healthy";
      } else if (bmi < 30) {
        return "overweight";
      } else {
        return "obese";
      }
    }

    function callSupport() {
      window.location.href = "support.html"; // Replace with your actual support page URL
    }
  </script>
</html>

<?php
// Start session to retrieve hospital_id
session_start();
$hospital_id = isset($_GET['hospital_id']) ? $_GET['hospital_id'] : 1;
$_SESSION['hospital_id'] = $hospital_id;  // Store hospital_id in session

$servername = "localhost";
$username = "root";
$password = "@Sreedhar123";
$dbname = "tbp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctors based on selected hospital
$sql = "SELECT * FROM doctor WHERE hospital_id = '$hospital_id'";
$result = $conn->query($sql);
$doctors = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apollo Hospitals - Doctors</title>
    <style>
        body {
            background-color: #f0f0f0; /* Background color */
            color: black; /* Text color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            flex-direction: column; /* Align items in a column */
            min-height: 100vh;
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

        .support {
            margin-left: auto;
            display: flex;
            align-items: center;
            position: relative;
            left: -1in; /* Move contact section 1.5 inches to the left */
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
	    margin-right: in;
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

        .doctor-list {
            text-align: left;
            width: 800px; /* Width for the doctor list */
            margin-top: 200px; /* Adjust margin to leave space for the fixed header */
        }

        .doctor-item {
            display: flex;
            align-items: center; /* Center items vertically */
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px; /* Padding around each doctor item */
            margin-bottom: 20px; /* Adjust spacing between doctor items */
            cursor: pointer; /* Add pointer cursor */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        .doctor-item:hover {
            background-color: #f0f0f0; /* Light background on hover */
        }

        .doctor-item .photo {
            flex: 0 0 120px; /* Fixed width for the photo */
            margin-right: 20px; /* Space between photo and description */
        }

        .doctor-item .photo img {
            max-width: 100%; /* Ensure the photo fits within the fixed width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 50%; /* Optional: make the photo round */
        }

        .doctor-item .doctor-details {
            flex-grow: 1; /* Doctor details take remaining space */
        }

        .doctor-item h2 {
            margin-top: 0; /* Remove top margin for consistency */
            cursor: pointer; /* Pointer cursor on doctor name */
        }

        .doctor-item p {
            margin-bottom: 10px; /* Space between paragraphs */
        }

        
        /* Appointment Details Form */
        .appointment-details {
            display: none; /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgb(231, 222, 222);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure it's above other content */
        }

        .appointment-details.active {
            display: block; /* Show when active */
        }

        .appointment-details h2 {
            margin-top: 0;
            text-align: center;
        }

        .appointment-details label {
            display: block;
            margin-bottom: 10px;
        }

        .appointment-details input[type="date"],
        .appointment-details select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .appointment-details button {
            background-color: #4CAF50;
            color: rgb(197, 194, 194);
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .appointment-details button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="header">
	<button class="back-button" onclick="window.location.href='book-appointment.php'">←Back</button>

        <a href="dashboard.php">
        <img src="logo3.png" alt="Logo"> <!-- Replace with your actual logo path -->
    </a>        <h1>Kamineni Doctors</h1>
        <div class="support">
            <button class="support-button" onclick="callSupport()">
                <img src="phone2.png" alt="Phone Icon">
                Contact Us: (123) 456-7890
            </button>
        </div>
    </div>
    <div class="doctor-list">
        <div class="doctor-item" onclick="showAppointmentForm('Dr. Sruthi Sree')">
            <div class="photo">
                <img src="doc3.jpg" alt="Doctor 1 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. Sruthi Sree</h2>
                <p>Specialist: Cardiology</p>
                <p>Phone: +1234567890</p>
            </div>
        </div>
        <div class="doctor-item" onclick="showAppointmentForm('Dr. John Paul')">
            <div class="photo">
                <img src="mdoc3.webp" alt="Doctor 2 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. John Paul</h2>
                <p>Specialist: Neurology</p>
                <p>Phone: +0987654321</p>
            </div>
        </div>
        <div class="doctor-item" onclick="showAppointmentForm('Dr. Sushma Kiron')">
            <div class="photo">
                <img src="doc4.jpg" alt="Doctor 3 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. Sushma Kiron</h2>
                <p>Specialist: Orthopedics</p>
                <p>Phone: +1122334455</p>
            </div>
        </div>
    </div>

    <!-- Appointment Details Form for Dr. Prerna Reddy -->
    <div class="appointment-details" id="appointmentFormSruthi">
        <h2>Appointment Details with Dr. Sruthi Sree</h2>
        <label for="appointmentDateSruthi">Date:</label>
        <input type="date" id="appointmentDateSruthi" name="appointmentDateSruthi" required>
        <label for="appointmentTimeSruthi">Time Slot:</label>
        <select id="appointmentTimeSruthi" name="appointmentTimeSruthi" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(8, 12)">Submit</button>
    </div>

    <!-- Appointment Details Form for Dr. Gopal Chowdhary -->
    <div class="appointment-details" id="appointmentFormJohn">
        <h2>Appointment Details with Dr. John Paul</h2>
        <label for="appointmentDateJohn">Date:</label>
        <input type="date" id="appointmentDateJohn" name="appointmentDateJohn" required>
        <label for="appointmentTimeJohn">Time Slot:</label>
        <select id="appointmentTimeJohn" name="appointmentTimeJohn" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(9, 12)">Submit</button>
    </div>

    <!-- Appointment Details Form for Dr. Shirish Gupta -->
    <div class="appointment-details" id="appointmentFormSushma">
        <h2>Appointment Details with Dr. Sushma Kiron</h2>
        <label for="appointmentDateSushma">Date:</label>
        <input type="date" id="appointmentDateSushma" name="appointmentDateSushma" required>
        <label for="appointmentTimeSushma">Time Slot:</label>
        <select id="appointmentTimeSushma" name="appointmentTimeSushma" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(10, 12)">Submit</button>
    </div>

    <script>
	window.onload = function() {
            setMinDate();
        };

        function setMinDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointmentDateSruthi').setAttribute('min', today);
            document.getElementById('appointmentDateJohn').setAttribute('min', today);
            document.getElementById('appointmentDateSushma').setAttribute('min', today);
        }
        function callSupport() {
            alert("Calling support at (123) 456-7890");
        }

        function showAppointmentForm(doctorName) {
            // Hide all appointment forms initially
            document.querySelectorAll('.appointment-details').forEach(form => {
                form.classList.remove('active');
            });

            // Show the appointment form based on the doctor's name
            if (doctorName === 'Dr. Sruthi Sree') {
                document.getElementById('appointmentFormSruthi').classList.add('active');
            } else if (doctorName === 'Dr. John Paul') {
                document.getElementById('appointmentFormJohn').classList.add('active');
            } else if (doctorName === 'Dr. Sushma Kiron') {
                document.getElementById('appointmentFormSushma').classList.add('active');
            }
        }
        function submitAppointment(doctorId, hospitalId) {
    // Retrieve appointment details
    let appointmentDate;
    let appointmentTime;

    if (doctorId === 8) {
        appointmentDate = document.getElementById('appointmentDateSruthi').value;
        appointmentTime = document.getElementById('appointmentTimeSruthi').value;
    } else if (doctorId === 9) {
        appointmentDate = document.getElementById('appointmentDateJohn').value;
        appointmentTime = document.getElementById('appointmentTimeJohn').value;
    } else if (doctorId === 10) {
        appointmentDate = document.getElementById('appointmentDateSushma').value;
        appointmentTime = document.getElementById('appointmentTimeSushma').value;
    }

    // Make sure date and time are selected
    if (!appointmentDate || !appointmentTime) {
        alert("Please select both date and time slot.");
        return;
    }

    // AJAX request to handle_appointment.php
    fetch('handle_appointment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `doctor_id=${doctorId}&hospital_id=${hospitalId}&appointment_date=${appointmentDate}&time_slot=${appointmentTime}&status=booked`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Show success message
        } else {
            alert(data.message); // Show failure message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Appointment is already booked on that date and time.Please try for another slot.');
    });
}
    </script>
</body>
</html>

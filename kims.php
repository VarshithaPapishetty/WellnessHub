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
	    margin-right: 0.5in;
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
    </a>
        <h1>KIMS Doctors</h1>
        <div class="support">
            <button class="support-button" onclick="callSupport()">
                <img src="phone2.png" alt="Phone Icon">
                Contact Us: (123) 456-7890
            </button>
        </div>
    </div>
    <div class="doctor-list">
        <div class="doctor-item" onclick="showAppointmentForm('Dr. Harsha Yadav')">
            <div class="photo">
                <img src="mdoc4.jpg" alt="Doctor 1 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. Harsha Yadav</h2>
                <p>Specialist: Cardiology</p>
                <p>Phone: +1234567890</p>
            </div>
        </div>
        <div class="doctor-item" onclick="showAppointmentForm('Dr. Dinesh Kumar')">
            <div class="photo">
                <img src="mdoc2.webp" alt="Doctor 2 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. Dinesh Kumar</h2>
                <p>Specialist: Neurology</p>
                <p>Phone: +0987654321</p>
            </div>
        </div>
        <div class="doctor-item" onclick="showAppointmentForm('Dr. Sushmitha Khanna')">
            <div class="photo">
                <img src="doc5.jpg" alt="Doctor 3 Photo"> <!-- Replace with actual photo path -->
            </div>
            <div class="doctor-details">
                <h2>Dr. Sushmitha Khanna</h2>
                <p>Specialist: Orthopedics</p>
                <p>Phone: +1122334455</p>
            </div>
        </div>
    </div>

    <!-- Appointment Details Form for Dr. Prerna Reddy -->
    <div class="appointment-details" id="appointmentFormHarsha">
        <h2>Appointment Details with Dr. Harsha Yadav</h2>
        <label for="appointmentDateHarsha">Date:</label>
        <input type="date" id="appointmentDateHarsha" name="appointmentDateHarsha" required>
        <label for="appointmentTimeHarsha">Time Slot:</label>
        <select id="appointmentTimeHarsha" name="appointmentTimeHarsha" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(5, 11)">Submit</button>
    </div>

    <!-- Appointment Details Form for Dr. Gopal Chowdhary -->
    <div class="appointment-details" id="appointmentFormDinesh">
        <h2>Appointment Details with Dr. Dinesh Kumar</h2>
        <label for="appointmentDateDinesh">Date:</label>
        <input type="date" id="appointmentDateDinesh" name="appointmentDateDinesh" required>
        <label for="appointmentTimeDinesh">Time Slot:</label>
        <select id="appointmentTimeDinesh" name="appointmentTimeDinesh" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(6,11)">Submit</button>
    </div>

    <!-- Appointment Details Form for Dr. Shirish Gupta -->
    <div class="appointment-details" id="appointmentFormSushmitha">
        <h2>Appointment Details with Dr. Sushmitha Khanna</h2>
        <label for="appointmentDateSushmitha">Date:</label>
        <input type="date" id="appointmentDateSushmitha" name="appointmentDateSushmitha" required>
        <label for="appointmentTimeSushmitha">Time Slot:</label>
        <select id="appointmentTimeSushmitha" name="appointmentTimeSushmitha" required>
            <option value="09:00">9:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="14:00">2:00 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="18:00">6:00 PM</option>
            <option value="20:00">8:00 PM</option>
        </select>
        <button onclick="submitAppointment(7,11)">Submit</button>
    </div>

    <script>
	window.onload = function() {
            setMinDate();
        };

        function setMinDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointmentDateHarsha').setAttribute('min', today);
            document.getElementById('appointmentDateDinesh').setAttribute('min', today);
            document.getElementById('appointmentDateSushmitha').setAttribute('min', today);
        }
	$(document).ready(function() {
        $('#appointmentForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            
            $.ajax({
                type: 'POST',
                url: 'handle_appointment.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#message').html('<p class="alert alert-' + (response.success ? 'success' : 'danger') + '">' + response.message + '</p>');
                    // Optionally update UI or redirect to another page on success
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#message').html('<p class="alert alert-danger">Error: ' + xhr.responseText + '</p>');
                }
            });
        });
    });
        function callSupport() {
            alert("Calling support at (123) 456-7890");
        }

        function showAppointmentForm(doctorName) {
            // Hide all appointment forms initially
            document.querySelectorAll('.appointment-details').forEach(form => {
                form.classList.remove('active');
            });

            // Show the appointment form based on the doctor's name
            if (doctorName === 'Dr. Harsha Yadav') {
                document.getElementById('appointmentFormHarsha').classList.add('active');
            } else if (doctorName === 'Dr. Dinesh Kumar') {
                document.getElementById('appointmentFormDinesh').classList.add('active');
            } else if (doctorName === 'Dr. Sushmitha Khanna') {
                document.getElementById('appointmentFormSushmitha').classList.add('active');
            }
        }
        function submitAppointment(doctorId, hospitalId) {
    // Retrieve appointment details
    let appointmentDate;
    let appointmentTime;

    if (doctorId === 5) {
        appointmentDate = document.getElementById('appointmentDateHarsha').value;
        appointmentTime = document.getElementById('appointmentTimeHarsha').value;
    } else if (doctorId === 6) {
        appointmentDate = document.getElementById('appointmentDateDinesh').value;
        appointmentTime = document.getElementById('appointmentTimeDinesh').value;
    } else if (doctorId === 7) {
        appointmentDate = document.getElementById('appointmentDateSushmitha').value;
        appointmentTime = document.getElementById('appointmentTimeSushmitha').value;
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



        function formatTime(time) {
            const [hours, minutes] = time.split(':');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const adjustedHours = hours % 12 || 12;
            return `${adjustedHours}:${minutes} ${ampm}`;
        }
    </script>
</body>
</html>
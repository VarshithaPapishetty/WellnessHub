<?php
session_start();

// Database connection details
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

// Retrieve POST data
$doctorId = $_POST['doctor_id'];
$hospitalId = $_POST['hospital_id'];
$appointmentDate = $_POST['appointment_date'];
$timeSlot = $_POST['time_slot'];
$status = 'booked';  // Set status to 'booked'

// Convert the time to 24-hour format (HH:MM:SS) before inserting it into the database
$timeSlot = date("H:i:s", strtotime($timeSlot));

// Log the incoming POST data for debugging
error_log("Received POST data: doctor_id = $doctorId, hospital_id = $hospitalId, appointment_date = $appointmentDate, time_slot = $timeSlot");

// Check if the hospital_id exists
$checkHospitalSql = "SELECT 1 FROM hospital WHERE hospital_id = ?";
$stmt = $conn->prepare($checkHospitalSql);
$stmt->bind_param("i", $hospitalId);
$stmt->execute();
$hospitalResult = $stmt->get_result();

// If the hospital doesn't exist, return an error
if ($hospitalResult->num_rows == 0) {
    $response = array('success' => false, 'message' => 'Invalid hospital ID.');
    echo json_encode($response);
    exit;
}

// Check if the doctor_id exists
$checkDoctorSql = "SELECT 1 FROM doctor WHERE doctor_id = ?";
$stmt = $conn->prepare($checkDoctorSql);
$stmt->bind_param("i", $doctorId);
$stmt->execute();
$doctorResult = $stmt->get_result();

// If the doctor doesn't exist, return an error
if ($doctorResult->num_rows == 0) {
    $response = array('success' => false, 'message' => 'Invalid doctor ID.');
    echo json_encode($response);
    exit;
}

// Prepare the SQL query to check if the appointment slot is already booked
$checkSql = "SELECT * FROM appointment WHERE doctor_id = ? AND hospital_id = ? AND appointment_date = ? AND time_slot = ?";
$stmt = $conn->prepare($checkSql);

// Bind parameters and execute the statement
$stmt->bind_param("iiss", $doctorId, $hospitalId, $appointmentDate, $timeSlot);
$stmt->execute();
$result = $stmt->get_result();

// If the slot is already booked, return an error
if ($result->num_rows > 0) {
    $response = array('success' => false, 'message' => 'This appointment slot is already booked.');
    echo json_encode($response);
    exit;
} else {
    // If no existing appointment, proceed with inserting the new one
    $insertSql = "INSERT INTO appointment (doctor_id, hospital_id, appointment_date, time_slot, status) 
                  VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("iisss", $doctorId, $hospitalId, $appointmentDate, $timeSlot, $status);

    // Execute the insert query
    if ($stmt->execute()) {
        error_log("Appointment booked successfully for doctor_id = $doctorId, hospital_id = $hospitalId, appointment_date = $appointmentDate, time_slot = $timeSlot");
        $response = array('success' => true, 'message' => 'Appointment booked successfully.');
        echo json_encode($response);
    } else {
        // Log any error that occurs during insertion
        error_log("Error during insertion: " . $stmt->error);
        $response = array('success' => false, 'message' => 'Error: ' . $stmt->error);
        echo json_encode($response);
    }
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

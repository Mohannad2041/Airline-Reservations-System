<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "webproject";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from the form
$flightName = $_POST['flightName'];
$flightId = $_POST['flightId'];
$flightItinerary = $_POST['flightItinerary'];
$flightFees = $_POST['flightFees'];
$passengerCount = $_POST['passengerCount'];
$flightStart = $_POST['flightStart'];
$flightEnd = $_POST['flightEnd'];

// Assuming the logged-in user is a company (change this logic accordingly)
if (isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'company') {
    $companyId = $_SESSION['companyId']; // Assuming you store companyId in the session during login
} else {
    echo "Invalid user or not logged in as a company.";
    exit();
}

// Insert new flight into the Flight table
$insertSql = "INSERT INTO Flight (name, id, itinerary, fees, num_passengers, start_time, end_time, company_id) 
              VALUES ('$flightName', '$flightId', '$flightItinerary', '$flightFees', '$passengerCount', '$flightStart', '$flightEnd', '$companyId')";

if ($conn->query($insertSql) === TRUE) {
    echo "Flight added successfully!";
} else {
    echo "Error adding flight: " . $conn->error;
}
header("Location: ../companyHome/company_home.php");
$conn->close();
?>

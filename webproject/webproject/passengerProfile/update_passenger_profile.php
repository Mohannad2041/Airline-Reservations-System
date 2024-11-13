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

$email = $_SESSION['email'];

// Handle image upload (not implemented in this example)
$imagePath = "path_to_uploaded_image"; // Update this

// Get values from the form
$passengerName = $_POST['passengerName'];
$passengerEmail = $_POST['passengerEmail'];
$passengerTel = $_POST['passengerTel'];

// Update passenger data in the database
$updateSql = "UPDATE Passenger SET name = '$passengerName', email = '$passengerEmail', tel = '$passengerTel', photo = '$imagePath' WHERE email = '$email'";

if ($conn->query($updateSql) === TRUE) {
    echo "Profile updated successfully!";
} else {
    echo "Error updating profile: " . $conn->error;
}
header("Location: ../passengerHome/passenger_home.php");
$conn->close();
?>

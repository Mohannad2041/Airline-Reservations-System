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

// Handle logo image upload (not implemented in this example)
$logoImg = "path_to_uploaded_logo"; // Update this

// Get values from the form
$companyName = $_POST['companyName'];
$companyBio = $_POST['companyBio'];
$companyAddress = $_POST['companyAddress'];

// Update company data in the database
$updateSql = "UPDATE Company SET logo_img = '$logoImg', name = '$companyName', bio = '$companyBio', address = '$companyAddress' WHERE email = '$email'";

if ($conn->query($updateSql) === TRUE) {
    echo "Profile updated successfully!";
} else {
    echo "Error updating profile: " . $conn->error;
}
header("Location: ../companyHome/company_home.php");
$conn->close();
?>

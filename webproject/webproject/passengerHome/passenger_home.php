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

// Fetch passenger data based on the logged-in user's email
$passengerSql = "SELECT name, tel FROM Passenger WHERE email = '$email'";
$passengerResult = $conn->query($passengerSql);

if ($passengerResult->num_rows > 0) {
    $passengerData = $passengerResult->fetch_assoc();
    $passengerName = $passengerData['name'];
    $passengerTel = $passengerData['tel'];
} else {
    // Handle the case where passenger data is not found
    $passengerName = "Passenger Name";
    $passengerTel = "Passenger Telephone";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Home</title>
    <link rel="stylesheet" href="passenger_home.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $passengerName; ?>!</h2>
        <div class="passenger-info">
            <img src="../images/user_image.jpg" alt="User Image" class="user-image">
            <div class="user-details">
                <p><strong>Name:</strong> <?php echo $passengerName; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Tel:</strong> <?php echo $passengerTel; ?></p>
            </div>
        </div>
        
        <div class="flights-section">
            <h3>Current Flights</h3>
            <ul class="current-flights">
                <!-- Include PHP code here to dynamically generate the list of current flights -->
            </ul>
            <h3>Completed Flights</h3>
            <ul class="completed-flights">
                <!-- Include PHP code here to dynamically generate the list of completed flights -->
            </ul>
        </div>

        <div class="profile-section">
            <button onclick="location.href='../passengerProfile/passenger_profile.php'">View Profile</button>
        </div>
        
        <div class="search-section">
            <button onclick="location.href='../searchFlight/search_flight.html'">Search a Flight</button>
        </div>
    </div>
</body>
</html>

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
$passengerSql = "SELECT name, email, tel FROM Passenger WHERE email = '$email'";
$passengerResult = $conn->query($passengerSql);

if ($passengerResult->num_rows > 0) {
    $passengerData = $passengerResult->fetch_assoc();
    $passengerName = $passengerData['name'];
    $passengerEmail = $passengerData['email'];
    $passengerTel = $passengerData['tel'];
} else {
    // Handle the case where passenger data is not found
    $passengerName = "Error finding name";
    $passengerEmail = "Error finding email";
    $passengerTel = "Error finding tel";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Profile</title>
    <link rel="stylesheet" href="passenger_profile.css">
</head>
<body>
    <div class="container">
        <h2>Passenger Profile</h2>
        <form action="update_passenger_profile.php" method="post">
            <label for="passengerName">Name:</label>
            <input type="text" id="passengerName" name="passengerName" value="<?php echo $passengerName; ?>">

            <label for="passengerEmail">Email:</label>
            <input type="email" id="passengerEmail" name="passengerEmail" value="<?php echo $passengerEmail; ?>">

            <label for="passengerImage">Image:</label>
            <input type="file" id="passengerImage" name="passengerImage">
            <img src="../images/user_image.jpg" alt="Current Image" class="current-image">

            <label for="passengerTel">Tel:</label>
            <input type="tel" id="passengerTel" name="passengerTel" value="<?php echo $passengerTel; ?>">

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>

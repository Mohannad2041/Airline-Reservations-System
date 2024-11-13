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

// Fetch company data based on the logged-in user's email
$companySql = "SELECT logo_img, name, bio, address FROM Company WHERE email = '$email'";
$companyResult = $conn->query($companySql);

if ($companyResult->num_rows > 0) {
    $companyData = $companyResult->fetch_assoc();
    $logoImg = $companyData['logo_img'];
    $companyName = $companyData['name'];
    $companyBio = $companyData['bio'];
    $companyAddress = $companyData['address'];
} else {
    // Handle the case where company data is not found
    $logoImg = "default_logo.png";
    $companyName = "Company Name";
    $companyBio = "Company Bio";
    $companyAddress = "Company Address";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link rel="stylesheet" href="company_profile.css">
</head>
<body>
    <div class="container">
        <h2>Company Profile</h2>
        <form action="update_company_profile.php" method="post">
            <label for="companyLogo">Logo Image:</label>
            <input type="file" id="companyLogo" name="companyLogo">
            <img src="../images/company_logo.png" alt="Current Logo" class="current-logo">

            <label for="companyName">Name:</label>
            <input type="text" id="companyName" name="companyName" value="<?php echo $companyName; ?>">

            <label for="companyBio">Bio:</label>
            <textarea id="companyBio" name="companyBio"><?php echo $companyBio; ?></textarea>

            <label for="companyAddress">Address:</label>
            <input type="text" id="companyAddress" name="companyAddress" value="<?php echo $companyAddress; ?>">

            <h3>Flights List</h3>
            <ul class="flights-list">
                <!-- Include PHP code here to dynamically generate the list of flights -->
            </ul>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>

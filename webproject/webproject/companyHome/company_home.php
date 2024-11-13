<?php
// Start the session
session_start();

// Replace these values with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "webproject";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch company name based on the logged-in user's email and account type
$email = $_SESSION['email'];
$accountType = $_SESSION['accountType'];
$companyId = $_SESSION['companyId'];
if ($accountType == 'company') {
    $companySql = "SELECT name FROM Company WHERE email = '$email'";
    $companyResult = $conn->query($companySql);

    if ($companyResult->num_rows > 0) {
        $companyRow = $companyResult->fetch_assoc();
        $companyName = $companyRow['name'];
    } else {
        // Handle the case where company data is not found
        $companyName = 'Unknown Company';
    }
} else {
    // Handle the case where the account type is not 'company'
    $companyName = 'Invalid Account Type';
}

$flightSql = "SELECT * FROM Flight WHERE company_id = $companyId";
$flightResult = $conn->query($flightSql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Home</title>
    <link rel="stylesheet" href="company_home.css">
</head>
<body>
    <div class="company-home-container">
        <div class="company-header">
            <img src="../images/company_logo.png" alt="Company Logo" class="company-logo">
            <h1 class="company-name"><?php echo $companyName; ?></h1>
        </div>
        <br>
        <div class="company-navigation">
            <ul>
                <li><a href="../companyProfile/company_profile.php">Profile</a></li>
                <li><a href="../addFlight/add_flight.html">Add Flight</a></li>
                <li><a href="#messages">Messages</a></li>
            </ul>
        </div>

        <div class="flight-list-container">
            <h2>Flight List</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Itinerary</th>
                        <th>Fees</th>
                        <th># Passengers</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $flightResult->fetch_assoc()) {
                        echo "<tr class='clickable-row' data-href='#flight-details'>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['itinerary'] . "</td>";
                        echo "<td>" . $row['fees'] . "</td>";
                        echo "<td>" . $row['num_passengers'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['end_time'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

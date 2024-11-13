<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "webproject";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['signupName'];
$email = $_POST['signupEmail'];
$password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);
$tel = $_POST['signupTel'];
$accountType = $_POST['signupType'];

if ($accountType == "company") {
    $address = $_POST['companyAddress'];
    $bio = $_POST['companyBio'];
    $location = $_POST['companyLocation'];
    // Handle logo image upload (not implemented in this example)
    $logoImg = "path_to_uploaded_logo"; // Update this

    $sql = "INSERT INTO Company (name, bio, address, location, username, password, email, tel, logo_img) 
            VALUES ('$name', '$bio', '$address', '$location', '$email', '$password', '$email', '$tel', '$logoImg')";
} elseif ($accountType == "passenger") {
    // Handle photo and passport image uploads (not implemented in this example)
    $photo = "path_to_uploaded_photo"; // Update this
    $passportImg = "path_to_uploaded_passport"; // Update this

    $sql = "INSERT INTO Passenger (name, email, password, tel, photo, passport_img) 
            VALUES ('$name', '$email', '$password', '$tel', '$photo', '$passportImg')";
} else {
    echo "Invalid account type";
    exit();
}

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registration successful!');</script>";
    header("Location: login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
echo "submit_appointment2.php is being executed";

require '../php/connection.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "Error: User not logged in.";
    exit;
}

$loggedInUsername = $_SESSION['username'];

// Retrieve email from the login table based on the username
$sqlRetrieveEmail = "SELECT email FROM login WHERE username = '$loggedInUsername'";
$resultRetrieveEmail = $conn->query($sqlRetrieveEmail);

if (!$resultRetrieveEmail) {
    echo "Error: " . $sqlRetrieveEmail . "<br>" . $conn->error;
    exit;
}

if ($resultRetrieveEmail->num_rows !== 1) {
    echo "Error: Unable to retrieve email for the logged-in user.";
    exit;
}

$row = $resultRetrieveEmail->fetch_assoc();
$email = $row['email'];

$fullName = $_POST['fullname'];
$contact = $_POST['contact'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];

// Extract first name and last name from the full name
$firstName = "";
$lastName = "";

$fullNameParts = explode(' ', $fullName, 2);
if (count($fullNameParts) === 2) {
    $firstName = $fullNameParts[0];
    $lastName = $fullNameParts[1];
}

$sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
        VALUES ('$firstName', '$lastName', '$contact', '$email', '$services', '$selectedDate', '$selectedTime')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: http://localhost/Makeover/html/appointment2.html");
exit;
?>

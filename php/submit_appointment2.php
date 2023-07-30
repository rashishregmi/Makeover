<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../php/connection.php';

$fullname = $_POST['fullname'];
$contact = $_POST['contact'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];
$username = $_POST['username']; // Get the username from the form

$sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username) 
        VALUES (?, '', ?, '', ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $fullname, $contact, $services, $selectedDate, $selectedTime, $username);

if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

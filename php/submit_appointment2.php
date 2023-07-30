<?php
require '../php/connection.php';

$fullname = $_POST['fullname'];
$contact = $_POST['contact'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];
$username = $_POST['username']; // Get the username from the form

$sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username) 
        VALUES ('$fullname', '', '$contact', '', '$services', '$selectedDate', '$selectedTime', '$username')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>

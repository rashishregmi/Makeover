<?php
echo "appointment.php is being executed";

require '../php/connection.php';

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];

$sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
        VALUES ('$firstName', '$lastName', '$contact', '$email', '$services', '$selectedDate', '$selectedTime')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>

<?php
echo "appointment.php is being executed";
include '../php/connection.php';
include '../makeover_admin/includes/dbconnection.php';

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];
$fullname = $firstName . " " . $lastName; // Concatenate the full name separately

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssss", $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime);

if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt_tblcustomers->close();

$conn->close();
$conn_makeover_admin->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>

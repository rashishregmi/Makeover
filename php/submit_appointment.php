<?php
echo "appointment.php is being executed";

include '../php/connection.php';
include '../makeover_admin/includes/dbconnection.php';

// Add code to insert data into the 'users' table
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$contact = $_POST['contact'];
$email = $_POST['email'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, contact, email) 
                       VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $firstName, $lastName, $contact, $email);

if ($stmt->execute()) {
    echo "User data added to the users table successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

// Continue with the code to insert data into the 'appointments' table

$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender'];
$selectedTime = $_POST['myDate'];

// Use prepared statements to prevent SQL injection for appointments table
$stmt_appointments = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt_appointments->bind_param("sssssss", $firstName, $lastName, $contact, $email, $services, $selectedDate, $selectedTime);

if ($stmt_appointments->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $stmt_appointments->error;
}

$stmt_appointments->close();

// Now, insert data into the 'tblcustomers' table in the 'makeover_admin' database
// Prepare the data for insertion into tblcustomers
$fullName = $firstName . ' ' . $lastName;
$details = $services;

// Use prepared statements to prevent SQL injection for tblcustomers table
$stmt_tblcustomers = $conn_makeover_admin->prepare("INSERT INTO tblcustomers (Name, Email, MobileNumber, Details) 
                       VALUES (?, ?, ?, ?)");

$stmt_tblcustomers->bind_param("ssss", $fullName, $email, $contact, $details);

if ($stmt_tblcustomers->execute()) {
    echo "Data inserted into tblcustomers successfully!";
} else {
    echo "Error: " . $stmt_tblcustomers->error;
}

$stmt_tblcustomers->close();

$conn->close();
$conn_makeover_admin->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>

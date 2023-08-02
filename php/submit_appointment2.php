<?php
echo "submit_appointment2.php is being executed";

include '../php/connection.php';
include '../makeover_admin/includes/dbconnection.php';

$fullname = $_POST['fullname3'];
$contact = $_POST['contact3'];
$services = implode(", ", $_POST['topics']);
$selectedDate = $_POST['myCalender3'];
$selectedTime = $_POST['myDate3'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (username, email) 
                       VALUES (?, ?)");

$stmt->bind_param("ss", $fullname, $contact);

if ($stmt->execute()) {
    $lastUserId = $stmt->insert_id;

    // Continue with the code to insert data into the 'appointments' table
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username, fullname) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $emptyValue = '';
    $stmt->bind_param("sssssssss", $fullname, $emptyValue, $contact, $emptyValue, $services, $selectedDate, $selectedTime, $fullname, $fullname);

    if ($stmt->execute()) {
        // Data insertion into 'appointments' table successful
        $lastAppointmentId = $stmt->insert_id;

        // Continue with the code to transfer data to 'tblcustomers' table in 'makeover_admin' database
        $stmt = $conn->prepare("INSERT INTO makeover_admin.tblcustomers (Name, Email, MobileNumber, Details) 
                               VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $fullname, $contact, $contact, $services);

        if ($stmt->execute()) {
            // Data transferred successfully to 'tblcustomers' table in 'makeover_admin' database
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

// Now, fetch the user data from the 'users' table
$user_fetch_sql = "SELECT fullname, contact FROM users WHERE fullname = ? AND contact = ?";
$user_fetch_stmt = $conn->prepare($user_fetch_sql);
$user_fetch_stmt->bind_param("ss", $fullname, $contact);
$user_fetch_stmt->execute();
$user_fetch_result = $user_fetch_stmt->get_result();
$user_fetch_stmt->close();

// Fetch the appointment data from the 'appointments' table
$appointment_fetch_sql = "SELECT services FROM appointments WHERE fullname = ? AND contact = ?";
$appointment_fetch_stmt = $conn->prepare($appointment_fetch_sql);
$appointment_fetch_stmt->bind_param("ss", $fullname, $contact);
$appointment_fetch_stmt->execute();
$appointment_fetch_result = $appointment_fetch_stmt->get_result();
$appointment_fetch_stmt->close();

// Check if the user exists in 'users' table
if ($user_fetch_result->num_rows > 0) {
    $user_data = $user_fetch_result->fetch_assoc();
    $fullname = $user_data['fullname'];
    $contact = $user_data['contact'];

    // Check if the user has an appointment in the 'appointments' table
    if ($appointment_fetch_result->num_rows > 0) {
        $appointment_data = $appointment_fetch_result->fetch_assoc();
        $services = $appointment_data['services'];

        // Insert user data into the 'makeover_admin.tblcustomers' table
        $insert_data_sql = "INSERT INTO makeover_admin.tblcustomers (Name, MobileNumber, Details) VALUES (?, ?, ?)";
        $insert_data_stmt = $conn->prepare($insert_data_sql);
        $insert_data_stmt->bind_param("sss", $fullname, $contact, $services);
        $insert_data_stmt->execute();
        $insert_data_stmt->close();

        echo "Data inserted into tblcustomers successfully!";
    }
}



$conn->close();

header("Location: http://localhost/Makeover/html/Appointment.html");
exit;
?>

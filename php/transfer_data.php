<?php
// Include connection.php to connect to the databases
include '../php/connection.php';
include '../makeover_admin/includes/dbconnection.php';

function sendUserDataToMakeoverAdmin($username, $email)
{
    global $conn;

    // Check if the user exists in the 'users' table
    $check_user_sql = "SELECT * FROM users WHERE username = ?";
    $check_user_stmt = $conn->prepare($check_user_sql);
    $check_user_stmt->bind_param("s", $username);
    $check_user_stmt->execute();
    $check_user_result = $check_user_stmt->get_result();

    if ($check_user_result->num_rows > 0) {
        $user_data = $check_user_result->fetch_assoc();
        $fullname = $user_data['fullname'];
        $contact = $user_data['contact'];

        // Check if the user has an appointment in the 'appointments' table
        $check_appointment_sql = "SELECT * FROM appointments WHERE username = ?";
        $check_appointment_stmt = $conn->prepare($check_appointment_sql);
        $check_appointment_stmt->bind_param("s", $username);
        $check_appointment_stmt->execute();
        $check_appointment_result = $check_appointment_stmt->get_result();

        if ($check_appointment_result->num_rows > 0) {
            $appointment_data = $check_appointment_result->fetch_assoc();
            $services = $appointment_data['services'];

            // Insert user data into the 'makeover_admin.tblcustomers' table
            $insert_data_sql = "INSERT INTO makeover_admin.tblcustomers (Name, Email, MobileNumber, Details) VALUES (?, ?, ?, ?)";
            $insert_data_stmt = $conn->prepare($insert_data_sql);
            $insert_data_stmt->bind_param("ssss", $fullname, $email, $contact, $services);
            $insert_data_stmt->execute();
        }
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["email"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];

        // Send user data to makeover_admin
        sendUserDataToMakeoverAdmin($username, $email);
    }
}

$conn->close();
?>

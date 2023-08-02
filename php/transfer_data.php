<?php
// Include connection.php to connect to the databases
include '../php/connection.php';
include '../makeover_admin/includes/dbconnection.php';

function sendUserDataToMakeoverAdmin($username, $email, $conn)
{
    // Check if the user exists in the 'users' table of the makeover database
    $check_user_sql = "SELECT * FROM users WHERE username = ?";
    $check_user_stmt = $conn->prepare($check_user_sql);
    $check_user_stmt->bind_param("s", $username);
    $check_user_stmt->execute();
    $check_user_result = $check_user_stmt->get_result();

    if ($check_user_result->num_rows > 0) {
        $user_data = $check_user_result->fetch_assoc();
        $fullname = $user_data['fullname'];
        $contact = $user_data['contact'];

        // Check if the user has an appointment in the 'appointments' table of the makeover database
        $check_appointment_sql = "SELECT * FROM appointments WHERE username = ?";
        $check_appointment_stmt = $conn->prepare($check_appointment_sql);
        $check_appointment_stmt->bind_param("s", $username);
        $check_appointment_stmt->execute();
        $check_appointment_result = $check_appointment_stmt->get_result();

        if ($check_appointment_result->num_rows > 0) {
            // Fetch all appointments for the user
            $services = "";
            while ($appointment_data = $check_appointment_result->fetch_assoc()) {
                $services .= $appointment_data['contact'] . ". " . $appointment_data['services'] . ", ";
            }

            // Remove trailing comma and space from the services string
            $services = rtrim($services, ", ");

            // Insert user data into the 'makeover_admin.tblcustomers' table of the makeover_admin database
            $insert_data_sql = "INSERT INTO makeover_admin.tblcustomers (Name, Email, MobileNumber, Details) VALUES (?, ?, ?, ?)";
            $insert_data_stmt = $conn->prepare($insert_data_sql);
            $insert_data_stmt->bind_param("ssss", $fullname, $email, $contact, $services);
            $insert_data_stmt->execute();
        }
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check for duplicate entries in the 'users' table of the makeover database
        $check_duplicate_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $check_stmt = $conn->prepare($check_duplicate_sql);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // User with the same username or email already exists
            $errorMessage = "Error: The username or email is already registered.";
        } else {
            // Insert the new user into the 'users' table of the makeover database if no duplicate entries found
            $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("sss", $username, $email, $password);

            try {
                if ($stmt->execute()) {
                    // Registration successful, send data to makeover_admin.tblcustomers
                    $insert_customer_sql = "INSERT INTO makeover_admin.tblcustomers (Name, Email) VALUES (?, ?)";
                    $customer_stmt = $conn->prepare($insert_customer_sql);
                    $customer_stmt->bind_param("ss", $username, $email);

                    if ($customer_stmt->execute()) {
                        // Data sent to makeover_admin.tblcustomers successfully
                        header("Location: http://localhost/Makeover/html/login.html#success");
                        exit;
                    } else {
                        // Redirect back to signup page with a general error message
                        $errorMessage = "Error: Unable to register. Please try again later.";
                    }
                } else {
                    // Redirect back to signup page with a general error message
                    $errorMessage = "Error: Unable to register. Please try again later.";
                }
            } catch (mysqli_sql_exception $e) {
                // Redirect back to signup page with a general error message
                $errorMessage = "Error: Unable to register. Please try again later.";
            }

            $stmt->close();
            $customer_stmt->close();
        }
    } else {
        // Missing required fields: username, email, or password
        $errorMessage = "Error: Please provide all required fields.";
    }
}

$conn->close();
?>

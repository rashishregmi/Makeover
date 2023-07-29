<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        // Check if data from the registration form is present
        isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"])
    ) {
        // Insert data from the registration form
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Perform the database insertion for the registration form
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        try {
            if ($stmt->execute()) {
                // Registration successful, redirect to appointment form or a success page
                header("Location: http://localhost/Makeover/html/Appointment2.html");
                exit;
            } else {
                // Redirect back to registration form with an error message
                header("Location: http://localhost/Makeover/html/login.html#");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Check if the error is a duplicate entry error
            if ($stmt->errno === 1062) { // Error code for duplicate entry
                // Redirect back to registration form with an error message for duplicate username or email
                header("Location: http://localhost/Makeover/html/login.html#");
                exit;
            } else {
                // Redirect back to registration form with a general error message
                header("Location: http://localhost/Makeover/html/login.html");
                exit;
            }
        }

        $stmt->close();
    } elseif (
        // Check if data from the appointment form is present
        isset($_POST["fullname"]) &&
        isset($_POST["contact"]) &&
        isset($_POST["topics"]) &&
        isset($_POST["myCalender"]) &&
        isset($_POST["myDate"])
    ) {
        // Insert data from the appointment form
        $fullname = $_POST["fullname"];
        $contact = $_POST["contact"];
        $topics = implode(", ", $_POST["topics"]);
        $appointmentDate = $_POST["myCalender"];
        $appointmentTime = $_POST["myDate"];

        // Perform the database insertion for the appointment form
        $sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time, username) 
                VALUES (?, '', ?, '', ?, ?, ?, '')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fullname, $contact, $topics, $appointmentDate, $appointmentTime);

        try {
            if ($stmt->execute()) {
                // Data inserted successfully, you can redirect to a success page if needed.
                // For example:
                header("Location: http://localhost/Makeover/html/success.html");
                exit;
            } else {
                // Redirect back to the appointment form with an error message
                header("Location: http://localhost/Makeover/html/Appointment2.html#");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Handle any errors that occurred during the execution of the query
            // For example, you can redirect back to the appointment form with an error message:
            header("Location: http://localhost/Makeover/html/Appointment2.html#");
            exit;
        }

        $stmt->close();
    } else {
        // Neither registration form data nor appointment form data is present
        // Redirect back to the appropriate form with an error message
        header("Location: http://localhost/Makeover/html/login.html#");
        exit;
    }
}

$conn->close();
?>

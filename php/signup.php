<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are provided
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check for duplicate entries in the 'users' table
        $check_duplicate_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $check_stmt = $conn->prepare($check_duplicate_sql);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // User with the same username or email already exists
            $errorMessage = "Error: The username or email is already registered.";
        } else {
            // Insert the new user into the 'users' table if no duplicate entries found
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

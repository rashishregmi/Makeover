<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        try {
            if ($stmt->execute()) {
                // Registration successful, redirect back to login page with a success message
                header("Location: http://localhost/Makeover/html/login.html");
                exit;
            } else {
                // Redirect back to signup page with a general error message
                header("Location: http://localhost/Makeover/html/login.html#");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Check if the error is a duplicate entry error
            if ($stmt->errno === 1062) { // Error code for duplicate entry
                // Redirect back to signup page with an error message for duplicate username
                header("Location: http://localhost/Makeover/html/login.html#");
                exit;
            } else {
                // Redirect back to signup page with a general error message
                header("Location: http://localhost/Makeover/html/login.html");
                exit;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

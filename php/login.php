<?php
session_start();
require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful, redirect to dashboard or home page
        header("Location: http://localhost/Makeover/html/Appointment2.html");
        exit;
    } else {
        // Login failed, redirect back to login page with an error message
        header("Location: http://localhost/Makeover/html/login.html#");
        exit;
    }
    
    $stmt->close();
}

$conn->close();
?>

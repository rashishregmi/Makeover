<?php
$Username = $_POST['username'];
$Password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'makeover');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Check if Username and Password match
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $Username, $Password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows === 1) {
        // Username and Password matched, redirect to Appointment page
        header("Location: ../html/appointment.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
    $conn->close();
}
?>

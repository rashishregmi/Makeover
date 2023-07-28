<?php
$fullname = $_POST['fullname'];   //input name
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'makeover');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Check if Fullname is not empty
    if (!empty($fullname)) {
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password)
            VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $username, $email, $password);
        $stmt->execute();
        $stmt->close();
        echo "Registration successful.";
        // Redirect to login page after successful registration
        header("Location: http://localhost/Makeover/html/login.html");
        exit();
    } else {
        echo "Fullname cannot be empty.";
    }
    $conn->close();
}
?>

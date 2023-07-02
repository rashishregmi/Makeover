<?php
$Fullname = $_POST['Fullname'];
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'makeover');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Check if Fullname is not empty
    if (!empty($Fullname)) {
        $stmt = $conn->prepare("INSERT INTO users (Fullname, Username, Email, Password)
            VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Fullname, $Username, $Email, $Password);
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

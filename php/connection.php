<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);


$username = $_POST['username'];//input name
$email = $_POST['email'];
$password = $_POST['password'];


echo "Form data received:\n";
echo "Username: " . $username . "\n";
echo "Email: " . $email . "\n";
echo "Password: " . $password . "\n";


// Database connection
$conn = new mysqli('localhost', 'root', '', 'makeover');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Check if Fullname is not empty
    if (!empty($username)) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->close();
        echo "Registration successful.";
        // Redirect to login page after successful registration
        header("Location: http://localhost/Makeover/html/login.html");
        exit();
    } else {
        echo "Username cannot be empty.";
    }
    $conn->close();
}
?>

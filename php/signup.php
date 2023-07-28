<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makeover";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Print the received POST data
    print_r($_POST);

    // Get the user's registration data from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Debugging: Check if data is received correctly
    echo "Username: " . $username . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Password: " . $password . "<br>";

    // ... (rest of the code for hashing password, preparing SQL query, etc.)

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "Registration successful!";
    } else {
        // Error occurred during registration
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

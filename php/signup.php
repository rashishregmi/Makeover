<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

var_dump($_POST);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makeover";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Database query to insert data
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "Data stored successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>



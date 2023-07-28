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

        if ($stmt->execute()) {
            header("Location: http://localhost/Makeover/html/login.html#");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

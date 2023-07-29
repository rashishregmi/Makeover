<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["fullname"]) &&
        isset($_POST["contact"]) &&
        isset($_POST["topics"]) &&
        isset($_POST["myCalender"]) &&
        isset($_POST["myDate"])
    ) {
        $fullname = $_POST["fullname"];
        $contact = $_POST["contact"];
        $topics = implode(", ", $_POST["topics"]);
        $appointmentDate = $_POST["myCalender"];
        $appointmentTime = $_POST["myDate"];

        $sql = "INSERT INTO appointments (first_name, last_name, contact, email, services, selected_date, selected_time) 
        VALUES ('$fullname', '', '$contact', '', '$topics', '$appointmentDate', '$appointmentTime')";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully, display the success message
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

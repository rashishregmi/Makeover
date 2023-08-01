 
<?php
$servername_makeover_admin = "localhost"; // Update with your server name
$username_makeover_admin = "root"; // Replace with your database username for makeover_admin
$password_makeover_admin = ""; // Replace with your database password for makeover_admin
$dbname_makeover_admin = "makeover_admin"; // Replace with your database name for makeover_admin

// Create connection
$conn_makeover_admin = new mysqli($servername_makeover_admin, $username_makeover_admin, $password_makeover_admin, $dbname_makeover_admin);

// Check connection
if ($conn_makeover_admin->connect_error) {
    die("Connection failed: " . $conn_makeover_admin->connect_error);
}
?>

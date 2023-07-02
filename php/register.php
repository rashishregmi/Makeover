<?php
// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = $_POST["fullname"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Connect to the database
  $conn = mysqli_connect("localhost", "username", "password", "database_name");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute the SQL query
  $sql = "INSERT INTO users (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$password')";
  
  if (mysqli_query($conn, $sql)) {
    // Registration successful, redirect to the login page or desired page
    header("Location: login.php");
    exit();
  } else {
    // Error occurred during registration
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Makeover - Register</title>
  <link rel="stylesheet" href="./../css/register.css">
</head>
<body>
  <div class="container">
    <h1>Makeover</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
      <input type="text" name="username" id="username" placeholder="Username" required>
      <input type="text" name="email" id="email" placeholder="Email" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <input type="submit" value="Register" class="btn">
      <div class="forgot-password">
        <a href="#">Forgot password?</a>
      </div>
    </form>
    <div class="create-account">
    </div>
  </div>
</body>
</html>

<?php
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Connect to the database
  $conn = mysqli_connect("localhost", "username", "password", "database_name");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute the SQL query
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  // Check if the login credentials are valid
  if (mysqli_num_rows($result) == 1) {
    // Login successful, redirect to the dashboard or desired page
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid login credentials
    echo "Invalid username or password.";
  }

  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Makeover - Login</title>
  <link rel="stylesheet" href="./../css/login.css">
</head>
<body>
  <div class="container">
    <h1>Makeover</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="username"> </label>
      <input type="text" name="username" id="username" placeholder="Username" required>
      
      <label for="password"> </label>
      <div class="password-input">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class="fa-solid fa-eye"></i>
      </div>
      
      <input type="submit" value="Log In" class="btn">
      
      <div class="forgot-password">
        <a href="#">Forgot password?</a>
      </div>
    </form>
    <button class="create-account-btn" style="font-size: 17px;" onclick="openRegisterPage()">Create new account</button>
  </div>
  <script>
    function openRegisterPage() {
      window.location.href = "signup.php";
    }
  </script>
</body>
</html>

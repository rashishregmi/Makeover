<!DOCTYPE html>
<html>
<head>
  <title>Makeover - Sign Up</title>
  <link rel="stylesheet" href="./../css/signup.css">
</head>
<body>
  <div class="container">
    <h1>Sign up</h1>
    
      <form action="connection.php" method="post" onsubmit="return validateForm()">

        <input type="text" name="Fullname" id="fullname" placeholder="Full Name" required>
    
        <input type="text" name="Username" id="username" placeholder="Username" required>

        <input type="text" name="Email" id="email" placeholder="Email" required>
        
        <input type="password" name="Password" id="password" placeholder="Password" required>
        
        <input type="submit" value="Sign Up" class="btn">
      
        <div class="login">
          <p>Already have an account? <a href="./login.html">Log in</a></p>
        </div>
      </form>
  </div>

  <script>
    function validateForm() {
      var fullname = document.getElementById('fullname').value;
      var username = document.getElementById('username').value;
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;

      if (fullname.trim() === '') {
        alert('Please enter your full name');
        return false;
      }

      if (username.trim() === '') {
        alert('Please enter a username');
        return false;
      }

      if (email.trim() === '') {
        alert('Please enter an email address');
        return false;
      }

      // Email validation
      var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
      if (!email.match(emailRegex)) {
        alert('Please enter a valid email address');
        return false;
      }

      if (password.trim() === '') {
        alert('Please enter a password');
        return false;
      }

      // Password validation
      var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!password.match(passwordRegex)) {
        alert('Please enter a password with at least 8 characters, one capital letter, and one special symbol');
        return false;
      }

      return true;
    }
  </script>
</body>
</html>

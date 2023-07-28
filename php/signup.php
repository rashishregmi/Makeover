<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // You should add more validation and sanitization for the form data here before storing it in the database.

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to login page or dashboard
        header("Location: http://localhost/Makeover/html/login.html");
        exit;
    } else {
        // Registration failed, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/login.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo-bg">
                <div class="logo-girl"></div>
                <span class="logo">
                    Makeover
                </span>
            </div>
            <ul>
                <li><a href="./../html/Home.html" class="links">Home</a></li>
                <li><a href="./../html/About.html" class="links">About</a></li>
                <li><a href="./../html/Services.html" class="links">Service</a></li>
                <li><a href="./../html/Appointment.html" class="links">Appointment</a></li>
                <li><a href="./../html/Contact.html" class="links">Contact</a></li>
                <li><a href="./../html/login.html" class="links">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <div class="wrapper">
            <div class="form-box login">
                <h2>Login</h2>

                <form action="#">
                     
                <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" id="email1" name="email"  required>
                <label for="">Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" id="password1" name="password" required>
                <label for="">Password</label>
            </div>
             
            <button type="submit" class="btn" id="btn" name="btn">Login</button>
            <div class="login-register">
                <p>Don't have an account?
                    <a href="#" class="register-link">
                        Register
                    </a>
                </p>

            </div>


                </form>
            </div>
            <div class="form-box register">
                <h2>Registration</h2>
                <form action="./../../makeover/php/signup.php" method="POST">
                     
                <div class="input-box">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="text" id="username" name="username" required>
                <label for="">Username</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" id="email" name="email" required>
                <label for="">Email</label>
            </div> 
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" id="password" name="password" required>
                <label for="">Password</label>
            </div>
            <div class="remember-forget">
                <label for="">
                    <input type="checkbox" id="terms" name="checkbox">
                    I agree to terms & conditions
                </label>
            </div>
            <button type="submit" class="btn" id="btn2">Register</button>
            <div class="login-register">
                <p>Already have an account?
                    <a href="#" class="login-link">
                        Login
                    </a>
                </p>

            </div>


                </form>
            </div>
        </div>
    </div>

    <script src="./../../makeover/js/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

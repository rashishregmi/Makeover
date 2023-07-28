<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "Form data received:\n";
    echo "Email: " . $email . "\n";
    echo "Password: " . $password . "\n";


    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to dashboard or home page
        header("Location: http://localhost/Makeover/html/Appointment2.html");
        exit;
    } else {
        // Login failed, display error message
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../../makeover/css/login.css">
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

                <form action="./../../makeover/php/login.php" method="POST">
                    <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" id="email1" name="email" required>
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
        </div>
            <div class="form-box register">
                <h2>Registration</h2>

                <form action="#">
                    
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
                    <input type="checkbox" id="terms">
                    I agree to terms & conditions
                </label>
            </div>
            <button type="submit" class="btn" id="btn2" name="btn">Register</button>
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

<?php
 $fullname = $_POST['fullname'];
 $username = $_POST['username'];
 $email = $_POST['email'];
 $passwprd = $_POST['password'];

   //Database connection
$conn = new mysqli('localhost','root','','makeover');
if($conn->connect_error){
 die('Connection Failed : '.$conn->connect_error);
}else{
$stmt = $conn->prepare("insert into signup(fullname,username,email,password)
       values(?,?,?,?)");
$stmt->bind_param("ssss",$fullname, $username, $email, $password);
$stmt->execute();
echo "registration Successfully....";
$stmt->close();
$conn->close();
}




?>
<?php
include 'connection.php';

$fn = $_POST['fname'];
$ln = $_POST['lname'];
$cnic = $_POST['cnic'];
$email = $_POST['email'];
$p = $_POST['password'];
$g = $_POST['gender'];
$a = $_POST['address'];
$t = $_POST['town'];
$c = $_POST['city'];
$pro = $_POST['province'];

$sql = "INSERT INTO `user` (`CNIC`, `Fname`, `Lname`, `Email`, `Password`, `Gender`, `Vote1`,`Vote2`, `Seat1`, `Seat2`, `address`,`town`, `city`, `province`) VALUES ($cnic, '$fn', '$ln','$email', '$p','$g',NULL,NULL,NULL,NULL,'$a','$t','$c','$pro');";

if(mysqli_query($conn, $sql)) {  
     // Display success message
     echo "Record inserted successfully. Redirecting...";
     
     // Redirect after 2 seconds
     header("refresh:2; url=admin_user.php");
 } else {  
     // Display error message
     echo "Could not insert record: ". mysqli_error($conn);  
     header("refresh:2; url=admin_user.php");
 } 

mysqli_close($conn);

?>
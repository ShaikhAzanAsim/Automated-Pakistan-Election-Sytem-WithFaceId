<?php
include 'connection.php';

$cnic = $_POST['cnic'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$g = $_POST['gender'];
$v1 = $_POST['v1'];
$v2 = $_POST['v2'];
$s1 = $_POST['s1'];
$s2 = $_POST['s2'];
$add = $_POST['address'];
$t = $_POST['town'];
$c = $_POST['city'];
$p = $_POST['province'];

$sql= "UPDATE `user` SET `Fname`='$fname',`Lname`='$lname',`Email`='$email',`Password`='$pass',`Gender`='$g',`Vote1`='$v1',`Vote2`='$v2',`Seat1`='$s1',`Seat2`='$s2',`address`='$add',`town`='$t',`city`='$t',`province`='$p' WHERE `CNIC`='$cnic'";
if(mysqli_query($conn, $sql)) {  
    // Display success message
    echo "Record updated successfully. Redirecting...";
    
    // Redirect after 2 seconds
    header("refresh:2; url=admin_user.php");
} else {  
    // Display error message
    echo "Could not update record: ". mysqli_error($conn);  
    header("refresh:2; url=admin_user.php");
} 

mysqli_close($conn);

?>
<?php
include 'connection.php';

$status = $_POST['status'];
$town = $_POST['town'];
$city = $_POST['city'];
$province = $_POST['province'];
$wp=NULL;
$wc=NULL;

$sql = "INSERT INTO `seat` (`id`, `status`, `winner_party`, `winner_candidate`, `town`, `city`, `province`) VALUES (NULL, '$status', NULL, NULL,'$town', '$city','$province');";

if(mysqli_query($conn, $sql)) {  
     // Display success message
     echo "Record inserted successfully. Redirecting...";
     
     // Redirect after 2 seconds
     header("refresh:2; url=admin_seat.php");
 } else {  
     // Display error message
     echo "Could not insert record: ". mysqli_error($conn);  
     header("refresh:2; url=admin_seat.php");
 } 

mysqli_close($conn);

?>
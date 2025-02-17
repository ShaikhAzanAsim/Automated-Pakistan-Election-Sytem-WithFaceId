<?php
include 'connection.php';

$pid = $_POST['party_id'];
$s1 = $_POST['seat1_id'];
$s2 = $_POST['seat2_id'];
$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$cid = $_POST['candidate_id'];


$sql = "INSERT INTO `candidate` (`first_name`, `last_name`, `candidate_id`, `Party_id`, `seat1`, `seat2`) VALUES ('$fn', '$ln','$cid', '$pid','$s1','$s2');";

if(mysqli_query($conn, $sql)) {  
     // Display success message
     echo "Record inserted successfully. Redirecting...";
     
     // Redirect after 2 seconds
     header("refresh:2; url=admin_candidate.php");
 } else {  
     // Display error message
     echo "Could not insert record: ". mysqli_error($conn); 
     header("refresh:2; url=admin_candidate.php"); 
 } 

mysqli_close($conn);

?>
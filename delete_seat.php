<?php
include 'connection.php';

$id = $_POST['seat_id'];


$sql = "delete from seat where id='$id';";


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
<?php
include 'connection.php';

$id = $_POST['party_id'];


$sql = "delete from party where party_id='$id';";


if(mysqli_query($conn, $sql)) {  
     // Display success message
     echo "Record inserted successfully. Redirecting...";
     
     // Redirect after 2 seconds
     header("refresh:2; url=admin_party.php");
 } else {  
     // Display error message
     echo "Could not insert record: ". mysqli_error($conn); 
     header("refresh:2; url=admin_party.php"); 
 } 

mysqli_close($conn);

?>
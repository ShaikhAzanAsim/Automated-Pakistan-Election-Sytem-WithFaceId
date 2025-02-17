<?php
include 'connection.php';

$name = $_POST['name'];
$chname = $_POST['chName'];


$sql = "INSERT INTO `party` (`party_id`, `name`, `Chairman`, `PM_id`, `Pres_id`) VALUES (NULL, '$name','$chname', NULL,NULL);";

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
<?php
include 'connection.php';

$id = $_POST['id'];
$name = $_POST['pName'];
$chname = $_POST['chName'];
$pres = $_POST['president'];
$pm = $_POST['PM'];


$sql= "UPDATE `party` SET `name`='$name',`Chairman`='$chname',`PM_id`='$pm',`Pres_id`='$pres' WHERE `party_id`='$id'";
if(mysqli_query($conn, $sql)) {  
    // Display success message
    echo "Record updated successfully. Redirecting...";
    
    // Redirect after 2 seconds
    header("refresh:2; url=admin_party.php");
} else {  
    // Display error message
    echo "Could not update record: ". mysqli_error($conn);  
    header("refresh:2; url=admin_party.php");
} 

mysqli_close($conn);

?>
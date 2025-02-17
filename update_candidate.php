<?php
include 'connection.php';

$id = $_POST['id'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pid = $_POST['partyId'];
$s1 = $_POST['seat1ID'];
$s2 = $_POST['seat2ID'];


$sql= "UPDATE `candidate` SET `first_name`='$fname',`last_name`='$lname',`Party_id`='$pid',`seat1`='$s1',`seat2`='$s2' WHERE `candidate_id`='$id'";
if(mysqli_query($conn, $sql)) {  
    // Display success message
    echo "Record updated successfully. Redirecting...";
    
    // Redirect after 2 seconds
    header("refresh:2; url=admin_candidate.php");
} else {  
    // Display error message
    echo "Could not update record: ". mysqli_error($conn);  
    header("refresh:2; url=admin_candidate.php");
} 

mysqli_close($conn);

?>
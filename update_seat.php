<?php
include 'connection.php';

$id = $_POST['id'];

$s = $_POST['status'];
$wc = $_POST['wc'];
$wp = $_POST['wp'];
$t = $_POST['town'];
$c = $_POST['city'];
$p = $_POST['province'];

$sql= "UPDATE `seat` SET `status`='$s',`winner_candidate`='$wc',`winner_party`='$wp',`town`='$t',`city`='$c',`province`='$p' WHERE `id`='$id'";
if(mysqli_query($conn, $sql)) {  
    // Display success message
    echo "Record updated successfully. Redirecting...";
    
    // Redirect after 2 seconds
    header("refresh:2; url=admin_seat.php");
} else {  
    // Display error message
    echo "Could not update record: ". mysqli_error($conn);  
    header("refresh:2; url=admin_seat.php");
} 

mysqli_close($conn);

?>
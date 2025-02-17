<?php
include 'connection.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$party_id = $_POST['party'];

//echo "$party_id";


// Read 15 characters from a text file and store them in a variable called cnic_check
$cnic_check_file = 'last_predicted_cnic.txt'; // Replace with the path to your text file
$cnic_check = substr(file_get_contents($cnic_check_file), 0, 15);

require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

$query= "UPDATE `user` set `vote2` = '$party_id' WHERE cnic = '$cnic_check'";

mysqli_query($conn, $query);
$sql = "SELECT name FROM `party` where party_id= '$party_id';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$party_name=$row["name"];


$sql2 = "SELECT Fname,Lname,email FROM `user` WHERE CNIC = '$cnic_check' ;";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$fname=$row2["Fname"];
$lname=$row2["Lname"];
$email=$row2["email"];


$sql3 = "select candidate.first_name,candidate.last_name from candidate where candidate.seat2=(SELECT user.Seat2 from user where cnic='$cnic_check') and candidate.Party_id='$party_id';";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);
$c_fname=$row3["first_name"];
$c_lname=$row3["last_name"];

if(mysqli_query($conn, $query)){  
   

     // Email sending
     $fname = htmlspecialchars($fname);
     $lname = htmlspecialchars($lname);
     $vote2 = htmlspecialchars($party_name);
     $c_fname = htmlspecialchars($c_fname);
     $c_lname = htmlspecialchars($c_lname);

     $message = "Dear $fname $lname,\n\n";
     $message .= "BELOW ARE YOUR VOTING DETAILS:\n";
     $message .= "Your NA vote is for: $vote2\n";
     $message .= "Your Candidate name is: $c_fname $c_lname\n";
     $message .= "\n";
     $message .= "Thank you for voting!!!\n";
     $message .= "\n";
     $message .= "VISIT OUR WEBSITE FOR MORE DETAILS\n www.pakselection.pk \n";
     $message .= "\n";
     $message .= "THIS EMAIL WAS GENERATED AUTOMATICALLY, PLEASE DO NOT REPLY TO THIS EMAIL.";

     $subject = "NATIONAL ASSEMBLY VOTE";

     // Sender's email address
     $from = "azanasim1@gmail.com";

     try {
         //Server settings
         $mail->isSMTP();                        // Set mailer to use SMTP
         $mail->Host       = 'smtp.gmail.com';   // Specify main and backup SMTP servers
         $mail->SMTPAuth   = true;               // Enable SMTP authentication
         $mail->Username   = 'azanasim1@gmail.com'; // SMTP username
         $mail->Password   = 'tlny vdjd zjis uklz'; // SMTP password
         $mail->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted
         $mail->Port       = 587;                // TCP port to connect to

         //Recipients
         $mail->setFrom($from, 'Your Name');
         $mail->addAddress($email); // Add a recipient

         // Content
         $mail->isHTML(false); // Set email format to plain text
         $mail->Subject = $subject;
         $mail->Body    = $message;

         // Send email
         $mail->send();
         
         echo "<div class='container'><h1> VOTE SUCCESSFUL </h1><p>Vote successful! An email has been sent to you with your Voting details.</p></div>";?>
         <h1>THANK YOU <?php echo $fname ." " . $lname; ?> FOR VOTING!</h1>
         <?php

        $sql_v = "SELECT vote1 FROM `user` WHERE CNIC = '$cnic_check' ;";
        $result_V = mysqli_query($conn,$sql_v);
        $row_V = mysqli_fetch_assoc($result_V);
        $vote=$row_V["vote1"];
        
        if($vote==NULL){
            echo "click <a href='votechoose_PA.html'>here</a> to continue voting for PROVISONAL ASSEMBLY";
        }else{
            echo "click <a href='index_1.html'>here</a> to continue";
        }
     } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         echo "<div class='container'><h1> VOTE SUCCESSFUL </h1><p>Vote successful! Failed to send email. Please contact support.</p></div>";
     }


       
}else{  
       
     echo "Could not insert record: ". mysqli_error($conn);  
     header("Location: index.html");
    }  
   
   


mysqli_close($conn);


?>

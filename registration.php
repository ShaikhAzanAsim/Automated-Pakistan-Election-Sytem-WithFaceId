<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELECTION</title>
</head>
<body>

<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["first_name"];
    $lname = $_POST["last_name"];
    $email = $_POST["email"];
    $cnic = $_POST["cnic"];
    $vote1 = NULL; 
    $vote2 = NULL; 
    $seat1 = 0;//provisional
    $seat2 = 0; //natinal assembly
    $add = $_POST["address"];
    $town = $_POST["town"];
    $city = $_POST["city"];
    $province = $_POST["province"];

    // Password generation
    function generateRandomPassword($length) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $charLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charLength - 1)];
        }
        return $password;
    }
    $p = generateRandomPassword(10);
    $passwordHash = password_hash($p, PASSWORD_BCRYPT);

    // Gender detection
    $lastCharacter = substr($cnic, -1);
    $gender = ($lastCharacter % 2 == 0) ? 'F' : 'M';


    // Check if the email already exists
    $stmt = $conn->prepare("SELECT cnic FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();



    if ($stmt->num_rows > 0) {
        ?>
        <div class="container">
            <h1> EMAIL ALREADY EXISTS </h1>
            <p>Email already exists. Please choose a different one. <a href='index.html'>Back</a></p>
        </div>
        <?php
    } else {


        $sql = "SELECT * FROM `seat`;";
        $result=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
        if($row["town"]==$town && $row["city"]==$city && $row["province"]==$province)
            $seat1 = intval($row["id"]);
        if($row["status"]=="NA"&&$row["city"]==$city && $row["province"]==$province && $row["town"]==NULL)
            $seat2 = intval($row["id"]); 
        }

        // Insert the user data into the database
        $stmt = $conn->prepare("INSERT INTO user (CNIC, fname, lname, email, password, gender, vote1, vote2, seat1, seat2, address, town, city, province) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)");
        $stmt->bind_param("ssssssiiiissss", $cnic, $fname, $lname,$email, $passwordHash, $gender, $vote1, $vote2, $seat1, $seat2,$add,$town,$city,$province);

        

        require 'PHPMailer-master\src\Exception.php';
        require 'PHPMailer-master\src\PHPMailer.php';
        require 'PHPMailer-master\src\SMTP.php';

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

    // Try to execute the statement
    if ($stmt->execute()) {
        // Email sending
        $fname = htmlspecialchars($fname);
        $lname = htmlspecialchars($lname);
        $email = htmlspecialchars($email);
        $p = htmlspecialchars($p);
        $seat1 = htmlspecialchars($seat1);
        $seat2 = htmlspecialchars($seat2);
        $cnic= htmlspecialchars($cnic);

        $message = "Dear $fname $lname,\n\n";
        $message .= "BELOW ARE YOUR LOGIN DETAILS:\n";
        $message .= "Your email address is: $email\n";
        $message .= "Your CNIC is: $cnic\n";
        $message .= "Your password is: $p\n";
        $message .= "\n";
        $message .= "This is your seat for Provisional Assembly: $seat1\n";
        $message .= "This is your seat for National Assembly: $seat2\n";
        $message .= "\n";
        $message .= "VISIT OUR WEBSITE FOR MORE DETAILS\n www.pakselection.pk \n";
        $message .= "Thank you for registering.\n";
        $message .= "THIS EMAIL WAS GENERATED AUTOMATICALLY, PLEASE DO NOT REPLY TO THIS EMAIL.";

        $subject = "ELECTION CONFIDENTIAL";

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
            echo "<div class='container'><h1> REGISTRATION SUCCESSFUL </h1><p>Registration successful! An email has been sent to you with login details.</p></div>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "<div class='container'><h1> REGISTRATION SUCCESSFUL </h1><p>Registration successful! Failed to send email. Please contact support.</p></div>";
        }
    } else {
        ?>
        <div class="container">
            <h1> REGISTRATION ERROR </h1>
            <p>Error during registration. Please try again. <a href='index.html'>Back</a></p>
        </div>
        <?php
    }

           
        
    }

    $stmt->close();
    $conn->close();
}

?>


</body>
</html>

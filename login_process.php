<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Process</title>
</head>
<body>

<?php
// Read 15 characters from a text file and store them in a variable called cnic_check
$cnic_check_file = 'last_predicted_cnic.txt'; // Replace with the path to your text file
$cnic_check = substr(file_get_contents($cnic_check_file), 0, 15);

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $cnic = $_POST["cnic"];
    $password = $_POST["password"];

    if ($email === "pak@army.com" && $password === "12345") {
        // Redirect to admin.php
        header("Location: admin.html");
        exit();
    }

    // Retrieve the hashed password and CNIC from the database
    $stmt = $conn->prepare("SELECT Password, CNIC FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashedPassword, $storedCNIC);
    $stmt->fetch();
    $stmt->close();

    if ($hashedPassword) {
        // Password is correct, now check CNIC
        if (password_verify($password, $hashedPassword) && $cnic === $cnic_check) {
            // Password and CNIC are correct, start a session and redirect to a secure page
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['cnic'] = $storedCNIC;
            // Redirect to a secure page (e.g., dashboard)
            
            $sql_v = "SELECT Vote1,Vote2 FROM `user` WHERE CNIC = '$cnic_check' ;";
            $result_V = mysqli_query($conn,$sql_v);
            $row_V = mysqli_fetch_assoc($result_V);
            $vote1=$row_V["Vote1"];
            $vote2=$row_V["Vote2"];

            if($vote1==NULL && $vote2==NULL){
                header("Location: index.html");
                exit();
            }elseif($vote1==NULL && $vote2!=NULL){
                header("Location: index.html");
                exit();
            }
            elseif($vote1!=NULL && $vote2==NULL){
                header("Location: index.html");
                exit();
            }
            elseif($vote1!=NULL && $vote2!=NULL){
                header("Location: index_1.html");
                exit();
            }
            
        } else {
            // Incorrect email, password, or CNIC
            ?>
            <div class="container">
                <h1> INCORRECT CREDENTIALS </h1>
                <?php if (!$hashedPassword) { ?>
                    <p>Email not found. Please register. <a href='register.php'>Click here to register</a></p>
                <?php } elseif (!password_verify($password, $hashedPassword)) { ?>
                    <p>Incorrect password. Please try again. <a href='login.html'>Back</a></p>
                <?php } else { ?>
                    <p>Incorrect CNIC. Please try again. <a href='login.html'>Back</a></p>
                <?php } ?>
            </div>
            <?php
        }
        
    } else {
        // Email not found
        ?>
        <div class="container">
            <h1> EMAIL NOT FOUND </h1>
            <p>Email not found. Please register. <a href='register.php'>click here to register</a></p>
        </div>
        <h3> <?php echo "Email not found. Please register. <a href='login.html'>Back</a>";?></h3>
        <?php
    }
}
?>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>

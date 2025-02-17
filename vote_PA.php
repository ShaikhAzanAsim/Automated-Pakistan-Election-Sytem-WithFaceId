<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELECTION</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Light gray background */
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h1 {
            text-align: center;
            color: #2c662d; /* Dark green */
        }

        .container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }

        .container input[type="radio"] {
            margin-right: 10px;
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #d8ffd3; /* Light green */
            border: 2px solid #2c662d; /* Dark green */
            margin-right: 10px;
        }

        .container input[type="radio"]:checked + .checkmark {
            background-color: #2c662d; /* Dark green */
        }

        .checkmark:after {
            content: "";
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #fff; /* White */
        }

        .container input[type="radio"]:checked + .checkmark:after {
            display: block;
        }

        .party-info {
            display: flex;
            flex-direction: column;
        }

        .party-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .candidate-info {
            font-size: 14px;
            color: #666;
        }

        button {
            background-color: #2c662d; /* Dark green */
            color: #fff; /* White */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2e9d3a; /* Lighter green */
        }
    </style>
</head>
<body>

<?php
include 'connection.php';
?>

<?php
// Read 15 characters from a text file and store them in a variable called cnic_check
$cnic_check_file = 'last_predicted_cnic.txt'; // Replace with the path to your text file
$cnic_check = substr(file_get_contents($cnic_check_file), 0, 15);


$sql = "select party.party_id ,party.name,candidate.first_name,candidate.last_name from party INNER join candidate on party.party_id=candidate.party_id where candidate.seat1=(select user.Seat1 from user where user.CNIC='$cnic_check');";

$result = mysqli_query($conn, $sql);

?>

<div class="form-container">
    <h1>CHOOSE THE PARTY YOU WANT TO VOTE FOR IN PROVINCIAL ASSEMBLY</h1>
    <form id="votingForm" method="post" action="submit_vote_PA.php" onsubmit="return confirmVote()">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <label class="container">
                    <input type="radio" name="party" value="<?php echo $row["party_id"]; ?>">
                    <span class="checkmark"></span>
                    <div class="party-info">
                        <span class="party-name"><?php echo $row["name"]; ?></span>
                        <span class="candidate-info">(<?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?>)</span>
                    </div>
                </label>
                <?php
            }
        }
        ?>
        <button type="submit">Submit Vote</button>
    </form>
</div>

<script>
    function confirmVote() {
        // Display a confirmation dialog
        return confirm("Are you sure you want to cast your vote?");
    }
</script>

</body>
</html>

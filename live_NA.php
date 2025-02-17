<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NA RESULTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 1800px; /* Increased width */
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .seat-button {
            background-color: #2c662d;
            color: #fff;
            border: none;
            border-radius: 20px; /* Rounded corners */
            padding: 15px 30px; /* Increased padding */
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
            transition: background-color 0.3s;
            text-decoration: none; /* Remove default link underline */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seat-button:hover {
            background-color: #2e9d3a;
        }
        .button-content {
            text-align: center;
        }

        .id {
            font-weight: bold;
        }
        .location{
            font-weight: none;
        }
    </style>
</head>
<body>

<?php
include 'connection.php';

$sql = "SELECT id, city, province FROM seat WHERE seat.status='NA'ORDER by id ASC;";
$result = mysqli_query($conn, $sql);
?>

<div class="form-container">
    <h1>CHOOSE THE SEAT NUMBER YOU WANT TO VIEW RESULT FOR IN NATIONAL ASSEMBLY</h1>
    <div class="button-container">
    <?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <a href="SEAT_NA_RESULT.php?seat_id=<?php echo $row['id']; ?>" class="seat-button">
                <div class="button-content">
                    <span class="id"><?php echo $row['id']; ?></span><br>
                    <span class="location"><?php echo $row['city'] . ', ' . $row['province']; ?></span>
                </div>
            </a>


            <?php
        }
    }
    ?>
    </div>
</div>

</body>

</html>

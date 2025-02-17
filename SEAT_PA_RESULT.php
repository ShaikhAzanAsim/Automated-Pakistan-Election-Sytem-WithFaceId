<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROVINCIAL Assembly Seat Results</title>

<style>
  body {
    font-family: sans-serif;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  table, th, td {
    border: 1px solid black;
  }
  th, td {
    padding: 5px;
  }
  .header {
    text-align: center;
  }
</style>   
</head>
<body>

<?php
include 'connection.php';
if(isset($_GET['seat_id'])) {
    $seat_id = $_GET['seat_id'];
    
    // Write seat ID to text file
    $file = fopen("SEAT_PA.txt", "w");
    fwrite($file, $seat_id);
    fclose($file);
}

$sql = "SELECT town,city,province FROM `seat` WHERE id = $seat_id and status=\"PA\";";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$city= $row["city"];
$town= $row["town"];
$province= $row["province"];


//male votes
$sql_male = "select count(Vote1)as m_votes from user where seat1=$seat_id and gender=\"M\";";
$result_M = mysqli_query($conn, $sql_male);
$row = mysqli_fetch_assoc($result_M);
$male= $row["m_votes"];
//female votes
$sql_female = "select count(Vote1)as f_votes from user where seat1=$seat_id and gender=\"F\";";
$result_F = mysqli_query($conn, $sql_female);
$row = mysqli_fetch_assoc($result_F);
$female= $row["f_votes"];
$total_votes=$female+$male;

?>


  <h1 class="header">Election Result Form</h1>
  <table>
    <tr>
      <th>Seat</th>
      <td colspan="">PA <?php echo $seat_id ?></td>
      <th>Province</th>
      <td colspan="2"><?php echo $province ?></td>
    </tr>
    <tr>
      <th>Name</th>
      <td colspan="4"><?php echo $town . ', ' . $city . ', ' . $province; ?></td>
    </tr>
      <tr>
      <th colspan=2>No. of  Male Voters Assigned to the seat</th>
      <td colspan=1><?php echo $male?></td>
      <th colspan=2>No. of  Female Voters Assigned to the Seat</th>
      <td colspan=1><?php echo $female?></td>
    </tr>
    <tr>
      <tr>
      <th colspan=2>Total No. of  Voters Assigned to the Seat</th>
      <td colspan=4><?php echo $total_votes?></td>
    </tr>
    <tr>
      <th>Sr. No.</th>
      <th colspan=3>Names of the Contesting Candidates</th>
      <th colspan=2>Number of Votes Polled in Favour of Each Contesting Candidate</th>
    </tr>
    <?php
      $count=0;
      $sql_name = "select name from party where party_id in (select DISTINCT vote1 from user where seat1=$seat_id);";
      $result=mysqli_query($conn, $sql_name);
      while($row_n= mysqli_fetch_assoc($result)) 
      {
          $party_name=$row_n["name"];
          $condition = " where name = '$party_name'";

          $sql_v1 = "select count(vote1) as num_v1 from user where Vote1 = (select party_id from party ".$condition.") and seat1=$seat_id;";
          $result_v = mysqli_query($conn, $sql_v1);
          $row_count = mysqli_fetch_assoc($result_v);
          $vote_count= $row_count["num_v1"];
          $count++; ?>

    <tr>
      <td><?php echo $count;?></td>
      <td colspan=3><?php echo $party_name;?></td>
      <td colspan=2><?php echo $vote_count;?></td>
    </tr>  
<?php } ?>
    <tr>
      <th colspan="4">Total</th>
      <td colspan=2><?php echo $total_votes;?></td>
    </tr>
    </table>
</body>





</body>
</html>

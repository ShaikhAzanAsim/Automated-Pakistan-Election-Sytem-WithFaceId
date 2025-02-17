<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Candidates Table</title>
<style>
.container {
    display: flex;
}

.table-container {
    width: 50%;
    margin-right: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    text-align: center;
}
</style>
</head>
<body>
<div class="container">
    <div class="table-container">
        <table>
            <tr><th colspan="3" style="color:green">National Assembly</th></tr>
            <tr><th>Serial Number</th><th>Candidate Name</th><th>Seat ID</th></tr>
            <?php
            include 'connection.php'; // Include the database connection file

            $sql = "select c.first_name,c.last_name,s.id from candidate c INNER join seat s on c.seat2=s.id INNER join party p ON c.Party_id=p.party_id\n"
            . "WHERE s.status=\"na\" && p.name=\"pmln\"\n"
            . "ORDER by s.id ASC;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $serial = 1; // Initialize serial number
                while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                        <td><?php echo $row["id"]; ?></td>
                    </tr>
                    <?php $serial++; // Increment serial number
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <div class="table-container">
        <table>
            <tr><th colspan="3" style="color:blue">Provincial Assembly</th></tr>
            <tr><th>Serial Number</th><th>Candidate Name</th><th>Seat ID</th></tr>
            <?php
            include 'connection.php'; // Include the database connection file

            $sql = "select c.first_name,c.last_name,s.id from candidate c INNER join seat s on c.seat1=s.id INNER join party p ON c.Party_id=p.party_id\n"
            . "WHERE s.status=\"pa\" && p.name=\"pmln\"\n"
            . "ORDER by s.id ASC;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $serial = 1; // Initialize serial number
                while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                        <td><?php echo $row["id"]; ?></td>
                    </tr>
                    <?php $serial++; // Increment serial number
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>

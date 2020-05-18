<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 1px solid #02024c;
        }
    </style>
</head>
<body>

<?php
include 'config.php';

$uid = $_SESSION['id'];
$sql_select = "SELECT club.name, request_positions.position, request.start_date, request.end_date
               FROM request, requests, request_positions, club
               WHERE requests.agency_id = '$uid' 
               and request.id = requests.request_id
               and requests.club_id = club.id
               and request.id = request_positions.id";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Club</th><th>Position</th><th>Start Date</th><th>End Date</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["club.name"]."</td><td>".$row["request_positions.position"]."</td><td>
             ".$row["request.start_date"]."</td><td>".$row["request.end_date"]."</td></tr>";
    }

    echo "</table>";
} else {
    echo "No requests yet.";
}
?>

</body>
</html>
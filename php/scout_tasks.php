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
$sql_select = "select request_positions.position, request.start_date, request.end_date
               from request_positions, request, assigns
               where assigns.scout_id = '$uid' 
               and request_positions.id = request.id
               and assigns.request_id = request.id;";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Position</th><th>Start Date</th><th>End Date</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["request_positions.position"]."</td><td>
             ".$row["request.start_date"]."</td><td>".$row["request.end_date"]."</td></tr>";
    }

    echo "</table>";
} else {
    echo "No tasks yet.";
}
?>

</body>
</html>
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
include 'header.php';

$uid = $_SESSION['id'];
$sql_select = "select request_positions.position as p, request.start_date as s, request.end_date as e
               from request_positions, request, assigns
               where assigns.scout_id = '$uid' 
               and request_positions.id = request.id
               and assigns.request_id = request.id;";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) {
    echo "<table class=\"table\"><tr><th>Position</th><th>Start Date</th><th>End Date</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["p"]."</td><td>
             ".$row["s"]."</td><td>".$row["e"]."</td></tr>";
    }

    echo "</table>";
} else {
    echo "No tasks yet.";
}
?>

<br>
<button type='button' class="btn btn-info" onclick="window.location.href='home_scout.php'">
    Home
</button>

</body>
</html>
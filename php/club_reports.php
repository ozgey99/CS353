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
$sql_select = "select footballer.name, scout.name, report.rating, report.comment, report.date
               from report, footballer_report, footballer, scout
               where report.scout_id = scout.id and report.id = footballer_report.report_id
               and footballer_report.footballer_id = footballer.id and report.club_id = '$uid';
";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Footballer</th><th>Scout</th><th>Rating</th><th>Comment</th><th>Date</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["footballer.name"]."</td><td>".$row["scout.name"]."</td><td>
             ".$row["report.rating"]."</td><td>".$row["report.comment"]."</td><td>".$row["report.date"]."</td></tr>";
    }

    echo "</table>";
} else {
    echo "No reports yet.";
}
?>

</body>
</html>
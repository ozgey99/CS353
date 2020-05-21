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
$sql_select = "select report.id as reportID, report.date as date, report.rating as rating, report.comment as comment, 
                scout.name as scout, footballer.name footballer 
                from report, reports, footballer_report, scout, club, footballer
                where report.id = reports.report_id 
                and report.id = footballer_report.report_id
                and reports.scout_id = scout.id
                and club.id = reports.club_id
                and club.id = '$uid'
                and footballer_report.footballer_id = footballer.id
                order by report.date desc";

$result = mysqli_query($cn, $sql_select);

if (mysqli_num_rows($result) > 0) {
    echo "<form name='form' action='view_report.php' method='post'>
        <table><tr><th>Footballer</th><th>Scout</th><th>Rating</th><th>Comment</th><th>Date</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["footballer"]."</td><td>".$row["scout"]."</td><td>
             ".$row["rating"]."</td><td>".substr($row["comment"],0, 20)."..."."</td><td>".$row["date"]."</td> <td>
             <input type='radio' name='select' value=".$row['reportID'] ."></td> </tr>";

    }

    echo "</table> <br><button type='submit' class='button' name='view' id='view'>View</button> 
  </form>";
?>
    <br> <button type='button' class='button' onclick="window.location.href='/cs353/php/transfer_offer.php'">
    Transfer Offer Page
    </button>
    <br> <button type='button' class='button' onclick="window.location.href='/cs353/php/home_club.php'">
        Home
    </button>
    <?php

} else {
    echo "No reports yet.";
}
?>

</body>
</html>
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
$sql_select = "select agent.name as agent, footballer.name as footballer, recommends.comment as comment                
                from recommends, agent, club, footballer
                where footballer.id = recommends.footballer_id 
                and recommends.agent_id = agent.id
                and club.id = recommends.club_id
                and club.id = '$uid'";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) {
    echo "<table class=\"table\"><tr><th>Footballer</th><th>Comment</th><th>Agent</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["footballer"]."</td><td>
             ".$row["comment"]."</td><td>".$row["agent"]."</td></tr>";
    }

    echo "</table>";
} else {
    echo "No recommendations yet.";
}
?>

<br>
<button type="button" class="btn btn-info" onclick="window.location.href='home_club.php'">
    Home
</button>

</body>
</html>
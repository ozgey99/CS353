<!DOCTYPE html>
<html lang="en">
<head>
    <title>Requests</title>

    <style>
        table, th, td {
            border: 0.5px solid #02024c;
        }
        .button {
            background-color: #4CAFBB;
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 16px 2px;
            border-radius: 4px;
        }
    </style>

</head>
<body>
<div align="right">
    <button type="button" class="button" onclick="window.location.href='home_agency.php'">
        Home
    </button>

    <button type="button" class="button" onclick="window.location.href='profile_agency.php'">
        Profile
    </button>
</div>


<?php
include 'config.php';

$uid = $_SESSION['id'];
$p = "pending";

$result3 = mysqli_query($cn, "select count(*) as c from scout, works 
                                    where scout.id = works.scout_id and scout.availability=0 
                                    and works.agency_id= $uid");
$existingNoOfScouts = $result3->fetch_assoc();

echo "existing no of available scouts: ".$existingNoOfScouts['c'];



$sql_select = "SELECT request.id as id, club.name as clubName, request.no_of_req_scouts as noOfScouts, 
                request.organization as org, request.start_date as sDate, request.end_date as eDate
               FROM request, requests, club
               WHERE requests.agency_id = '$uid'
               and requests.status = '$p' 
               and request.id = requests.request_id
               and requests.club_id = club.id";

$result = mysqli_query($cn, $sql_select);

if ($result->num_rows > 0) { ?>
    <div>
        <form name="form" action="respond_request.php" method="post">
            <table>
                <tr><th>Club</th><th>Number of Scouts</th><th>Organization</th><th>Positions</th><th>Start Date</th><th>End Date</th><th>Respond</th></tr>

                <?php
                while ($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["clubName"]."</td><td>".$row["noOfScouts"]."</td><td>".$row["org"]."</td>";
                    $query = "SELECT position FROM request_positions WHERE id=".$row['id'];
                    $result2 = mysqli_query($cn, $query);
                    $row2 = "";
                    while($positions = mysqli_fetch_assoc($result2)){
                        $row2 = $row2.$positions['position'].", ";
                    }
                    echo "<td>".$row2."</td><td>".$row["sDate"]."</td><td>".$row["eDate"]."</td><td> 
                        
                       <input type='radio' name='select' value=".$row['id'] ."></td></tr>";
                }
                ?>
            </table>

            <button type="submit" class="button" name="reject" id="reject">Reject</button>

            <button type="submit" class="button" name="accept" id="accept">Accept</button>

        </form>
    </div>

    <?php
} else {
    echo "No requests yet.";
}
?>

</body>
</html>

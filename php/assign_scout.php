<title>Assign Scout</title>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
require "config.php";
$requestId = $_SESSION['selectedRequest'];
$agencyID = $_SESSION['id'];



if(isset($_POST["framework"])) {
    foreach ($_POST["framework"] as $scoutID) {
        $a="accepted";
        $update = "UPDATE requests SET status = '$a' WHERE request_id= $requestId AND agency_id = '$agencyID'";
        $result3 = mysqli_query($cn, $update);
        $one =1;
        //set scout as not available
        $result = mysqli_query($cn, "update scout set availability = '$one' where id=".$scoutID);
        //fill assigns table
        $result2 = mysqli_query($cn, "insert into assigns values('$agencyID', '$requestId','$scoutID')");

    }
} ?>
<h2>Request is accepted</h2>
<h2>Scouts are assigned successfully</h2>
<div align="center">
    <button type="button" class="btn btn-info" onclick="window.location.href='home_agency.php'">
        Home
    </button>

    <button type="button" class="btn btn-warning" onclick="window.location.href='agency_requests.php'">
        See Other Requests
    </button>
</div>
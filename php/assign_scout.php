<link rel="stylesheet" type="text/css" href="style.css">
<?php
require "config.php";
$requestId = $_SESSION['selectedRequest'];
$agencyID = $_SESSION['id'];
if(isset($_POST["framework"])) {
    foreach ($_POST["framework"] as $scoutID) {
        $one =1;
        //set scout as not available
        $result = mysqli_query($cn, "update scout set availability = '$one' where id=".$scoutID);
        //fill assigns table
        $result2 = mysqli_query($cn, "insert into assigns values('$agencyID', '$requestId','$scoutID')");

        if($result == true && $result2 == true){
            echo "Scouts are assigned successfully";
        }
        else{
            echo "Something went wrong while assigning";
        }
    }
} ?>

<div align="center">
    <button type="button" class="button" onclick="window.location.href='home_agency.php'">
        Home
    </button>

    <button type="button" class="button" onclick="window.location.href='agency_requests.php'">
        See Other Requests
    </button>
</div>
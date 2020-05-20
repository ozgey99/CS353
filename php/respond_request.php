<html lang="en">
<head>
    <title>Assign Scout</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>
<body>
<?php
require "config.php";

$requestID = $_POST['select'];
$_SESSION['selectedRequest'] = $requestID;
$agencyID = $_SESSION['id'];

if( isset($_POST["accept"]) ){
    $a="accepted";
    $update = "UPDATE requests SET status = '$a' WHERE request_id= $requestID AND agency_id = '$agencyID'";

    if(mysqli_query($cn,$update)){
        ?> <h3 align='center'>You have accepted the request, assign some scouts</h3>
        <div>
            <?php
            $sql = "select club.name as clubName, a.no_of_req_scouts as noOfScouts, 
                            a.organization as org, a.start_date as sDate, a.end_date as eDate 
                            from request as a, requests as b, club
                            where a.id = '$requestID'
                            and a.id = b.request_id
                            and b.club_id = club.id";
            $result = mysqli_query($cn, $sql);
            $row = $result->fetch_assoc();
            $clubName = $row['clubName'];
            $noOfScouts = $row['noOfScouts'];
            $org = $row['org'];
            $sDate = $row['sDate'];
            $eDate = $row['eDate'];

            $sql2 = "select position as pos from request_positions where id= '$requestID'";
            $result2 = mysqli_query($cn, $sql2);



            echo "<div><p><b>Request Information</b></p><p><b>Club Name: </b>".$row['clubName']."</p>
                        
                     <p><b>Organization: </b>".$row['org']."</p>
                     <p><b>Start Date: </b>".$row['sDate']."</p>
                     <p><b>End Date: </b>".$row['eDate']."</p>
                     <p><b>Requested Scouts: </b>".$row['noOfScouts']."</p><b>Positions: </b>";

            while($row2 = $result2->fetch_assoc()){
                echo $row2['pos']."  ";
            }
            echo "</div>";

            ?>
            <br>
            <div class="form-group">
                <form name="scout" action="assign_scout.php" method="post" id="framework_form" onsubmit="return check()">
                    <select id="framework" name="framework[]" multiple class="form-control">

                        <?php
                        $sql3 = "select scout.name as scoutName, scout.id as scoutID from scout, works 
                                    where scout.id=works.scout_id
                                    and works.agency_id=$agencyID
                                    and scout.availability = 0";
                        $result3 = mysqli_query($cn, $sql3);
                        if(mysqli_num_rows($result3)<=0) {
                            echo "No scouts available\n";
                        }else{
                            while($row3=$result3->fetch_assoc()){
                                $sql4 = "select position from scout_position_exp where id=".$row3['scoutID'];
                                $result4 = mysqli_query($cn, $sql4);
                                $pos_exp = "";
                                while($row4 = $result4->fetch_assoc()){
                                    $pos_exp = $pos_exp . " ". $row4['position'];
                                }
                                echo "<option value=". $row3['scoutID'].">".$row3['scoutName']."( ".$pos_exp." )"."</option>";
                            }
                        }
                        ?>
                    </select>

                    <div class="form-group">
                        <br>
                        <input name="submit" type="submit" class="btn btn-info" value="Continue">
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
else{
    $rejected = "rejected";
    $r="rejected";
    $update = "UPDATE requests SET status = '$r' WHERE request_id= '$requestID'AND agency_id = '$agencyID' ";
    if(mysqli_query($cn,$update)) {
        echo "update successful";
    }
    else{
        echo "not successful";
    }
    ?>
    <div align="center">
        <button type="button" class="button" onclick="window.location.href='home_agency.php'">
            Home
        </button>

        <button type="button" class="button" onclick="window.location.href='agency_requests.php'">
            See Other Requests
        </button>
    </div>

    <?php

}

?>
</body>
</html>

<script type="text/javascript">
    function check(){
        var number = "<?php echo $row['noOfScouts']; ?> ";
        var options = document.getElementById('framework').options, count = 0;
        for (var i=0; i < options.length; i++) {
            if (options[i].selected) count++;
        }

        if (number != count ) {
            alert("You must select "+number+" scouts");
            return false;
        }
    }

    $(document).ready(function(){
        $('#framework').multiselect({
            nonSelectedText: 'Select Scouts',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'400px'
        });
    });
</script>
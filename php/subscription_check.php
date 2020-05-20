<html lang="en">
<head> <title>Subscription Check</title>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
</head>
<body>
<div>
    <?php

    require "config.php";

    $clubID = $_POST['club'];

    $checkQuery= "select * from subscribes where journalist_id = ". $_SESSION['id']. " and club_id = ". $clubID;
    $result = mysqli_query($cn, $checkQuery);
    $no = mysqli_num_rows($result);
    //$no = mysqli_fetch_assoc($result);

    if( $no > 0 ) {
        ?> <h3 align='center'>You are already subscribed to this club</h3> <?php
    }
    else{
        //echo "session id: ".$_SESSION['id']. "\n";
        $query = "INSERT INTO subscribes VALUES (" . $_SESSION['id'] . ", ". $clubID.")";
        $success= mysqli_query($cn, $query );

        if($success === true){

            ?> <h3 align='center'>Subscription Successful</h3> <?php
        }
        else{

            ?> <h3 align='center'>Subscription Unsuccessful</h3> <?php
        }
    }

    ?>




    <div align="center">
        <button type="button" class="button" onclick="window.location.href='home_journalist.php'">
            Home
        </button>

        <button type="button" class="button" onclick="window.location.href='subscribe.php'">
            Back
        </button>
    </div>
</div>
</body>
</html>
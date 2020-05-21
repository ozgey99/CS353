<?php include "config.php"; 
    if(isset($_POST['fire'])) {
        $scout_id = $_POST['scout_id'];
        $query1 = "DELETE FROM scout_position_exp WHERE id = '$scout_id'";
        $query2 = "DELETE FROM scout_league_exp WHERE id='$scout_id'";
        $query3 = "DELETE FROM works WHERE scout_id = '$scout_id'";
        $query4 = "DELETE FROM user WHERE id='$scout_id'";
        mysqli_query($cn,$query1);
        mysqli_query($cn,$query2);
        mysqli_query($cn,$query3);
        mysqli_query($cn,$query4);
        header("Location: scouts.php");
    }

?> 
<?php
    include "config.php";
    $type = $_GET['type'];
    $id = $_GET['id'];

    echo $id." ".$type;

    if($type == "club" &&
        mysqli_num_rows( mysqli_query($cn, "select * from club where id=".$id)) > 0){ //club linki
        header('location:profile_club.php?type=club&id='.$id);
    }
    else if($type== "agency" &&
        mysqli_num_rows(mysqli_query($cn, "select * from agency where id=".$id)) > 0){ //agency linki
        header('location:profile_agency.php?type=agency&id='.$id);
    }
    else if($type == "scout" &&
        mysqli_num_rows(mysqli_query($cn, "select * from scout where id=".$id)) > 0){ //scout linki
        header('location:profile_scout.php?type=scout&id='.$id);
    }
    else if($type == "agent" &&
        mysqli_num_rows(mysqli_query($cn, "select * from agent where id=".$id)) > 0){ //agent linki
        header('location:profile_agent.php?type=agent&id='.$id);
    }
    else if($type == "journalist" &&
        mysqli_num_rows(mysqli_query($cn, "select * from journalist where id=".$id)) > 0){ //journalist linki
        header('location:profile_journalist.php?type=journalist&id='.$id);
    }
    else if($type == "footballer" &&
        mysqli_num_rows(mysqli_query($cn, "select * from footballer where id=".$id)) > 0){ //footballer linki
        header('location:profile_footballer.php?type=footballer&id='.$id);
    }
    else{
        echo "wrong url, page does not exist";
    }
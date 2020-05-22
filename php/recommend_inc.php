<?php
include 'config.php';

session_start();

if (isset($_POST['recommendation-submit']) && !empty($_SESSION['id'])) {
    $agent_id = $_SESSION['id'];
    $sql_select = "SELECT * FROM manages WHERE agent_id = '$agent_id';";
    $result = mysqli_query($cn, $sql_select);
    $resultCheck = mysqli_num_rows($result);

    if(!empty($_POST['footballer']) && !empty($_POST['team']) && !empty($_POST['comment']) && $resultCheck > 0 && $resultCheck2 > 0){
        $selected_footballer = $_POST['footballer'];
        $selected_club = $_POST['team'];
        $agent_id = $_SESSION['id'];
        $sql_select_club_id = "SELECT id FROM club WHERE name = '$selected_club';";
        $club_id_result = mysqli_query($cn, $sql_select_club_id);
        $club_id_fetch = mysqli_fetch_assoc($club_id_result);
        $club_id = $club_id_fetch['id'];

        $sql_select_footballer_id = "SELECT id FROM footballer WHERE name = '$selected_footballer';";
        $footballer_id_result = mysqli_query($cn, $sql_select_footballer_id);
        $footballer_id_fetch = mysqli_fetch_assoc($footballer_id_result);
        $footballer_id = $footballer_id_fetch['id'];

        $comment = $_POST['comment'];

        if (mysqli_num_rows($club_id_result) > 0) {

            $insert_recommends = "INSERT INTO recommends (agent_id, club_id, footballer_id, comment) 
									VALUES ('$agent_id','$club_id', '$footballer_id', '$comment');";
            mysqli_query($cn, $insert_recommends);
            header("Location: home_agent.php");
            exit();

        }

    }

    else{

        header("Location:  recommend.php?emptyForm");
        exit();

    }


}

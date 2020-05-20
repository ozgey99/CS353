<?php
include 'config.php';

session_start();

if (isset($_POST['offer-submit']) && !empty($_SESSION['id'])) {
    $offerer_id = $_SESSION['id'];
    $sql_select = "SELECT * FROM club WHERE id = '$offerer_id';";
    $result = mysqli_query($cn, $sql_select);
    $resultCheck = mysqli_num_rows($result);

    if(!empty($_POST['footballer']) && !empty($_POST['offer']) && is_numeric($_POST['offer']) && $resultCheck > 0){
        $selected_footballer = $_POST['footballer'];
        $offerer_id = $_SESSION['id'];
        $sql_select_offeree_id = "SELECT club_id FROM plays, footballer
                                  WHERE footballer.id = plays.footballer_id
                                  and footballer.name = '$selected_footballer';";
        $offeree_id_result = mysqli_query($cn, $sql_select_offeree_id);
        $offeree_id_fetch = mysqli_fetch_assoc($offeree_id_result);
        $offeree_id = $offeree_id_fetch['club_id'];

        $sql_select_footballer_id = "SELECT id FROM footballer WHERE name = '$selected_footballer';";
        $footballer_id_result = mysqli_query($cn, $sql_select_footballer_id);
        $footballer_id_fetch = mysqli_fetch_assoc($footballer_id_result);
        $footballer_id = $footballer_id_fetch['id'];

        $offer = $_POST['offer'];

        if (mysqli_num_rows($offeree_id_result) > 0) {

            $insert_offers = "INSERT INTO offers (offerer_id, offeree_id, footballer_id, transfer_offer) 
									VALUES ('$offerer_id','$offeree_id', '$footballer_id', '$offer');";
            mysqli_query($cn, $insert_offers);
            header("Location: home_club.php");
            exit();

        }

    }

    else{

        header("Location:  transfer_offer.php?emptyForm");
        exit();

    }


}

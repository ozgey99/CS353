<?php 
    include "config.php";
    if(isset($_POST['accept'])) {
        $new_team = $_POST['new_team'];
        $current_team = $_POST['old_team'];
        $footballer = $_POST['footballer'];
        $query = "UPDATE offers SET status='accepted' WHERE offerer_id = '$rejected_team' AND offeree_id = '$current_team' AND footballer_id = '$footballer' AND status='pending'";
        mysqli_query($cn,$query);
        header('Location: offers.php');
        exit();
    }
    else if(isset($_POST['reject'])) {
        $rejected_team = $_POST['new_team'];
        $current_team = $_POST['old_team'];
        $footballer = $_POST['footballer'];
        $query = "UPDATE offers SET status='rejected' WHERE offerer_id = '$rejected_team' AND offeree_id = '$current_team' AND footballer_id = '$footballer' AND status='pending'";
        mysqli_query($cn,$query);
        header('Location: offers.php');
        exit();
    }
    else
        echo "You should not be here!";
?>

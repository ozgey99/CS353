<?php 
    include "config.php";
    if(isset($_POST['accept'])) {
        $new_team = $_POST['new_team'];
        $current_team = $_POST['old_team'];
        $footballer = $_POST['footballer'];
        $query = "UPDATE offers SET status='agent' WHERE offerer_id = '$new_team' AND offeree_id = '$current_team' AND footballer_id = '$footballer' AND status='pending'";
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
    else if(isset($_POST['edit'])){
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $footballer_id = $_POST['footballer'];
        $old_offer = $_POST['fee'];
        $new_offer = mysqli_escape_string($cn,$_POST['offer']);
        $query1 = "UPDATE offers SET status='canceled' WHERE offerer_id = '$offerer_id' and offeree_id = '$offeree_id' and $footballer_id ='$footballer_id' and status = 'pending' and transfer_offer='$old_offer'";
        $query2 = "INSERT INTO offers(offerer_id,offeree_id,footballer_id,transfer_offer,status)
                    VALUES('$offerer_id','$offeree_id','$footballer_id','$new_offer','pending')";
        mysqli_query($cn,$query1);
        mysqli_query($cn,$query2);
        header("Location: your_offers.php");
    }
    else if(isset($_POST['offer'])) {
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $agent_id = $_POST['agent'];
        $footballer_id = $_POST['footballer'];
        $fee = $_POST['fee'];
        $salary = mysqli_escape_string($cn,$_POST['salary']);
        $query = "UPDATE offers SET salary = '$salary', status='agent-pending' where offerer_id = '$offerer_id' and offeree_id = '$offeree_id' and footballer_id='$footballer_id' and transfer_offer = '$fee' ";

        mysqli_query($cn,$query);
        mysqli_query($cn,$query2);
        header("Location: your_offers.php");
    }
    else if(isset($_POST['cancel'])) {
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $agent_id = $_POST['agent'];
        $footballer_id = $_POST['footballer'];
        $query = "UPDATE offers SET status='canceled' WHERE offeree_id = '$offeree_id' and offerer_id = '$offerer_id' and footballer_id ='$footballer_id' and (status = 'agent' or status='agent-pending' or 'agent-rejected')";
        mysqli_query($cn,$query);
        header("Location: agent_offerable.php");
    }
    else if(isset($_POST['accept-agent'])) {
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $agent_id = $_POST['agent'];
        $value = $_POST['value'];
        $footballer_id = $_POST['footballer'];
        $query = "SELECT * from club where id = '$offerer_id";
        $offerer = mysqli_fetch_assoc(mysqli_query($cn,$query));
        $offerer_value = $offerer['value'] + $value;
        $offerer_players = $offerer['num_of_players'] + 1;
        $query = "SELECT * from club where id = '$offeree_id";
        $offeree = mysqli_fetch_assoc(mysqli_query($cn,$query));
        $offeree_value = $offeree['value'] - $value;
        $offeree_players = $offeree['num_of_players'] -1;
        $fee = $_POST['fee'];
        $salary = $_POST['salary'];
        $query = "UPDATE offers SET status='finished' WHERE offeree_id = '$offeree_id' and offerer_id = '$offerer_id' and footballer_id ='$footballer_id' and transfer_offer= '$fee'";
        mysqli_query($cn,$query);
        $query = "UPDATE plays SET club_id='$offerer_id' WHERE footballer_id = '$footballer_id'";
        mysqli_query($cn,$query);
        $query = "UPDATE club SET num_of_players='$offerer_players', value='$offerer_value' WHERE id='$offerer_id'";
        mysqli_query($cn,$query);
        $query = "UPDATE club SET num_of_players='$offeree_players', value='$offeree_value' WHERE id='$offeree_id'";
        mysqli_query($cn,$query);
        header("Location: agent_offerable.php");
    }
    else if(isset($_POST['reject-agent'])) {
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $agent_id = $_POST['agent'];
        $footballer_id = $_POST['footballer'];
        $query = "UPDATE offers SET status='rejected' WHERE offeree_id = '$offeree_id' and offerer_id = '$offerer_id' and footballer_id ='$footballer_id' and (status = 'agent' or status='agent-pending' or 'agent-rejected')";
        mysqli_query($cn,$query);
        header("Location: agent_offerable.php");
    }
    else
        echo "You should not be here!";
?>

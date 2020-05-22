<?php 
    include "config.php";
    include "header.php";
    $errors = array();
    $id = $_SESSION['id'];
    $query = "SELECT id FROM club WHERE id = '$id'";
    $result = mysqli_query($cn,$query);
    $row = mysqli_fetch_array($result);
    $check = mysqli_num_rows($result);

    if($check != 1) {
        array_push($errors,"You are not a club!");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
</head>
<body>
<div class="header">
    <h2>Offerable Players</h2>
</div>

<form method="post" action="agent_offer.php">
    <?php include('errors.php'); ?>
    <table id="offers" class="table">
        <thead>
            <tr>
                <th>Team</th>
                <th>Name</th>
                <th>Position</th>
                <th>Age</th>
                <th>Offer</th>
            </tr>
        </thead>
        <?php
            $query = "SELECT * FROM offers WHERE offerer_id = '$id' and (status='agent')";
            $result = mysqli_query($cn,$query);
            $check = mysqli_num_rows($result);
            if( $check > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $offeree_id=$row['offeree_id'];
                    $offerer_id=$id;
                    $fee = $row['transfer_offer'];
                    $footballer_id = $row['footballer_id'];
                    $query = "SELECT * FROM footballer WHERE id = '$footballer_id'";
                    $row2 = mysqli_fetch_assoc(mysqli_query($cn,$query));
                    $name = $row2['name'];
                    $age = $row2['age'];
                    $value = $row2['value'];
                    $position = mysqli_fetch_assoc(mysqli_query($cn,"SELECT position FROM footballer_positions WHERE id = '$footballer_id'"))['position'];
                    $team = mysqli_fetch_assoc(mysqli_query($cn,"SELECT name FROM club WHERE id='$offeree_id'"))['name'];
                    $agent_id = mysqli_fetch_assoc(mysqli_query($cn, "SELECT agent_id from manages where footballer_id = '$footballer_id'"))['agent_id'];
                    echo 
                        "<tr>
                            <td>$team</td>
                            <td>$name</td>
                            <td>$position</td>
                            <td>$age</td>
                            <td>€$fee</td>
                            <input type='hidden' name='offeree' value='$offeree_id' />
                            <input type='hidden' name='agent' value='$agent_id' />
                            <td><button type='submit' name='offer-agent' value='$footballer_id' class='btn'>Show More</button></td>
                        </tr>";
                }
            }
            else {
                array_push($errors,"Team name error");
            }
        ?>
    </table>
</form>
<br>
<button type='button' class="btn btn-info" onclick="window.location.href='home_club.php'">
    Home
</button>
</body>
</html>
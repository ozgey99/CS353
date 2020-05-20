<?php 
    include "config.php";
    $errors = array();
    $id = $_SESSION['id'];

    $query = "SELECT id FROM club WHERE id = '$id'";
    $result = mysqli_query($cn,$query);
    $row = mysqli_fetch_array($result);
    $check = mysqli_num_rows($result);

    if($check != 1) {
        array_push($errors,"This user is not a club!");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Transfer Offers</h2>
</div>

<form method="post" action="offer_answer.php">
    <?php include('errors.php'); ?>
    <table id="offers" class="offers-class" style="width:100%">
        <thead>
            <tr>
                <th>Team</th>
                <th>Name</th>
                <th>Position</th>
                <th>Age</th>
                <th>Value</th>
            </tr>
        </thead>
        <?php 
            $query = "SELECT * FROM offers WHERE offeree_id = '$id' and status='pending'";
            $result = mysqli_query($cn,$query);
            $check = mysqli_num_rows($result);
            if( $check > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $offerer_id=$row['offerer_id'];
                    $footballer_id = $row['footballer_id'];
                    $query = "SELECT * FROM footballer WHERE id = '$footballer_id'";
                    $row2 = mysqli_fetch_assoc(mysqli_query($cn,$query));
                    $name = $row2['name'];
                    $age = $row2['age'];
                    $value = $row2['value'];
                    $position = mysqli_fetch_assoc(mysqli_query($cn,"SELECT position FROM footballer_positions WHERE id = '$footballer_id'"))['position'];
                    $team = mysqli_fetch_assoc(mysqli_query($cn,"SELECT name FROM club WHERE id='$offerer_id'"))['name'];
                    echo 
                        "<tr style='text-align:center'>
                            <td>$team</td>
                            <td>$name</td>
                            <td>$position</td>
                            <td>$age</td>
                            <td>€$value</td>
                            <td><button type='submit' name='$footballer_id' class='btn'>Show more</button></td>
                        </tr>";
                }
            }
            else {
                array_push($errors,"Team name error");
            }
        ?>
    </table>
</form>
</body>
</html>
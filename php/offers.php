<?php 
    include "config.php";
    $errors = array();
    $id = $_SESSION['id'];

    $query = "SELECT id FROM club WHERE id = '$id'";
    $result = mysqli_query($cn,$query);
    $check = mysqli_num_rows($result);
    
    $query2 = "SELECT id FROM agent WHERE id='$id'";
    $result2 = mysqli_query($cn,$query2);
    $check2= mysqli_num_rows($result2);
    if($check != 1) {
        if($check2 != 1) {
            array_push($errors,"This user is not a club or an agent!");
        }
    }

    if($check == 1 && $check2== 0) {
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
                                    <input type='hidden' name='offerer' value='$offerer_id' />
                                    <td><button type='submit' name='show-more' value='$footballer_id' class='btn'>Show more</button></td>
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
<?php }
    if($check2 == 1 && $check== 0) {
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
                        <th>Offered Salary</th>
                    </tr>
                </thead>
                <?php 
                    $query = "SELECT footballer_id FROM manages WHERE agent_id = '$id'";
                    $result = mysqli_query($cn,$query);
                    $check = mysqli_num_rows($result);
                    if( $check > 0) {
                        while($rows =mysqli_fetch_assoc($result)) {
                            $footballer_id = $rows['footballer_id'];
                            $query2 = "SELECT * FROM offers WHERE footballer_id = '$footballer_id' and status='agent-pending'";
                            $result2 = mysqli_query($cn,$query2);
                            while($row = mysqli_fetch_assoc($result2)) {
                                $offerer_id=$row['offerer_id'];
                                $offeree_id = $row['offeree_id'];
                                $footballer_id = $row['footballer_id'];
                                $fee = $row['transfer_offer'];
                                $query = "SELECT * FROM footballer WHERE id = '$footballer_id'";
                                $row2 = mysqli_fetch_assoc(mysqli_query($cn,$query));
                                $name = $row2['name'];
                                $age = $row2['age'];
                                $salary = $row['salary'];
                                $position = mysqli_fetch_assoc(mysqli_query($cn,"SELECT position FROM footballer_positions WHERE id = '$footballer_id'"))['position'];
                                $team = mysqli_fetch_assoc(mysqli_query($cn,"SELECT name FROM club WHERE id='$offerer_id'"))['name'];
                                echo 
                                    "<tr style='text-align:center'>
                                        <td>$team</td>
                                        <td>$name</td>
                                        <td>$position</td>
                                        <td>$age</td>
                                        <td>€$salary</td>
                                        <input type='hidden' name='salary' value='$salary' />
                                        <input type='hidden' name='fee' value='$fee' />
                                        <input type='hidden' name='offerer' value='$offerer_id' />
                                        <input type='hidden' name='offeree' value='$offeree_id' />
                                        <td><button type='submit' name='show-more2' value='$footballer_id' class='btn'>Show more</button></td>
                                    </tr>";
                            }
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
<?php } ?>

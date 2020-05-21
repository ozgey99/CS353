<?php 
    include "config.php";
    $errors = array();
    $id = $_SESSION['id'];

    $query = "SELECT id FROM agency WHERE id = '$id'";
    $result = mysqli_query($cn,$query);
    $check = mysqli_num_rows($result);
    if($check != 1) {
        array_push($errors,"This user is not an agency!");
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
    <h2>Scouts of Agency</h2>
</div>

<form method="post" action="firing.php">
    <?php include('errors.php'); ?>
    <table id="offers" class="offers-class" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Exp. Positions</th>
                <th>Exp. Leagues</th>
                <th>No of reports</th>
                <th>Availability</th>
            </tr>
        </thead>
        <?php 
            $query = "SELECT * FROM works where agency_id='$id'";
            $result = mysqli_query($cn,$query);
            $check = mysqli_num_rows($result);
            if( $check > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $scout_id=$row['scout_id'];
                    $query = "SELECT * FROM scout WHERE id= '$scout_id'";
                    $result5 = mysqli_query($cn,$query);
                    if(mysqli_num_rows($result5) != 1 ) {
                        array_push($errors,"Scout is not found!");
                    }
                    else {
                        $rows = mysqli_fetch_assoc($result5);
                        $availability = $rows['availability'];
                        $name = $rows['name'];
                        $query2 = "SELECT position FROM scout_position_exp WHERE id = '$scout_id'";
                        $query3 = "SELECT league FROM scout_league_exp WHERE id = '$scout_id'";
                        $query4 = "SELECT * from reports WHERE scout_id='$scout_id' ";
                        $result2 = mysqli_query($cn,$query2);
                        $result3 = mysqli_query($cn,$query3);
                        $result4 = mysqli_query($cn,$query4);
                        $row2 = mysqli_fetch_array($result2);
                        $row3 = mysqli_fetch_array($result3);
                        $positions= "";
                        $leagues = "";
                        $no_of_reports = mysqli_num_rows($result4);
                        foreach( $row2 as $pos) {
                            $positions .= "$pos ";
                        }
                        foreach( $row3 as $league) {
                            $leagues .= "$league ";
                        }
                        
                        if($availability == 0) {
                        echo 
                            "<tr style='text-align:center'>
                                <td>$name</td>
                                <td>$positions</td>
                                <td>$leagues</td>
                                <td>$no_of_reports</td>
                                <td>Available</td>
                                <input type='hidden' name='scout_id' value='$scout_id' />
                                <td><button type='submit' name='fire' class='btn' onclick=\"return confirm('Are you sure?')\">Fire!</button></td>
                            </tr>";
                        }
                        else {
                            echo 
                            "<tr style='text-align:center'>
                                <td>$name</td>
                                <td>$positions</td>
                                <td>$leagues</td>
                                <td>$no_of_reports</td>
                                <td>Busy</td>
                            </tr>";
                        }
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

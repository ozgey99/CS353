<?php 
    include "config.php";
    $errors = array();
    $id = $_SESSION['id'];

    $query = "SELECT id FROM agent WHERE id = '$id'";
    $result = mysqli_query($cn,$query);
    $check = mysqli_num_rows($result);
    if($check != 1) {
        array_push($errors,"This user is not an agent!");
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
    <h2>Footballers of Agent</h2>
</div>

<form method="post" action="firing.php">
    <?php include('errors.php'); ?>
    <table id="offers" class="offers-class" style="width:100%">
        <thead>
            <tr>
                <th>Team</th>
                <th>Name</th>
                <th>Position</th>
                <th>Age</th>
                <th>Nationality</th>
                <th>Value</th>
            </tr>
        </thead>
        <?php 
            $query = "SELECT footballer_id FROM manages where agent_id='$id'";
            $result = mysqli_query($cn,$query);
            $check = mysqli_num_rows($result);
            if( $check > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $footballer_id=$row['footballer_id'];
                    $query = "SELECT * FROM footballer WHERE id= '$footballer_id'";
                    $result5 = mysqli_query($cn,$query);
                    if(mysqli_num_rows($result5) != 1 ) {
                        array_push($errors,"Footballer is not found!");
                    }
                    else {
                        $rows = mysqli_fetch_assoc($result5);
                        $name = $rows['name'];
                        $age = $rows['age'];
                        $value = $rows['value'];
                        $nationality = $rows['nationality'];
                        $query2 = "SELECT position FROM footballer_positions WHERE id = '$footballer_id'";
                        $position = mysqli_fetch_assoc(mysqli_query($cn,$query2))['position'];
                        $query3 = "SELECT club_id FROM plays WHERE footballer_id = '$footballer_id'";
                        $club_id = mysqli_fetch_assoc(mysqli_query($cn,$query3))['club_id'];
                        $club_name = mysqli_fetch_assoc(mysqli_query($cn,"SELECT name FROM club WHERE id=$club_id"))['name'];
                        
                        echo 
                            "<tr style='text-align:center'>
                                <th>$club_name</th>
                                <th>$name</th>
                                <th>$position</th>
                                <th>$age</th>
                                <th>$nationality</th>
                                <th>$value</th>
                                <input type='hidden' name='footballer_id' value='$footballer_id' />
                                <td><button type='submit' name='release' class='btn' onclick=\"return confirm('Are you sure?')\">Release</button></td>
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
<a href="home_agent.php" class="home">Home</a>
</body>
</html>

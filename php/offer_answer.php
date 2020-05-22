<?php 
    include "config.php";
    include "header.php";
    if(isset($_POST['show-more'])){ 
    $footballer_id = $_POST['show-more'];
    $offerer_id = $_POST['offerer'];
    $id = $_SESSION['id'];
    $errors=array();
    $query1 = "SELECT * FROM footballer WHERE id = '$footballer_id'";
    $query2 = "SELECT * FROM offers WHERE offerer_id = '$offerer_id' and offeree_id= '$id' AND footballer_id = '$footballer_id' AND status = 'pending'";
    $query3 = "SELECT position FROM footballer_positions WHERE id = '$footballer_id'";
    $result1 = mysqli_query($cn,$query1);
    $result2 = mysqli_query($cn,$query2);
    $result3 = mysqli_query($cn,$query3);
    if(mysqli_num_rows($result1) !=1 || mysqli_num_rows($result2) !=1 || mysqli_num_rows($result3) !=1) {
        array_push($errors,"offer-transfer error");
        }
    else {
            $row1 = mysqli_fetch_assoc($result1); 
            $row2 = mysqli_fetch_assoc($result2);
            $row3 = mysqli_fetch_assoc($result3);
            $id = $_SESSION['id'];
            $footballer_id = $row1['id'];
            $footballer_name = $row1['name'];
            $footballer_age = $row1['age'];
            $footballer_position = $row3['position'];
            $footballer_value= $row1['value'];
            $footballer_nation= $row1['nationality'];
            $offerer_id = $row2['offerer_id'];
            $offerer_team = mysqli_fetch_assoc(mysqli_query($cn,"select name from club where id='$offerer_id'"))['name'];
            $fooballer_value= $row1['value'];
            $fee = $row2['transfer_offer'];
        
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Scout Online</title>
            </head>
            <body>
            <div class="header">
                <h2>Answer the Offer</h2>
            </div>
            <form method="post" action="transferring.php">
                <?php include('errors.php'); ?>
                <p>Offerer Team: <?php echo "$offerer_team";?></p>
                <p>Footballer: <?php echo "$footballer_name";?></p>
                <p>Value: <?php echo "$footballer_value";?></p>
                <p>Position: <?php echo "$footballer_position";?></p>
                <p>Age: <?php echo "$footballer_age";?></p>
                <p>Nation: <?php echo "$footballer_nation";?></p>
                <p>Offered Transfer Fee:<?php echo "$fee";?></p>
                <input type="hidden" name="footballer" value="<?php echo $footballer_id; ?>" />
                <input type="hidden" name="old_team" value="<?php echo $id; ?>" />
                <input type="hidden" name="new_team" value="<?php echo $offerer_id; ?>" />
                <td><button type='submit' name='accept' class='btn btn-primary'>Accept</button></td>
                <td><button type='submit' name='reject' class='btn btn-danger'>Reject</button></td>
            </form>
            </body>
            </html>
            <?php 
        } 
    }


    if(isset($_POST['show-more2'])){ 
        $footballer_id = $_POST['show-more2'];
        $offerer_id = $_POST['offerer'];
        $offeree_id = $_POST['offeree'];
        $fee = $_POST['fee'];
        $id = $_SESSION['id'];
        $salary = $_POST['salary'];
        $errors=array();
        $query1 = "SELECT * FROM footballer WHERE id = '$footballer_id'";
        $query2 = "SELECT * FROM offers WHERE offerer_id = '$offerer_id' and offeree_id= '$offeree_id' AND footballer_id = '$footballer_id' AND transfer_offer='$fee'";
        $query3 = "SELECT position FROM footballer_positions WHERE id = '$footballer_id'";
        $result1 = mysqli_query($cn,$query1);
        $result2 = mysqli_query($cn,$query2);
        $result3 = mysqli_query($cn,$query3);
        if(mysqli_num_rows($result1) !=1 || mysqli_num_rows($result2) !=1 || mysqli_num_rows($result3) !=1) {
            echo "offer_answer show-more2'de problem var";
        }
        else {
                $row1 = mysqli_fetch_assoc($result1); 
                $row2 = mysqli_fetch_assoc($result2);
                $row3 = mysqli_fetch_assoc($result3);
                $id = $_SESSION['id'];
                $footballer_id = $row1['id'];
                $footballer_name = $row1['name'];
                $footballer_age = $row1['age'];
                $footballer_position = $row3['position'];
                $footballer_value= $row1['value'];
                $footballer_nation= $row1['nationality'];
                $offeree_id = $row2['offeree_id'];
                $offerer_team = mysqli_fetch_assoc(mysqli_query($cn,"select name from club where id='$offerer_id'"))['name'];
                $fooballer_value= $row1['value'];
                $fee = $row2['transfer_offer'];

            
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Scout Online</title>
                </head>
                <body>
                <div class="header">
                    <h2>Answer the Offer</h2>
                </div>
                <form method="post" action="transferring.php">
                    <?php include('errors.php'); ?>
                    <p>Offerer Team: <?php echo "$offerer_team";?></p>
                    <p>Footballer: <?php echo "$footballer_name";?></p>
                    <p>Value: <?php echo "$footballer_value";?></p>
                    <p>Position: <?php echo "$footballer_position";?></p>
                    <p>Age: <?php echo "$footballer_age";?></p>
                    <p>Nation: <?php echo "$footballer_nation";?></p>
                    <p>Offered Transfer Fee:<?php echo "$fee";?></p>
                    <p>Offered Salary:<?php echo "$salary";?></p>
                    <input type="hidden" name="value" value="<?php echo $fooballer_value; ?>" />
                    <input type="hidden" name="footballer" value="<?php echo $footballer_id; ?>" />
                    <input type="hidden" name="fee" value="<?php echo $fee; ?>" />
                    <input type="hidden" name="salary" value="<?php echo $salary; ?>" />
                    <input type="hidden" name="offeree" value="<?php echo $offeree_id; ?>" />
                    <input type="hidden" name="offerer" value="<?php echo $offerer_id; ?>" />
                    <td><button type='submit' name='accept-agent' class='btn btn-primary'>Accept</button></td>
                    <td><button type='submit' name='reject-agent' class='btn btn-danger'>Reject</button></td>
                </form>
                </body>
                </html>
                <?php 
            } 
        }

    if(isset($_POST['edit'])){
        $footballer_id = $_POST['edit'];
        $offeree_id = $_POST['offeree'];
        $offerer_id = $_SESSION['id'];
        $errors=array();
        $query1 = "SELECT * FROM footballer WHERE id = '$footballer_id'";
        $query2 = "SELECT * FROM offers WHERE offerer_id ='$offerer_id' and offeree_id= '$offeree_id' AND footballer_id = '$footballer_id' AND status = 'pending'";
        $query3 = "SELECT position FROM footballer_positions WHERE id = '$footballer_id'";
        $result1 = mysqli_query($cn,$query1);
        $result2 = mysqli_query($cn,$query2);
        $result3 = mysqli_query($cn,$query3);
        if(mysqli_num_rows($result1) !=1 || mysqli_num_rows($result2) !=1 || mysqli_num_rows($result3) !=1) {
            array_push($errors,"offer-transfer error");
        }
        else {
            $row1 = mysqli_fetch_assoc($result1); 
            $row2 = mysqli_fetch_assoc($result2);
            $row3 = mysqli_fetch_assoc($result3);
            $footballer_name = $row1['name'];
            $footballer_age = $row1['age'];
            $footballer_position = $row3['position'];
            $footballer_value= $row1['value'];
            $footballer_nation= $row1['nationality'];
            $offerer_id = $row2['offerer_id'];
            $offerer_team = mysqli_fetch_assoc(mysqli_query($cn,"select name from club where id='$offerer_id'"))['name'];
            $fooballer_value= $row1['value'];
            $fee = $row2['transfer_offer'];
        
         ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Scout Online</title>
        </head>
        <body>
        <div class="header">
            <h2>Edit the Offer</h2>
        </div>
        <form method="post" action="transferring.php">
            <?php include('errors.php'); ?>
            <p>Offerer Team: <?php echo "$offerer_team";?></p>
            <p>Footballer: <?php echo "$footballer_name";?></p>
            <p>Value: <?php echo "$footballer_value";?></p>
            <p>Position: <?php echo "$footballer_position";?></p>
            <p>Age: <?php echo "$footballer_age";?></p>
            <p>Nation: <?php echo "$footballer_nation";?></p>
            <p>Offered Transfer Fee:<?php echo "$fee";?></p>
            <input type="text" name="offer" value="" placeholder="0 €">
            <input type="hidden" name="fee" value="<?php echo $fee; ?>" />
            <input type="hidden" name="footballer" value="<?php echo $footballer_id; ?>" />
            <input type="hidden" name="offeree" value="<?php echo $offeree_id; ?>" />
            <input type="hidden" name="offerer" value="<?php echo $offerer_id; ?>" />
            <td><button type='submit' name='edit' class='btn btn-info'>Edit</button></td>
        </form>
        </body>
        </html> 
        <?php }
    }

    if(isset($_POST['cancel'])){
        $footballer_id = $_POST['cancel'];
        $offeree_id = $_POST['offeree'];
        $fee = $_POST['fee'];
        $id = $_SESSION['id'];
        $query = "UPDATE offers SET status='canceled' WHERE offerer_id ='$id' and offeree_id = '$offeree_id' and footballer_id = '$footballer_id' and transfer_offer = '$fee' and status = 'pending'";
        mysqli_query($cn,$query);
        header("Location: your_offers.php");
    }
?>


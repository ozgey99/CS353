<?php
require 'header.php';
include 'config.php';
?>
<?php
$id = $_SESSION['id'];
$query = "SELECT id FROM club WHERE id='$id'";
$result = mysqli_query($cn,$query);
$check = mysqli_num_rows($result);
if($check == 0) {
    echo "You are not a club!";
}
else {
$select_footballer = "SELECT footballer.name FROM footballer, plays
                        where footballer.id = plays.footballer_id
                        and plays.club_id != $id order by footballer.name;";
$result = mysqli_query($cn, $select_footballer);
$footballers = array();
$resultCheck = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
    $footballers[] = $row['name'];
}
?>
<div class="container">

    <div class="offer">

        <form action = "transfer_offer_inc.php" method = "post">
            <label for="footballer">Select footballer:</label>
            <select name="footballer">
                <?php
                foreach ($footballers as $footballer) {
                    ?>
                    <option><?php echo $footballer;?></option>
                <?php } ?>
            </select>

            <br> <br>

            <label for="offer-lbl">Enter your offer: </label>
            <input type="text" name="offer" value="" placeholder="0 €">

            <br>
            <br>

            <button type="submit" class="btn btn-primary" name="offer-submit">Submit</button>
        </form>

        <br> <br>
        <form action="home_club.php">

            <button type="submit" class="btn btn-info" name="home-scout">Home</button>

        </form>
    </div>
</div>
                <?php } ?>

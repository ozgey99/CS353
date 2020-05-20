<?php
require 'header.php';
include 'config.php';
?>
<?php
$select_footballer = "SELECT * FROM footballer order by name;";
$result = mysqli_query($cn, $select_footballer);
$footballers = array();
$resultCheck = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
    $footballers[] = $row['name'];
}
?>
<div class="container">

    <div class="offer">

        <?php
        if (!empty($_SESSION['id'])) {
            echo "<p class=error>Session Active</p>";
        }
        ?>
        <form action = "transfer_offer_inc.php" method = "post">
            <label for="footballer">Select Footballer:</label>
            <select name="footballer">
                <?php
                foreach ($footballers as $footballer) {
                    ?>
                    <option><?php echo $footballer;?></option>
                <?php } ?>
            </select>

            <br>

            <input type="text" name="offer" value="" placeholder="0 €">

            <br>

            <button type="submit" name="offer-submit">Submit</button>
        </form>
    </div>
</div>

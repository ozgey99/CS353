<?php
require 'header.php';
include 'config.php';
?>
<?php
$aid = $_SESSION['id'];
$select_footballer = "SELECT footballer.name FROM footballer, manages
                        where footballer.id = manages.footballer_id
                        and manages.agent_id = '$aid' order by footballer.name;";
$result = mysqli_query($cn, $select_footballer);
$footballers = array();
$resultCheck = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
    $footballers[] = $row['name'];
}

$select_team = "SELECT distinct club.name FROM footballer, plays, club
                        where plays.club_id = club.id and plays.footballer_id = footballer.id
                        and club.id not in (select plays.club_id from footballer, manages, plays
                                            where manages.footballer_id = footballer.id and plays.footballer_id = footballer.id
                                            and manages.agent_id = '$aid')
                        order by club.name;";
$result2 = mysqli_query($cn, $select_team);
$teams = array();
$resultCheck2 = mysqli_num_rows($result2);

while ($row = mysqli_fetch_assoc($result2)) {
    $teams[] = $row['name'];
}
?>
<div class="container">

    <div class="recommendation">

        <?php
        if (!empty($_SESSION['id'])) {
            echo "<p class=error>Session Active</p>";
        }
        ?>
        <form action = "recommend_inc.php" method = "post">
            <label for="footballer">Select footballer from your managing list: </label>
            <select name="footballer">
                <?php
                foreach ($footballers as $footballer) {
                    ?>
                    <option><?php echo $footballer;?></option>
                <?php } ?>
            </select>

            <br>

            <label for="team">Select the club you want to recommend your player to: </label>
            <select name="team">
                <?php
                foreach ($teams as $team) {
                    ?>
                    <option><?php echo $team;?></option>
                <?php } ?>
            </select>

            <br>

            <textarea name="comment" rows="8" cols="80" placeholder="Enter your comment here..."></textarea>

            <br>

            <button type="submit" name="recommendation-submit">Submit</button>
        </form>
    </div>
</div>

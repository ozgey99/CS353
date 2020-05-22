<?php 
    require 'header.php';
    include 'config.php';
    $conn = $cn;
?>
<?php
    $select_organization = "SELECT * FROM organizations order by organization_name;";
    $result = mysqli_query($conn, $select_organization);
    $organizations = array();
    $resultCheck = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
		$organizations[] = $row['organization_name'];
	}
?>
<div class="container">

    <div class="request">

       <form action = "scout_request_inc.php" method = "post">
			<label for="agency">Select an agency:</label>
			<select name="agency">
			  <?php
			  	foreach ($_SESSION['agency_list'] as $agency) {
			  ?>	
			  <option><?php echo $agency;?></option>
			  <?php } ?>
			</select>

			<br>

			<label for="noOfScout">Number Of Scouts:</label>
			<select name="noOfScout">
				<?php
				    for ($i=1; $i<=10; $i++)
				    {
				        ?>
				            <option value="<?php echo $i;?>"><?php echo $i;?></option>
				        <?php
				    }
				?>
			</select>

			<br>

			<label for="organization">Select Organization:</label>
			<select name="organization">
				<?php
				  	foreach ($organizations as $organization) {
				?>	
				<option><?php echo $organization;?></option>
				<?php } ?>
			</select>

			<br>

			<label for="due-date">Due Date</label>
			<input type="date" name="end-date" value="<?php echo date("Y-m-d");?>">

			<br>
			<label>Choose position(s):</label>
			<br>
			<input type="checkbox" name="pos[]" value="gk">Goalkeeper(GK)<br>

			<input type="checkbox" name="pos[]" value="rb">Right Back(RB)<br>

			<input type="checkbox" name="pos[]" value="cb">Center Back(CB)<br>

			<input type="checkbox" name="pos[]" value="lb">Left Back(LB)<br>
			
			<input type="checkbox" name="pos[]" value="dm">Defensive Midfielder(DM)<br>
			
			<input type="checkbox" name="pos[]" value="cm">Center Midfielder(CM)<br>

			<input type="checkbox" name="pos[]" value="lm">Left Midfielder(LM)<br>

			<input type="checkbox" name="pos[]" value="rm">Right Midfielder(RM)<br>

			<input type="checkbox"  name="pos[]" value="cam">Center Attack Midfielder(CAM)<br>

			<input type="checkbox" name="pos[]" value="lf">Left Forward(LF)<br>

			<input type="checkbox" name="pos[]" value="rf">Right Forward(RF)<br>

			<input type="checkbox" name="pos[]" value="cf">Center Forward(CF)<br>

			<input type="checkbox" name="pos[]" value="st">Striker(ST)<br>
			
            <br>
			<button type="submit" class="btn btn-primary" name="request-submit">Submit</button>
		</form>

        <br> <br>
        <form action="home_club.php">

            <button type="submit" class="btn btn-info" name="home-scout">Home</button>

        </form>

    </div>
</div>

<?php 
	include 'config.php';
	require 'header.php';
      $conn = $cn;
?>
<div class="container">

    <div class="request">

       <?php 
       		if (!empty($_SESSION['id'])) {
       			echo "Session Active";
       		}
       ?>
       <?php
       		$footballer_id_row = array();
       		$footballer_id_list = array();
       		$footballer_name_list = array();
       		$scout_id = $_SESSION['id'];

       		$select_footballer_id = "SELECT footballer_id FROM watches WHERE scout_id = '$scout_id';";
       		$footballer_id_result = mysqli_query($conn, $select_footballer_id);

       		if(mysqli_num_rows($footballer_id_result) > 0){
       			while($footballer_id_fetch = mysqli_fetch_assoc($footballer_id_result)){

       				$footballer_id_row[] = $footballer_id_fetch;
       			}
       		}
       		
       		foreach ($footballer_id_row as $footballer_id_raw) {
       			array_push($footballer_id_list, $footballer_id_raw['footballer_id']);
       		}

       		for($i = 0; $i < mysqli_num_rows($footballer_id_result); $i++){

       			$select_footballer_name = "SELECT name FROM footballer WHERE id = '$footballer_id_list[$i]';";
				$footballer_name_result = mysqli_query($conn, $select_footballer_name);
				$footballer_name_fetch = mysqli_fetch_assoc($footballer_name_result);
				array_push($footballer_name_list, $footballer_name_fetch['name']);

       		}
       		sort($footballer_name_list);	

       ?>
       <form action = "report_inc.php" method = "post">

			<input type="range" min="1" max="10" step="0.1" id="rating" name="rating" onchange='document.getElementById("bar").value = "Rating = " + document.getElementById("rating").value;'/>
			<input type="text" name="bar" id="bar" value="Rating = 5" disabled />
			<br />
			<label for="watchlist">Select a football player from watchlist:</label>
			<select name="watchlist">
			  <?php
			  	foreach ($footballer_name_list as $name) {
			  ?>	
			  <option><?php echo $name;?></option>
			  <?php } ?>
			</select>
			<br>
			<label>Comments about football player:</label>
			<br>
			<textarea name="comment" rows="8" cols="80" placeholder="Enter your comment here..."></textarea>
			<button type="submit" class="btn btn-primary" name="report-submit">Submit</button>

		</form>
        <br>
        <button type='button' class="btn btn-info" onclick="window.location.href='home_scout.php'">
            Home
        </button>
    </div>
</div>

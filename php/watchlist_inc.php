<?php
 	include 'config.php';

 	if (isset($_POST['watchlist-submit']) && !empty($_SESSION['id'])) {

 		$scout_id = $_SESSION['id'];
 		$selected_footballer = $_POST['watchlist'];

 		$select_footballer_id = "SELECT id FROM footballer WHERE name = '$selected_footballer';";
 		$select_footballer_id_result = mysqli_query($cn, $select_footballer_id);
 		$select_footballer_id_fetch = mysqli_fetch_assoc($select_footballer_id_result);
 		$footballer_id = $select_footballer_id_fetch['id'];

 		$insert_watchlist = "INSERT INTO watches (scout_id, footballer_id) VALUES ('$scout_id', '$footballer_id');";
 		mysqli_query($cn, $insert_watchlist);

 		header("Location: watchlist.php");
 		exit();
 	}

 	else if (isset($_POST['watchlist-done']) && !empty($_SESSION['id'])) {
 		header("Location: home_scout.php");
 		exit();
 	}

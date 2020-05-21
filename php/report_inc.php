<?php

	include 'config.php';
	$conn = $cn;

	session_start();

	$scout_id = $_SESSION['id'];
	$select_scout = "SELECT * FROM scout WHERE id = '$scout_id';";
	$select_scout_result = mysqli_query($conn, $select_scout);
	$result_check = mysqli_num_rows($select_scout_result);

	if(isset($_POST['report-submit']) && !empty($_SESSION['id']) && $result_check > 0){

		if(!empty($_POST['rating']) && !empty($_POST['watchlist']) && !empty($_POST['comment'])){

			$rating = $_POST['rating'];
			$selected_footballer = $_POST['watchlist'];
			$comment = $_POST['comment'];
			$report_date = date('Y-m-d');

			$select_footballer_id = "SELECT id FROM footballer WHERE name = '$selected_footballer';";
			$footballer_id_result = mysqli_query($conn, $select_footballer_id);
			$footballer_id_fetch = mysqli_fetch_assoc($footballer_id_result);
			$footballer_id = $footballer_id_fetch['id'];

			$insert_report = "INSERT INTO report (date, rating, comment) VALUES ('$report_date','$rating','$comment');";
			mysqli_query($conn, $insert_report);

			$select_report_id = "SELECT MAX(id) AS id FROM report";
			$select_report_id_result = mysqli_query($conn, $select_report_id);
			$select_report_id_fetch = mysqli_fetch_assoc($select_report_id_result);
			$report_id = $select_report_id_fetch['id']; 
			$result_check_id = mysqli_num_rows($select_report_id_result);

			$select_request_id = "SELECT MAX(request_id) AS id FROM assigns WHERE scout_id = '$scout_id';";
			$select_request_id_result = mysqli_query($conn, $select_request_id);
			$select_request_id_fetch = mysqli_fetch_assoc($select_request_id_result);
			$request_id = $select_request_id_fetch['id'];

			$select_club_id = "SELECT club_id FROM requests WHERE request_id = '$request_id';";
			$select_club_id_result = mysqli_query($conn, $select_club_id);
			$select_club_id_fetch = mysqli_fetch_assoc($select_club_id_result);
			$club_id = $select_club_id_fetch['club_id'];

			if ($result_check_id > 0) {

				$insert_reports = "INSERT INTO reports (report_id, club_id, scout_id) VALUES ('$report_id','$club_id','$scout_id');";
				mysqli_query($conn, $insert_reports);


				$insert_footballer_report = "INSERT INTO footballer_report (footballer_id, report_id) 
											VALUES ('$footballer_id','$report_id');";
				mysqli_query($conn, $insert_footballer_report);

			}
			
			header("Location: home_scout.php");
			exit();

		}

	}
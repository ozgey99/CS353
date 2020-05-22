
<?php

	include 'config.php';
	$conn = $cn;
	session_start();

	if (isset($_POST['request-submit']) && !empty($_SESSION['id'])) {
		$club_id = $_SESSION['id'];
		$sql_select = "SELECT * FROM club WHERE id = '$club_id';";
		$result = mysqli_query($conn, $sql_select);
		$resultCheck = mysqli_num_rows($result);
		$positions = $_POST['pos'];

		if(!empty($_POST['agency']) && !empty($_POST['noOfScout']) && !empty($_POST['organization']) && sizeof($positions) > 0 && $resultCheck > 0){
    		
    			$selected_agency = $_POST['agency'];
			$club_id = $_SESSION['id'];
			$start_date = date('Y-m-d');
			$end_date = $_POST['end-date'];
    			$selected_no_of_scouts = $_POST['noOfScout'];
    			$selected_organization = $_POST['organization'];
			$sql_select_agency_id = "SELECT id FROM agency WHERE name = '$selected_agency';";
			$agency_id_result = mysqli_query($conn, $sql_select_agency_id);
			$agency_id_fetch = mysqli_fetch_assoc($agency_id_result);
			$agency_id = $agency_id_fetch['id'];
			
			if (mysqli_num_rows($agency_id_result) > 0) {
				
				$insert_request = "INSERT INTO request (no_of_req_scouts, organization, start_date, end_date) 
									VALUES ('$selected_no_of_scouts','$selected_organization', '$start_date', '$end_date');";
				mysqli_query($conn, $insert_request);

				$select_request = "SELECT MAX(id) AS id FROM request;";
				$request_id_result = mysqli_query($conn, $select_request);
				$request_id_fetch = mysqli_fetch_assoc($request_id_result);
				$request_id = $request_id_fetch['id'];
				$insert_requests = "INSERT INTO requests (request_id, club_id, agency_id) 
							VALUES ('$request_id', '$club_id', '$agency_id');";
				mysqli_query($conn, $insert_requests);


				foreach($positions as $position) {

					$insert_positions ="INSERT INTO request_positions (id, position) VALUES ('$request_id','$position');";
                   	 		mysqli_query($conn, $insert_positions);

                		}

                		$select_subscribed_journalist = "SELECT journalist_id FROM subscribes WHERE club_id = '$club_id';";
				$select_subscribed_journalist_result = mysqli_query($conn, $select_subscribed_journalist);


				$journalist_id_row = array();
				$journalist_id_list = array();
				if(mysqli_num_rows($select_subscribed_journalist_result) > 0){
					
					while($subscribed_journalist_fetch = mysqli_fetch_assoc($select_subscribed_journalist_result)){

						$journalist_id_row[] = $subscribed_journalist_fetch;
					}
	       			}

				foreach ($journalist_id_row as $journalist_id_raw) {
					array_push($journalist_id_list, $journalist_id_raw['journalist_id']);
				}

				$positions_string = implode(", ", $positions);

				$insert_notification = "INSERT INTO notification (date, positions) VALUES ('$start_date','$positions_string');";
				mysqli_query($conn, $insert_notification);

				$select_notification_id = "SELECT MAX(id) AS id FROM notification;";
				$notification_id_result = mysqli_query($conn, $select_notification_id);
				$notification_id_fetch = mysqli_fetch_assoc($notification_id_result);
				$notification_id = $notification_id_fetch['id'];

				for($i = 0; $i < sizeof($journalist_id_list); $i++){

					$insert_notifies = "INSERT INTO notifies (notification_id, journalist_id, request_id) VALUES ('$notification_id','$journalist_id_list[$i]','$request_id');"; 
					mysqli_query($conn, $insert_notifies);

				}

	       		
			}

       		header("Location: home_club.php");
		exit();		
    			
		}

		else{
			
			header("Location:  scout_request.php?emptyForm");
			exit();

		}

	}


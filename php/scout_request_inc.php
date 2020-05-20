
<?php

	include 'config.php';
	$conn = $cn;
	session_start();

	if (isset($_POST['request-submit']) && !empty($_SESSION['id'])) {
		echo "hello";
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
				header("Location: home_club.php");
				exit();

			}			
    			
		}

		else{

			header("Location:  scout_request.php?emptyForm");
			exit();

		
		}

	}


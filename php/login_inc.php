<?php 

include 'config.php';
$conn = $cn;
if(isset($_POST['login-submit'])){
	
	$uid = mysqli_real_escape_string($conn, $_POST['mailuid']);
	$password = mysqli_real_escape_string($conn, $_POST['pwd']);

	if (empty($uid) || empty($password)){

			header("Location: login.php?error=emptyform");
			exit();
			
	}

	else {

		$sql_select = "SELECT * FROM user WHERE username = '$uid';";
		$result = mysqli_query($conn, $sql_select);
		$row = mysqli_fetch_assoc($result);
		$resultCheck = mysqli_num_rows($result);
		
		$userId = $row['id']; 

		$sql_select1 = "SELECT id FROM agency WHERE id = '$userId';";
		$result1 = mysqli_query($conn, $sql_select1);
		$resultCheck1 = mysqli_num_rows($result1);
		$sql_select2 = "SELECT id FROM agent WHERE id = '$userId';";
		$result2 = mysqli_query($conn, $sql_select2);
		$resultCheck2 = mysqli_num_rows($result2);
		$sql_select3 = "SELECT id FROM club WHERE id = '$userId';";
		$result3 = mysqli_query($conn, $sql_select3);
		$resultCheck3 = mysqli_num_rows($result3);
		$sql_select4 = "SELECT id FROM journalist WHERE id = '$userId';";
		$result4 = mysqli_query($conn, $sql_select4);
		$resultCheck4 = mysqli_num_rows($result4);
		$sql_select5 = "SELECT id FROM scout WHERE id = '$userId';";
		$result5 = mysqli_query($conn, $sql_select5);
		$resultCheck5 = mysqli_num_rows($result5);

		if ($resultCheck == 0) {

		 	header("Location: login.php?error=nosuchuser");
			exit();

		 }

		 else{
		 	
			if(($resultCheck3 > 0 && $password == $row['password']) || password_verify($password, $row['password']) == 1){
				
				if ($resultCheck1 > 0) {
		 			session_start();
			 		$_SESSION['id'] = $row['id'];
			 		$_SESSION['username'] = $row['username'];

			 		header("Location: home_agency.php");
					exit();
		 		}
		 		else if ($resultCheck2 > 0) {
					session_start();
		 			$_SESSION['id'] = $row['id'];
			 		$_SESSION['username'] = $row['username'];

			 		header("Location: home_agent.php");
					exit();
		 		}
		 		else if ($resultCheck3 > 0) {
					$sql_select_username = "SELECT name FROM agency;";
					$sql_select_agency = "SELECT name, no_of_scouts FROM agency;";
					$username_result = mysqli_query($conn, $sql_select_username);
					$agency_result = mysqli_query($conn, $sql_select_agency);
					$agencies = array();
					$agency_list = array();
					if(mysqli_num_rows($username_result) > 0){

						while ($agency_row = mysqli_fetch_assoc($username_result)) {

							$agencies[] = $agency_row;

						}

					}

					foreach ($agencies as $agency) {

						array_push($agency_list, $agency['name']);

					}

					session_start();

					$_SESSION['agency_list'] = $agency_list;
		 			$_SESSION['id'] = $row['id'];
			 		$_SESSION['username'] = $row['username'];

			 		header("Location: ../home_club.php");
					exit();
		 		}
		 		else if ($resultCheck4 > 0) {
					session_start();
		 			$_SESSION['id'] = $row['id'];
			 		$_SESSION['username'] = $row['username'];

			 		header("Location: home_journalist.php");
					exit();
		 		}
		 		else if ($resultCheck5 > 0) {
					session_start();
		 			$_SESSION['id'] = $row['id'];
			 		$_SESSION['username'] = $row['username'];

			 		header("Location: home_scout.php");
					exit();
		 		}
				
			}

		 	else {
				
				header("Location: login.php?error=wrongpassword");
				exit();
		 		
		 	}
		 } 
	}

}

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
		$hashedPwd = $row['password'];
		$pwdCheck = password_verify($password, $hashedPwd);

		if ($resultCheck == 0) {

		 	header("Location: login.php?error=nosuchuser");
			exit();

		 }

		 else{
		 	if ($pwdCheck!=1){

				header("Location: login.php?error=wrongpassword&hashpassword=".$pwdCheck);
				exit();

		 	}

		 	else {

		 		$sql_select1 = "SELECT * FROM agency WHERE username = '$uid';";
		 		$result1 = mysqli_query($conn, $sql_select1);
		 		$resultCheck1 = mysqli_num_rows($result1);
		 		$sql_select2 = "SELECT * FROM agent WHERE username = '$uid';";
		 		$result2 = mysqli_query($conn, $sql_select2);
		 		$resultCheck2 = mysqli_num_rows($result2);
		 		$sql_select3 = "SELECT * FROM club WHERE username = '$uid';";
		 		$result3 = mysqli_query($conn, $sql_select3);
		 		$resultCheck3 = mysqli_num_rows($result3);
		 		$sql_select4 = "SELECT * FROM journalist WHERE username = '$uid';";
		 		$result4 = mysqli_query($conn, $sql_select4);
		 		$resultCheck4 = mysqli_num_rows($result4);
		 		$sql_select5 = "SELECT * FROM scout WHERE username = '$uid';";
		 		$result5 = mysqli_query($conn, $sql_select5);
		 		$resultCheck5 = mysqli_num_rows($result5);

		 		if ($resultCheck1 > 0) {
		 			session_start();
			 		$_SESSION['userId'] = $row['id'];
			 		$_SESSION['userUid'] = $row['username'];

			 		header("Location: home_agency.php");
					exit();
		 		}
		 		else if ($resultCheck2 > 0) {
		 			$_SESSION['userId'] = $row['id'];
			 		$_SESSION['userUid'] = $row['username'];

			 		header("Location: home_agent.php");
					exit();
		 		}
		 		else if ($resultCheck3 > 0) {
		 			$_SESSION['userId'] = $row['id'];
			 		$_SESSION['userUid'] = $row['username'];

			 		header("Location: home_club.php");
					exit();
		 		}
		 		else if ($resultCheck4 > 0) {
		 			$_SESSION['userId'] = $row['id'];
			 		$_SESSION['userUid'] = $row['username'];

			 		header("Location: home_journalist.php");
					exit();
		 		}
		 		else if ($resultCheck5 > 0) {
		 			$_SESSION['userId'] = $row['id'];
			 		$_SESSION['userUid'] = $row['username'];

			 		header("Location: home_scout.php");
					exit();
		 		}
		 	}
		 } 
	}

}

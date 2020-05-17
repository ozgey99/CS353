<?php include ('signup.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Scout Online</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Signup for Journalist</h2>
	</div>

	<form method="post" action="signup_journalist.php">
        <?php include('errors.php'); ?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username">
		</div>
        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name">
        </div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1" value="">
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="password" name="password_2" value="">
		</div>
		<div class="input-group">
			<button type="submit" name="signup_journalist" class="btn">Sign up</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html> 
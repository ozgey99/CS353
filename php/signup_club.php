<?php include ('signup.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Signup for Club</h2>
</div>

<form method="post" action="signup_club.php">
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
        <label>League</label>
        <input type="text" name="league">
    </div>
    <div class="input-group">
        <label>Budget</label>
        <input type="text" name="budget">
    </div>
    <div class="input-group">
        <label>City</label>
        <input type="text" name="city">
    </div>
    <div class="input-group">
        <label>Director</label>
        <input type="text" name="director">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" name="signup_club" class="btn">Sign up</button>
    </div>
</form>
</body>
</html>
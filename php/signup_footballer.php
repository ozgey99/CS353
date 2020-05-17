<?php include ('signup.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Signup for Footballer</h2>
</div>

<form method="post" action="signup_footballer.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Name</label>
        <input type="text" name="name">
    </div>
    <div class="input-group">
        <label>Age</label>
        <input type="text" name="age">
    </div>
    <div class="input-group">
        <label>Value</label>
        <input type="text" name="value">
    </div>
    <div class="input-group">
        <label>Nationality</label>
        <input type="text" name="nationality">
    </div>
    <div class="input-group">
        <label>Team</label>
        <input type="text" name="team">
    </div>
    <select name="position">
        <option>Goalkeeper</option>
        <option>Centre-Back</option>
        <option>Left-Back</option>
        <option>Right-Back</option>
        <option>Deffensive Midfield</option>
        <option>Central Midfield</option>
        <option>Attacking Midfield</option>
        <option>Left Winger</option>
        <option>Right Winger</option>
        <option>Centre-Forward</option>
        <option>Second Striker</option>
    </select>
    <div class="input-group">
        <button type="submit" name="signup_footballer" class="btn">Sign up</button>
    </div>
</form>
</body>
</html> 
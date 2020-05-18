<?php include('signup.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Signup for Scout</h2>
</div>

<form method="post" action="signup_scout.php">
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
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <label>Activation Key</label>
        <input type="text" name="activation_key">
    </div>
    <fieldset>
        <legend>What is your experienced league?</legend>
        <input type="checkbox" name="lig[]" value="spain">LaLiga<br>
        <input type="checkbox" name="lig[]" value="turkey">Türkiye Süper Ligi<br>
        <input type="checkbox" name="lig[]" value="germany">BundesLiga<br>
        <input type="checkbox" name="lig[]" value="uk">Premier League<br>
        <input type="checkbox" name="lig[]" value="champ">Champions League<br>
        <input type="checkbox" name="lig[]" value="uefa">UEFA Europe League<br>
        <input type="checkbox" name="lig[]" value="italy">Seria A<br>
        <input type="checkbox" name="lig[]" value="france">Ligue 1<br>
        <input type="checkbox" name="lig[]" value="nether">Eredevisie<br>
        <input type="checkbox" name="lig[]" value="portugal">Liga Zon Sagres<br>
        <input type="checkbox" name="lig[]" value="brasil">Brasileirao<br>
    </fieldset>
    <fieldset>
        <legend>What is your experienced position?</legend>
        <input type="checkbox" name="pos[]" value="gk">Goalkeeper<br>
        <input type="checkbox" name="pos[]" value="cb">Centre-Back<br>
        <input type="checkbox" name="pos[]" value="rb">Right-Back<br>
        <input type="checkbox" name="pos[]" value="lb">Left-Back<br>
        <input type="checkbox" name="pos[]" value="dm">Deffensive Midfield<br>
        <input type="checkbox" name="pos[]" value="cm">Central Midfield<br>
        <input type="checkbox" name="pos[]" value="am">Attacking Midfield<br>
        <input type="checkbox" name="pos[]" value="lw">Left Winger<br>
        <input type="checkbox" name="pos[]" value="rw">Right Winger<br>
        <input type="checkbox" name="pos[]" value="cf">Centre Forward<br>
        <input type="checkbox" name="pos[]" value="st">Second Striker<br>
    </fieldset>
    <div class="input-group">
        <button type="submit" name="signup_scout" class="btn">Sign up</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>
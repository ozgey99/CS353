<?php include('signup.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Scout Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Signup for Agent</h2>
</div>

<form method="post" action="signup_agent.php">
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
    <div>
        <label>Please Select Your Player(s)</label>
        <select name="footballers[]" multiple>
            <?php 
                $query = "SELECT id,name FROM footballer";
                $result = mysqli_query($cn,$query);
                while($row = mysqli_fetch_assoc($result)) {
                    $footballer_name = $row['name'];
                    $footballer_id = $row['id'];?>
                    <option value="<?php echo $footballer_id;?>"><?php echo $footballer_name;?></option>
                <?php
                }
            ?>
        </select> 
    </div>
    <div class="input-group">
        <button type="submit" name="signup_agent" class="btn">Sign up</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>

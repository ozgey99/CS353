<?php 
      require 'header.php';
?>  

<div class="container">

  <div >

    <h2>Welcome to Journalist Home Page</h2>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Journalist!</p>";
    	}
    ?>
    <form onclick="window.location.href='subscribe.php'">

      <button type="button" class="btn btn-info" name="subscribe">Subscribe</button>

    </form>

      <br>

    <form onclick="window.location.href='notifications.php'">

      <button type="button" class="btn btn-info" name = "notifications">See Notifications</button>
      
    </form>

      <br>

      <form action="logout_inc.php">

          <button type="submit" class="btn btn-danger" name="logout-submit">Logout</button>

      </form>

      
    	

  </div>

</div>

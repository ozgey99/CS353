<?php 
      require 'header.php';
?>  

<div class="container">

  <div>

      <br>
    <h2>Welcome to Agency Home Page</h2>
      <br>
    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Agency!</p>";
    	}
    ?>
      <br>
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
      <br> <br>
      <div>
          <a href="agency_requests.php" style="color: #0c5460">Want to see your requests?</a>
      </div>

  </div>

</div>

<?php 
      require 'header.php';
?>  

<div class="container">

  <div >
      <br>
    <h2>Welcome to Club Home Page</h2>
      <br>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Club!</p>";
    	}
    ?>
      <br>
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
      <br><br>
      <div>
          <a href="club_reports.php" style="color: #0c5460">Want to see the reports?</a>
      </div>

  </div>

</div>

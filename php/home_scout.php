<?php 
      require 'header.php';
?>  

<div class="container">

  <div >
      <br>
    <h2>Welcome to Scout Home  Page</h2>
      <br>
    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Scout!</p>";
    	}
    ?>
      <br>
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
      <br> <br>
      <div>
          <a href="scout_tasks.php" style="color: #0c5460">Want to see your tasks?</a>
      </div>

  </div>

</div>

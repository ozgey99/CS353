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

    <form action="report.php" method="post">

      <button type="submit" class="btn btn-info" name="report">Create Report</button>
    
    </form>

      <br>

    <form action="watchlist.php" method="post">

      <button type="submit" class="btn btn-info" name="report">Add Player to Watchlist</button>
    
    </form>
      <br>

      <form action="scout_tasks.php">
          <button type="submit" class="btn btn-info" name="tasks-scout-submit">See Your Tasks</button>
      </form>
      <br>

    <form action="logout_inc.php">

      <button type="submit" class="btn btn-danger" name="logout-submit">Logout</button>

    </form>
    
      <br> <br>

  </div>

</div>

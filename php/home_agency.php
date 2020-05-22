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
      else {
            echo "<p class='login-status'>You are logged out!</p>";
      }
    ?>
      <br>
      <form action="scouts.php">
        <button type="submit" class="btn btn-info" name="logout-submit">See Your Scouts</button>
      </form>

      <br>

      <form action="agency_requests.php">
          <button type="submit" class="btn btn-info" name="request-submit">See Your Requests</button>
      </form>

      <br>

      <form action="logout_inc.php">

          <button type="submit" class="btn btn-danger" name="logout-submit">Logout</button>

      </form>

  </div>

</div>

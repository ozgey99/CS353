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
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>

      <form onclick="window.location.href='subscribe.php'">

          <button type="button" name="subscribe">Subscribe</button>

      </form>
    	

  </div>

</div>

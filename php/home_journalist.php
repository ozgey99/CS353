<?php 
      require 'header.php';
?>  

<div class="container">

  <div >

    <h2>Welcome to Journalist Home Page</h2>

    <?php 
    	if (isset($_SESSION['userId'])) {
    		echo "<p class='login-status'>You are logged in as Journalist!</p>";
    	}
    ?>
    <form action="includes/logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
    	

  </div>

</div>
<?php 
      require 'header.php';
?>  

<div class="container">

  <div >

    <h2>Welcome to Scout Home  Page</h2>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Scout!</p>";
    	}
    ?>
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
    	

  </div>

</div>

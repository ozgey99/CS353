<?php 
      require 'header.php';
?>  

<div class="container">

  <div >

    <h2>Welcome to Club Home Page</h2>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as ",$_SESSION['username'],"!</p>";
    	}
      else {
        echo "<p class='login-status'>You are logged out!</p>";
      }

    ?>
    <form action="logout_inc.php">

    	<button type="submit" name="logout-submit">Logout</button>

    </form>
    
    <br>

    <form method="post">
      <button type = "submit" name = "request">Request Scout</button>
      <?php 
        if(isset($_POST['request'])){
          header("Location: scout_request.php");
          exit();
        }
      ?>
    </form>

  </div>

</div>

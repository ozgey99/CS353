<?php 
      require 'header.php';
?>  

<div class="container">

  <div >

    <h2>Welcome to Agent Home Page</h2>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Agent!</p>";
    	}

    ?>

      <br>
      <form method="post">
          <button type = "submit" class="btn btn-info" name = "recommend">Make a recommendation to a club</button>
          <?php
          if(isset($_POST['recommend'])){
              header("Location: recommend.php");
              exit();
          }
          ?>
      </form>
      <br>
      <form method="post">
          <button type = "submit" class="btn btn-info" name = "myfootballers">See your footballers</button>
          <?php
          if(isset($_POST['myfootballers'])){
              header("Location: myfootballers.php");
              exit();
          }
          ?>
      </form>
      <br>
      <form method="post">
          <button type = "submit" class="btn btn-info" name = "offers">See your offers</button>
          <?php
          if(isset($_POST['offers'])){
              header("Location: offers.php");
              exit();
          }
          ?>
      </form>
      <br>
    <form action="logout_inc.php">

    	<button type="submit" class="btn btn-danger" name="logout-submit">Logout</button>

    </form>


  </div>

</div>

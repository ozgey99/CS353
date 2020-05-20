<div class="container">

  <div >
      <br>

    <h2>Welcome to Club Home Page</h2>
      <br>

    <?php 
    	if (isset($_SESSION['id'])) {
    		echo "<p class='login-status'>You are logged in as Club!</p>";
    	}
      else {
        echo "<p class='login-status'>You are logged out!</p>";
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

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
      else {
        echo "<p class='login-status'>You are logged out!</p>";
      }


    ?>

      <br>

    <form method="post">
      <button type = "submit" class="btn btn-info" name = "request">Request Scout</button>
      <?php 
        if(isset($_POST['request'])){
          header("Location: scout_request.php");
          exit();
        }
      ?>
    </form>

      <br>
      <form method="post">
          <button type = "submit" class="btn btn-info" name = "offer">Make a transfer offer</button>
          <?php
          if(isset($_POST['offer'])){
              header("Location: transfer_offer.php");
              exit();
          }
          ?>
      </form>
      <br>
      <form method="post">
      <button type = "submit" class="btn btn-info" name = "offerable">Offer to Agent</button>
      <?php 
        if(isset($_POST['offerable'])){
          header("Location: agent_offerable.php");
          exit();
        }
      ?>
    </form>

      
      <br>
      <form method="post">
      <button type = "submit"  class="btn btn-info" name = "your-offers">Your Offers</button>
      <?php 
        if(isset($_POST['your-offers'])){
          header("Location: your_offers.php");
          exit();
        }
      ?>
    </form>


      <br>
    <form method="post">
      <button type = "submit" class="btn btn-info" name = "offers">Show Offers to You</button>
      <?php 
        if(isset($_POST['offers'])){
          header("Location: offers.php");
          exit();
        }
      ?>
    </form>
    <br>

      <form action="club_reports.php">
          <button type="submit" class="btn btn-info" name="reports-club-submit">See Your Reports</button>
      </form>

      <br>

      <form action="profile_club.php">
          <button type="submit" class="btn btn-warning" name="prof-club-submit">See Your Profile</button>
      </form>

      <br>
      <form action="logout_inc.php">

          <button type="submit" class="btn btn-danger" name="logout-submit" onclick="window.location.href = 'http://footballerscout.epizy.com/profile_club.php?type=club&id='$id';">Logout</button>

      </form>

  </div>

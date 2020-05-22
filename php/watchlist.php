<?php 
	include 'config.php';
	require 'header.php';
      $conn = $cn;
?>
<?php 
      
      $select_footballer = "SELECT name FROM footballer;";
      $result = mysqli_query($conn, $select_footballer);
      $footballers = array();
      $resultCheck = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
            $footballers[] = $row['name'];
      }

?>
<div class="container">

    <div class="watchlist">

      <form action="watchlist_inc.php" method="post">
            
            <label for="watchlist">Select footballer(s) for watchlist:</label>
            <select name="watchlist">
              <?php
                  foreach ($footballers as $footballer) {
              ?>  
              <option><?php echo $footballer;?></option>
              <?php } ?>
            </select>

            <button type="submit" class="btn btn-primary" name="watchlist-submit">Submit</button>
            <button type="submit" class="btn btn-success" name="watchlist-done">I am done</button>


      </form> 


    </div>

</div>
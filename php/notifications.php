
<?php 
  require 'header.php';
  include 'config.php';
?>

<div class="container">

  <div class="notifications">

    <form action="notifications_inc.php" method="post">

      <table id="offers" class="table">
        <thead>
          <tr>
            <th>Notification No.</th>
            <th>Club</th>
            <th>Positions</th>
            <th>Organization</th>
            <th>Date</th>
          </tr>
        </thead>  
          
        <?php 
              $journalist_id = $_SESSION['id'];
              $select_notifies = "SELECT * FROM notifies WHERE journalist_id = '$journalist_id';";
              $notifies_result = mysqli_query($cn,$select_notifies);
              $result_check = mysqli_num_rows($notifies_result);

              $assoc_arr = array();

              $index = 1;
              if( $result_check > 0) {
                  while($row = mysqli_fetch_assoc($notifies_result)) {

                      $request_id = $row['request_id'];
                      $notification_id = $row['notification_id'];

                      $select_club_id = "SELECT club_id FROM requests WHERE request_id = '$request_id'; ";
                      $club_id_result = mysqli_query($cn, $select_club_id);
                      $club_id_fetch = mysqli_fetch_assoc($club_id_result);
                      $club_id = $club_id_fetch['club_id'];
                      
                      $select_club_name = "SELECT name FROM club WHERE id = '$club_id'; ";
                      $club_name_result = mysqli_query($cn, $select_club_name);
                      $club_name_fetch = mysqli_fetch_assoc($club_name_result);
                      $club_name = $club_name_fetch['name'];

                      $select_positions = "SELECT positions FROM notification WHERE id = '$notification_id';";
                      $positions_result = mysqli_query($cn, $select_positions);
                      $positions_fetch = mysqli_fetch_assoc($positions_result);
                      $positions = $positions_fetch['positions'];

                      $select_organization_date = "SELECT * FROM request WHERE id = '$request_id';";
                      $organization_date_result = mysqli_query($cn, $select_organization_date);
                      $organization_date_fetch = mysqli_fetch_assoc($organization_date_result);
                      $organization = $organization_date_fetch['organization'];
                      $date = $organization_date_fetch['start_date'];
                      
                      echo 
                          "<tr>
                              <td>$index</td>
                              <td>$club_name</td>
                              <td>$positions</td>
                              <td>$organization</td>
                              <td>$date</td>
                          </tr>";

                      $index++;
                  }
              }
        ?>
      </table>
 <br>
        <button type='button' class="btn btn-info" onclick="window.location.href='home_journalist.php'">
            Home
        </button>
    </form> 


  </div>

</div>
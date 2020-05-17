  <?php 
      require 'header.php';
  ?>  

  <div class="container">

    <div class="login">

      <link rel="stylesheet" href="styles.css">

      <h2>Login to Scout Online</h2>

      <?php  

          if (isset($_GET['error'])) {
              if ($_GET['error'] == "emptyform") {
                 echo "<p class=signuperror>All fields must be filled!</p>";
              }
              elseif ($_GET['error'] == "nosuchuser") {
                  echo "<p class=signuperror>User does not exist!</p>";
              }
              elseif ($_GET['error'] == "wrongpassword") {
                  echo "<p class=signuperror>Password is wrong!</p>";
              }
          }

      ?>

      <form action="login_inc.php" method="post" >

        <input type="text" name="mailuid" value="" placeholder="Username">

        <input type="password" name="pwd" value="" placeholder="Password">

        <button type="submit" name="login-submit">Login</button>

      </form>

    </div>
   
    <div class="login-help">

      <p>Not yet a member? <a href="index.php">Sign Up</a></p>
      
    </div>
  </div>
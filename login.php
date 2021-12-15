<?php
  // (A) PROCESS LOGIN ON SUBMIT
  session_start();
  if (isset($_POST["email"])) {
    require "config/users.php";
    $USR->login($_POST["email"], $_POST["password"]);
  }

  // (B) REDIRECT USER IF SIGNED IN
  if (isset($_SESSION["user"])) {
    // Todo: conditional redirect depending ??
    header("Location: checkout.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templates/document-head.php'); ?>
  <body>
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="index.php">
            <img src="assets/images/RZ.png" width="125px">
          </a>
        </div>
        <?php include('templates/main-nav.php'); ?>
      </div>
    </div>

    <div class="accout-page">
      <div class="container">

        <div class="row">
          <div class="col-2">
            <div class="form-container">    
            <div class="form-btn">
                <span>Login</span>
              </div>                        
              <!-- LOGIN FORM -->
              <form id="LoginForm" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn">Login</button>
                <p><a href="register.php">Don't have an account?  <strong>Register</strong></a></p>
              </form> 
              <?php
                if (isset($_POST["email"])) {
                  echo "<div id='notify'>Invalid user/password</div>";
                }
              ?> 
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
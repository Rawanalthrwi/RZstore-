<?php
  // START SESSION
  session_start();

  // if (isset($_POST["email"])) {
  //   require "config/users.php";
  //   $USR->login($_POST["email"], $_POST["password"]);
  // }

  // USER IS SIGNED IN
  if (isset($_SESSION["user"])) {
    // Todo: conditional redirect depending ??
    // header("Location: checkout.php");
    // exit();
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
                <span onclick="login()">Login</span>
                <span onclick="register()">Register</span>
                <hr id="indicator">
              </div>
              
              <!-- LOGIN FORM -->
              <form id="LoginForm" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn">Login</button>
                <a href="">Forgot password</a>
              </form> 
              <?php
                if (isset($_POST["email"])) {
                  echo "<div id='notify'>Invalid user/password</div>";
                }
              ?> 

              <!-- REGISTRATION FORM -->
              <form id="RegForm" method="post">
                <input type="email" name="email" placeholder="Email" required value="zeta.ad12@gmail.com"/>
                <input type="password" name="pass" placeholder="Password" required value="123456"/>
                <input type="password" name="cpass" placeholder="Confirm Password" required value="123456"/>
                <input type="submit" class="btn" value="Go!"/>
              </form>

              <?php
              if (isset($_POST["email"])) {
                require "config/users.php";
                echo $USR->register($_POST["email"], $_POST["pass"], $_POST["cpass"])
                  ? "Check your email and click on the activation link"
                  : $USR->error ;
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!------------------- form toggle ----------->
    <script>
      var LoginForm = document.getElementById("LoginForm");
      var RegForm = document.getElementById("RegForm");
      var Indicator = document.getElementById("indicator");

      function register() {        
        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)"
      };

      function login() {
        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)"
      };
    </script>

  </body>
</html>
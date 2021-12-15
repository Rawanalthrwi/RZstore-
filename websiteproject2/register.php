<?php
  // REDIRECT USER IF SIGNED IN
  if (isset($_SESSION["user"])) {
    //  we assume you hit the register page from the CHECKOUT page (User info step)
    // so we redirect you there if you land here and are already logged in/ registered
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
                <span>Register</span>
              </div>

              <!-- REGISTRATION FORM -->
              <form id="RegForm" method="post">
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="pass" placeholder="Password" required/>
                <input type="password" name="cpass" placeholder="Confirm Password" required/>
                <br />
                <input type="address" name="address" placeholder="Shipping Address" required />
                <input type="submit" class="btn" value="Go!"/>
                <p><a href="login.php">Already have an account?  <strong>Login</strong></a></p>
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

  </body>
</html>
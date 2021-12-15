<nav>
  <ul id="MenuItems">
    <li><a href="index.php">Home</a></li>
    <li><a href="products.php">Products</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="contact.php">Contact</a></li>
    
    <?php
    // CHECK TO SEE IF USER IS LOGGED IN
    // IF LOGGED IN, WE SHOW LINK TO ACCOUNT (where user can update info)
    // ELSE WE SHOW LINKs TO LOGIN OR REGISTER FOR AN ACCOUNT
    //session_start(); ?>

    <li class="login-or-register">
      <?php if (!isset($_SESSION["user"])) { ?>
        <a href="login.php">Login</a> 
        <span class="slash">~ or ~</span> 
        <a href="register.php" class="login-register-btn__alt">Register</a>
      <?php } else { ?>        
        <!-- YOU'RE LOGGED IN -->
        <a href="#" class="account-btn">Welcome back!</a>
      <?php }  ?>
    </li>

  </ul>
</nav>
<div class="header-cart">
  <img id="header-cart-icon" src="assets/images/cart.png" width="30px" height="30px">
  <!-- (B) CURRENT CART -->
  <div id="cart" class="cart hidden">cart is empty</div>
</div>

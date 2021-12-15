<!DOCTYPE html>
<html lang="en">
  <?php 
  // START SESSION
  session_start();

  include('templates/document-head.php'); ?>

  <body>
    <?php
      $pageHeadline = 'Checkout';
      $pageSubHeadline = 'Get in touch with us if you have any issues, questions or concenrs';
      include('templates/header.php');
    ?>

    <div class="small-container cart-page">

      <div class="row">
        <div class="col-1">
        <h3>1. User info</h3>
        <?php 
        // IF USER ISN'T LOGGED IN WE PROMPT THEM TO
        // REGISTER OR LOG IN
        if (!isset($_SESSION["user"])) { ?>
          <p>Looks like you're not logged in!</p>
          <p>
            <a class="bbb" href="login.php">Login</a>  
            <span class="slash">~ or ~</span>  
            <a class="bbb" href="register.php">Register</a>
          </p>
        <?php 
        // IF THE USER IS LOGGED IN
        //  WE SHOW THEIR SESSION INFO I.E.
        //  EMAIL, SHIPPING ADDRESS, ETC
        } else { ?>        
          <p><strong>Welcome back!</strong></p>
          <p>Please verify that your information is accurate:</p>
          <div class="session-info">
            <?php
              foreach($_SESSION['user'] AS $key=>$val) { ?>
                <div class="user-session <?php echo $key ?>">
                <strong><?php echo $key ?></strong>: <?php echo $val ?>
                </div>
            <?php } ?>
          </div>        
        <?php }  ?>
                

<!-- ------------------------- -->

        <?php
          // CONNECT TO THE DATABASE 
          require "config/database.php";
          
          // FIND ITEMS IN OUR "PRODUCTS" TABLE THAT MATCH
          // PRODUCTS IN OUR CART SESSION IDs
          $sql = "SELECT * FROM `products` WHERE `pid` IN (";
          $sql .= str_repeat("?,", count($_SESSION["cart"]) - 1) . "?";
          $sql .= ")";

          // SET OUR CART PRODUCTS TO THE ITEM VARIABLE $items
          $items = $DB->fetchAll($sql, array_keys($_SESSION["cart"]), "pid"); ?>

          <!-- ORDER DETAILS/ SUMMARY -->
          <h3>2. Order Summary</h3><br/>
            <table>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
              <?php 
                // LOOP THROUGH OUR CART SESSION AND 
                // SET THE QUANTITY TO A VARIABLE $QTY
                // we use that in the checkout/cart table below
                foreach ($_SESSION["cart"] as $pid=>$qty) {
                  if (isset($items[$pid])) { 
                    $items[$pid]["qty"] = $qty;
                  }
                }

                // LOOP THROUGH PRODUCTS IN OUR CART SESSION AND DISPLAY THEM HERE
                foreach ($items as $p) { ?>            
                  <tr>
                    <td>
                      <div class="cart-info">                  
                      <img src="assets/images/products/<?= $p["image"] ?>" alt="<?= $p["name"] ?>">
                        <div>
                          <p><?= $p["name"] ?></p>
                          <small>Price: <?= $p["price"] ?></small><br>
                        </div>
                      </div>
                    </td>
                    <td>
                      <input type="number" value="<?= $items[$pid]["qty"] ?>" readonly>
                    </td>
                    <td>$<?= $p["price"] ?></td>
                  </tr>
              <?php }; // end foreach?>
            </table>

            <div class="total-price">
              <table>
                <tr>
                  <td>Subtotal</td>
                  <td>$00.00</td>
                </tr>
                <tr>
                  <td>Tax</td>
                  <td>$00.00</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>$00.00</td>
                </tr>
              </table>
            </div>
            <div class="total-price">
              <a href="#" class="btn bbb">Complete Order</a>
            </div>
          
<!-- ------------------------- -->


        </div>




      </div>

    </div>  

  </body>
</html>

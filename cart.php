<!DOCTYPE html>
<html lang="en">

  <?php include('templates/document-head.php'); ?>
  
  <body>
    <?php
    $pageHeadline = 'Product Detail';
    $pageSubHeadline = 'todo: Pull this info from DB';
    include('templates/header.php');
    ?>
    <!--------------Cart Items details--------------->
    <div class="small-container cart-page">

      <table>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>

        <tr>
          <td>
            <div class="cart-info">
              <img src="images/front_shirt.png">
              <div>
                <p>Green T-Shirt</p>
                <small>Price: $50.00</small><br>
                <a href="">Remove</a>
              </div>
            </div>
          </td>
          <td><input type="number" value="1"></td>
          <td>$50.00</td>
        </tr>
        <tr>
          <td>
            <div class="cart-info">
              <img src="images/jeans.png">
              <div>
                <p>Light Blue Jeans</p>
                <small>Price: $75.00</small><br>
                <a href="">Remove</a>
              </div>
            </div>
          </td>
          <td><input type="number" value="1"></td>
          <td>$75.00</td>
        </tr>
        <tr>
          <td>
            <div class="cart-info">
              <img src="images/earings.png">
              <div>
                <p>Red Earings</p>
                <small>Price: $45.00</small><br>
                <a href="">Remove</a>
              </div>
            </div>
          </td>
          <td><input type="number" value="1"></td>
          <td>$45.00</td>
        </tr>
      </table>

      <div class="total-price">
        <table>
          <tr>
            <td>Subtotal</td>
            <td>$170.00</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td>$35.00</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>$205.00</td>
          </tr>

        </table>
      </div>
      <div class="total-price">
        <a href="#" class="btn">Proceed to checkout &#8594;</a>
      </div>

    </div>

  </body>

</html>
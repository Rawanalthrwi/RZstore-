<!DOCTYPE html>
<html lang="en">
  <?php include('templates/document-head.php'); ?>
  <body>
    <?php
      $pageHeadline = 'Product Detail';
      $pageSubHeadline = 'todo: Pull this info from DB';
      include('templates/header.php');
    ?>
    <!--------------single-product--------------->
    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <img src="images/front_shirt.png" width="100%" id="ProductImg">
          <div class="small-img-row">
            <div class="small-img-col">
              <img src="images/shirt.png" class="small-img" width="100%">
            </div>
            <div class="small-img-col">
              <img src="images/front_shirt.png" class="small-img" width="100%">
            </div>
          </div>

        </div>
        <div class="col-2">
          <p>Home / T-Shirt</p>
          <h1>Green T-Shirt</h1>
          <h4>$50.00</h4>

          <select>
            <option>Select Size</option>
            <option>XXL</option>
            <option>XL</option>
            <option>Large</option>
            <option>Midium</option>
            <option>Small</option>
          </select>

          <input type="number" value="1">
          <a href="#" class="btn">Add To Cart</a>

          <h3>PRODUCT DETAILS <i class="fa fa-indent"></i></h3>
          <br>
          <p>Nice Green T-shirt for summer</p>
        </div>
      </div>
    </div>

  </body>
</html>
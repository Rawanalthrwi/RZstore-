<!DOCTYPE html>
<html lang="en">
  <?php 
  // START SESSION
  session_start();
  include('templates/document-head.php'); ?>
  <body>
    <?php
      $pageHeadline = 'Our Shop';
      $pageSubHeadline = 'Our store has the most trendy outfits and you are welcome to wear them';
      include('templates/header.php');
    ?>

    <div class="small-container">
      <div class="row row-2">
        <h2>All Products</h2>
        <select>
          <option>Default Shorting</option>
          <option>Short by price</option>
          <option>Short by popularity</option>
          <option>Short by rating</option>
          <option>Short by sale</option>
        </select>
      </div>

      <div class="row">

        <!-- start: Product -->
        <?php
        // (A1) GET ALL PRODUCTS
        require "config/database.php";
        $products = $DB->fetchAll("SELECT * FROM `products`");

        // (A2) PRODUCTS LIST
        foreach ($products as $p) { ?>

          <div class="col-4">

            <a href="product-details.php" title="<?= $p["name"] ?>">
              <img src="assets/images/products/<?= $p["image"] ?>" alt="<?= $p["name"] ?>">
            </a>

            <h4>
              <a href="product-details.php">
                <?= $p["name"] ?>
              </a>
            </h4>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
            </div>
            <p>$<?= $p["price"] ?></p>
            <button class="pAdd add-button" onclick="cart.add(<?= $p["pid"] ?>)">
              Add To Cart
            </button>            
          </div>
        <?php  } ?>
      </div>
      <!-- end: Product -->

    </div>

  </body>
</html>
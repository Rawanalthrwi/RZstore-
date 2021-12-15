<!DOCTYPE html>
<html lang="en">
  <?php // START SESSION
  session_start(); 
  include('templates/document-head.php'); ?>
  <body>
    <?php 
      $pageHeadline = 'Best Store Ever';
      $pageSubHeadline = 'Our store has the most trendy outfits and you are welcome to wear them';
      include('templates/header.php'); 
    ?>

    <div class="categories">
      <div class="cat-grid small-container">
        <a href="products.php" class="cat-grid__item">
          <img src="assets/images/square-1.jpg">
          <div class="cat-grid__item-title cat-1">
            <div>
              <h3>Shop Men's</h3>
              <p>shop all mens category</p>
            </div>
          </div>
        </a>
        <a href="products.php" class="cat-grid__item">
          <img src="assets/images/square-12.jpg">
          <div class="cat-grid__item-title cat-2">
            <div>
              <h3>Shop Makeup</h3>
              <p>shop all accessories</p>
            </div>
          </div>
        </a>
        <a href="products.php" class="cat-grid__item">
          <img src="assets/images/square-13.png">
          <div class="cat-grid__item-title cat-3">
            <div>
              <h3>Shop Women's</h3>
              <p>shop all womens category</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </body>
</html>
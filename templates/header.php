<div class="header">
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="index.php">
          <img src="assets/images/RZ.png" width="125px" />
        </a>
      </div>
      <?php include('templates/main-nav.php'); ?>
    </div>
    <div class="row">
      <div class="col-2">
        <h1>
          <?php if (empty($pageHeadline)) :
            echo "Best Store Ever";
          else :
            echo $pageHeadline;
          endif; ?>
        </h1>
        <h2>
          <?php if (empty($pageSubHeadline)) :
            echo "Our store has the most trendy outfits and you are welcome to wear them";
          else :
            echo $pageSubHeadline;
          endif; ?>
        </h2>
      </div>
    </div>
  </div>
</div>
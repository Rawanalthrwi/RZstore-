<!DOCTYPE html>
<html lang="en">

  <?php 
  // START SESSION
  session_start();
  include('templates/document-head.php'); ?>
  <style>

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}
</style>
  <body>
    <?php
      $pageHeadline = 'About Us';
      $pageSubHeadline = 'Our store has the most trendy outfits and you are welcome to wear them';
      include('templates/header.php');
    ?>

<div class = "column">
    <h3> Welcome to our shopping store! Our shopping store is an online store that caters to all types and age range of women. 
     It's created by Rawan Althrwi and Nazreth Negash.
     We are two ambitious computer engineering students that are aimming for the sky.</h3>
  </body>
</html>
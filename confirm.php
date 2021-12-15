<!DOCTYPE html>
<html>
  <head>
    <title>Confirmation Page</title>
  </head>
  <body>
    <?php
    require "config/users.php";
    echo $USR->verify($_GET["i"], $_GET["h"])
      ? "Thank you! Account has been activated."
      : $USR->error ;
    ?>
  </body>
</html>

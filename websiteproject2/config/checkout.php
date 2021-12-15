<?php
// (A) CHECK CART
session_start();
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"])==0) {
  exit("Cart is empty");
}

// (B) DATABASE - AUTOCOMMIT OFF
require "database.php";
$DB->start();

// (C) MAIN ORDER - USING A DUMMY USER FOR THIS EXAMPLE
// Todo: tie this to logged in user... 
// if user isn't logged in, prompt them to log in before they
// can check out
// -----------------------
// check logged in users...

$name = "Zeta Negash";
$email = "zeta.ad12@gmail.com";
$pass = $DB->exec(
  "INSERT INTO `orders` (`name`, `email`) VALUES (?,?)",
  [$name, $email]
);

// -----------------------

// (D) ORDER ITEMS
if ($pass) {
  // (D1) INSERT SQL
  $sql = "INSERT INTO `orders_items` (`oid`, `pid`, `qty`) VALUES ";
  $sql .= str_repeat("(?,?,?),", count($_SESSION["cart"]));
  $sql = substr($sql, 0, -1) . ";";

  // (D2) INSERT DATA
  $data = [];
  foreach ($_SESSION["cart"] as $pid=>$qty) {
    $data[] = $DB->lastID;
    $data[] = $pid;
    $data[] = $qty;
  }

  // (D3) GO!
  $pass = $DB->exec($sql, $data);
}

// (E) COMMIT OR DISCARD?
$DB->end($pass);
if ($pass) { $_SESSION["cart"] = []; }
echo $pass ? "DONE!" : $DB->error;

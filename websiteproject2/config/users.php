<?php
class Users {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = null;
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) GET USER
  function get ($id) {
    $sql = sprintf("SELECT * FROM `users` WHERE `user_%s`=?", is_numeric($id)?"id":"email");
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute([$id]);
    return $this->stmt->fetch();
  }



  // USER REGISTERATION (SIGN UP & EMAIL CONFIRMATION)
  // --------------------------------------------------
  // (D) REGISTER NEW USER
  function register ($email, $pass, $cpass) {
    // (D1) CHECK IF USER REGISTERED
    // @TODO - WHAT TO DO IF THERE IS AN EXISTING ACTIVATION?
    // ALLOW USER TO GENERATE NEW TOKEN & EMAIL AFTER SOME TIME?
    // MANUAL CONTACT ADMIN?
    $check = $this->get($email);
    if (is_array($check)) {
      $this->error = isset($check["user_activate"])
        ? "$email already has a pending activation."
        : "$email is already registered." ;
      return false;
    }

    // (D2) CHECK PASSWORD
    if ($pass != $cpass) {
      $this->error = "Passwords do not match.";
      return false;
    }

    // (D3) GENERATE NOT-SO-RANDOM TOKEN HASH FOR VERIFICATION
    $token = md5(date("YmdHis") . $email);

    // (D4) INSERT INTO DATABASE
    try {
      $this->stmt = $this->pdo->prepare(
        "INSERT INTO `users` (`user_email`, `user_password`, `user_activate`) VALUES (?,?,?)"
      );
      $this->stmt->execute([$email, password_hash($pass, PASSWORD_DEFAULT), $token]);
      $this->lastID = $this->pdo->lastInsertId();
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }

    // (D5) SEND CONFIRMATION EMAIL
    // @TODO - CHANGE TO YOUR OWN MESSAGE + URL!
    $url = "http://localhost:8888/websiteproject/confirm.php";
    $msg = sprintf(
      "Visit this <a href='%s?i=%u&h=%s'>link</a> to complete your registration.",
      $url, $this->lastID, $token
    );
    if (@mail(
      $email, "Confirm your email", $msg,
      implode("\r\n", ["MIME-Version: 1.0", "Content-type: text/html; charset=utf-8"])
    )) { return true; } else {
      $this->error = "Error sending out email";
      return false;
    }
  }

  // (E) VERIFY REGISTRATION
  function verify ($id, $hash) {
    // (E1) GET + CHECK THE USER
    $user = $this->get($id);
    if ($user === false) {
      $this->error = "User not found.";
      return false;
    }
    if (!isset($user["user_activate"])) {
      $this->error = "Account already activated.";
      return false;
    }
    if ($user["user_activate"] != $hash) {
      $this->error = "Invalid token.";
      return false;
    }

    // (E2) ACTIVATE ACCOUNT IF OK
    try {
      $this->stmt = $this->pdo->prepare("UPDATE `users` SET `user_activate`=NULL WHERE `user_id`=?");
      $this->stmt->execute([$id]);
      $this->lastID = $this->pdo->lastInsertId();
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }

    // @TODO - (E3) SEND WELCOME MESSAGE IF YOU WANT
    // mail ($user["user_email"], "WELCOME!", "Welcome message here.");
    return true;
  }


  // USER LOGIN
  // --------------------------------------------------
  // (F) VERIFY EMAIL PASSWORD - SESSION MUST BE STARTED!
  function login ($email, $password) {
    // (F1) ALREADY SIGNED IN
    if (isset($_SESSION["user"])) { return true; }

    // (F2) GET USER
    $user = $this->get($email);
    if (!is_array($user)) { return false; }

    // (F3) VERIFY PASSWORD + REGISTER SESSION
    if (password_verify($password, $user["user_password"])) {
      $_SESSION["user"] = [];
      foreach ($user as $k=>$v) {
        if ($k!="user_password") { $_SESSION["user"][$k] = $v; }
      }
      return true;
    }
    return false;
  }

  // (G) SAVE USER
  function save ($name, $email, $pass, $id=null) {
    if ($id===null) {
      $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES (?,?,?)";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT)];
    } else {
      $sql = "UPDATE `users` SET `user_name`=?, `user_email`=?, `user_password`=? WHERE `user_id`=?";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT), $id];
    }
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
}

// (F) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "websiteproject_database");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (G) NEW USER OBJECT
$USR = new Users();

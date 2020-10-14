<?php
session_start();
require_once "pdo.php";
unset($_SESSION['user_name']);
unset($_SESSION['user_id']);
$found = false;
if ( isset($_POST['user_email']) && isset($_POST['password']) ){
  if ( strlen($_POST['user_email']) > 1){
    $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i";
    if(preg_match($pattern, $_POST['user_email']) == 1){
      $password = $_POST['password'];
      $sql = "SELECT * FROM users";
      $stmt = $pdo->query($sql);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row){
        if(password_verify( $password, $row["password"]) && $row['email'] === $_POST['user_email']){
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['user_id'] = $row['user_id'];
          $found = true;
          header("Location: feed.php");
          return;
        }
      }
      if(!$found){
        $_SESSION["error"] = "Incorrect Email or Password";
        header("Location: login.php");
        return;
      }
    }
    else{
      $password = $_POST['password'];
      $sql = "SELECT * FROM users";
      $stmt = $pdo->query($sql);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row){
        if( password_verify( $password, $row["password"]) && $row['user_name'] === $_POST['user_email']){
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['user_id'] = $row['user_id'];
          $found = true;
          header("Location: feed.php");
          return;
        }
      }
      if(!$found){
        $_SESSION["error"] = "Incorrect Username or Password";
        header("Location: login.php");
        return;
      }
    }
  }
}
?>
<html>
<head>
  <link href = "logstyle.css" rel = "stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"/>
</head>
<body>
  <h1>Welcome Back</h1>
  <div class="container">
    <h2>Log In</h2>
    <?php
    if ( isset($_SESSION["error"]) ) {
      echo('<p style="color:red; text-align: left; margin-left: 30px;">'.$_SESSION["error"]."</p>\n");
      unset($_SESSION["error"]);
    }
    ?>
    <form method="post">
      <table><tr><th align = "left">Username or Email</th></tr><tr>
        <td><input type="text" name="user_email" size="50" class = "box" id = "un"/></td></tr></table>
        <table><tr><th align = "left">Password</th></tr>
          <tr><td><input type= "password" name="password" size = "50" class = "box" id="password-field"/></td></tr></table>
          <table><tr><th><input type="submit" name = "login" value="Log In" class="button" onclick="return doValidate();"/></th></tr></table>
        </form>
        <p>Do not have an account? <a style="text-decoration:none; color: #fff;" href = "register.php">Register here</a></p>
      </div>

      <script type="text/javascript" src="jquery.min.js">
      </script>

      <script>
      function doValidate() {
        if (validate())
        {
          return true;
        }
        else{
          return false;
        }
      }
      function validate() {
        var txt1 = document.getElementById("un").value;
        var txt2 = document.getElementById("password-field").value;
        if(txt1 === '' || txt2 === ''){
          alert("All fields are required !");
          return false;
        }
        return true;
      }
    </script>

  </body>
  </html>

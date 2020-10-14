<?php
require_once "pdo.php";
if ( !isset($_POST['pass'])  || !isset($_POST['cnf_pass'])) {
  return;
}
if ($_POST['pass'] != $_POST['cnf_pass']){
  echo("Password not matched");
  return;
}
$password = htmlentities($_POST['pass']);
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row){
  if(password_verify($password, $row["password"])){
    echo ("Password not available");
    break;
  }
}
?>

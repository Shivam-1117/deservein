<?php
require_once "pdo.php";
if ( !isset($_POST['email']) ){
  return;
}
if ( strlen($_POST['email']) > 1){
  $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i";
  if(preg_match($pattern, $_POST['email']) == 0){
   echo "Invalid email";
 }
}
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row){
  if($row["email"] == $_POST['email']){
    echo ("Email already registered");
    break;
  }
}
?>

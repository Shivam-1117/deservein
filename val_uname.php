<?php
require_once "pdo.php";
if ( !isset($_POST['user_name']) ){
  return;
}
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row){
  if($row["user_name"] == $_POST['user_name']){
    echo ("Username not available");
    break;
  }
}
?>

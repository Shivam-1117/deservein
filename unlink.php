<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
header('Content-Type: application/json; charset=utf-8');
if(!isset($_POST['user_id'])){
  return;
}

$stmt = $pdo -> prepare("SELECT * FROM relationships WHERE user_id_2 = :xyz1 AND user_id_1 = :xyz AND connected = :cnd");
$stmt -> execute(array(":xyz1" => htmlentities($_SESSION['user_id']),
":xyz" => htmlentities($_POST['user_id']),
":cnd" => htmlentities('1')));
if($stmt -> rowCount() > 0){
  $stmt = $pdo -> prepare('DELETE FROM relationships WHERE user_id_1 = :uid1 AND user_id_2 = :uid2 AND connected = :cnd');
  $stmt -> execute(array(':uid1' => htmlentities($_POST['user_id']),
      ':cnd' => htmlentities('1'),
      ':uid2' => htmlentities($_SESSION['user_id'])));
      return;
}
else{
  $stmt = $pdo -> prepare('DELETE FROM relationships WHERE user_id_1 = :uid2 AND user_id_2 = :uid1 AND connected = :cnd');
  $stmt -> execute(array(':uid1' => htmlentities($_POST['user_id']),
      ':cnd' => htmlentities('1'),
      ':uid2' => htmlentities($_SESSION['user_id'])));
      return;
}

?>

<?php
session_start();
if ( ! isset($_SESSION['user_name']) ) {
  die("ACCESS DENIED");
}

require_once "pdo.php";

if ( ! isset($_GET['term']) ) {
  die("Missing the term");
}
header('Content-Type: application/json; charset=utf-8');
$stmt = $pdo->prepare('SELECT * FROM institution WHERE name LIKE :prefix');
$stmt->execute(array( ':prefix' => "%".$_GET['term']."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  $temp_array = array();
  $temp_array['value'] = $row['name'];
  $temp_array['img'] = $row['logo'];
  $temp_array['city'] = $row['city'];
  $temp_array['state'] = $row['state'];
  $temp_array['country'] = $row['country'];
  $temp_array['label'] = '<img src="logo/'.$row['logo'].'" width="30px" style = "position: relative; top: 10px;"/>&nbsp;&nbsp;&nbsp;'.$row['name'].', '.$row['city'].', '.$row['state'].', '.$row['country'].'';
  $retval[] = $temp_array;
}

echo(json_encode($retval));

?>

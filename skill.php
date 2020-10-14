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
$stmt = $pdo->prepare('SELECT * FROM skills_available WHERE industry LIKE :prefix OR tool LIKE :prefix OR other LIKE :prefix');
$stmt->execute(array( ':prefix' => "%".$_GET['term']."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  if($row['industry'] != "" || $row['industry'] != "NULL"){
    $retval[] = $row['industry'];
  }
  if($row['tool'] != "" || $row['tool'] != "NULL"){
    $retval[] = $row['tool'];
  }
  if($row['other'] != "" || $row['other'] != "NULL"){
    $retval[] = $row['other'];
  }
}

echo(json_encode($retval, JSON_PRETTY_PRINT));

?>

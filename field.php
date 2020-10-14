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
$stmt = $pdo->prepare('SELECT * FROM courses WHERE field LIKE :prefix');
$stmt->execute(array( ':prefix' => "%".$_GET['term']."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  $retval[] = $row['field'];
}

echo(json_encode($retval, JSON_PRETTY_PRINT));

?>

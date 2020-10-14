<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
header('Content-Type: application/json; charset=utf-8');
if(!isset($_POST['user_id'])){
  return;
}

$stmt = $pdo->prepare('INSERT INTO relationships (user_id_1, user_id_2, pending) VALUES ( :uid1, :uid2, :pnd)');
$stmt->execute(array(
    ':uid2' => htmlentities($_POST['user_id']),
    ':uid1' => htmlentities($_SESSION['user_id']),
    ':pnd' => htmlentities('1')));
?>

<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
header('Content-Type: application/json; charset=utf-8');
if(!isset($_POST['post_id'])){
  return;
}

$stmt = $pdo->prepare("SELECT * FROM post_stats WHERE post_id = :xyz AND user_name = :xyz1");
$stmt -> execute(array(":xyz" => $_POST['post_id'],
":xyz1" => $_SESSION['user_name']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt -> rowCount() == 0){
  $stmt = $pdo->prepare('INSERT INTO post_stats (post_id, user_name, liked) VALUES ( :pid, :un, :lkd)');
  $stmt->execute(array(
    ':pid' => htmlentities($_POST['post_id']),
    ':un' => htmlentities($_SESSION['user_name']),
    ':lkd' => htmlentities('1')));
    $second = "<img src = 'img/like.svg' width= '30px' height='30px' style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
  }
  else{
    if(htmlentities($row['liked']) === '0'){
      $stmt1 = $pdo->prepare('UPDATE post_stats SET liked = :lkd WHERE post_id = :pid AND user_name = :xyz1');
      $stmt1 -> execute(array(':pid' => htmlentities($_POST['post_id']),
      ':lkd' => htmlentities('1'),
      ":xyz1" => $_SESSION['user_name']));
      $second = "<img src = 'img/like.svg' width= '30px' height='30px' style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
    }
    else{
      $stmt1 = $pdo->prepare('UPDATE post_stats SET liked = :lkd WHERE post_id = :pid AND user_name = :xyz1');
      $stmt1 -> execute(array(':pid' => htmlentities($_POST['post_id']),
      ':lkd' => htmlentities('0'),
      ":xyz1" => $_SESSION['user_name']));
      $second = "<img src = 'img/like.svg' width= '30px' height='30px'/>Like";
    }
  }

  $stmt = $pdo -> prepare("SELECT Count(*) as count FROM comments WHERE post_id = :xyz");
  $stmt -> execute(array(":xyz" => $_POST['post_id']));
  $comments = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt = $pdo->prepare("SELECT Count(*) as count FROM post_stats WHERE post_id = :xyz AND liked = :lkd");
  $stmt -> execute(array(":xyz" => $_POST['post_id'],
  ":lkd" => htmlentities('1')));
  $likes = $stmt->fetch(PDO::FETCH_ASSOC);
  $first = "<p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'>".$likes['count']." Likes     ".$comments['count']." Comments</p>";
  $stuff = array('first' => $first, 'second' => $second);
  echo(json_encode($stuff));
  ?>

<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
header('Content-Type: application/json; charset=utf-8');
if(!isset($_POST['post_id']) || !isset($_POST['comment'])){
  return;
}
$date = date('Y-m-d H:i:s');
$stmt = $pdo->prepare('INSERT INTO comments (post_id, commented_by, commented_on, comment) VALUES ( :pid, :cby, :dt, :cm)');
$stmt->execute(array(
  ':pid' => htmlentities($_POST['post_id']),
  ':cby' => htmlentities($_SESSION['user_name']),
  ':dt' => htmlentities($date),
  ':cm' => htmlentities($_POST['comment']))
);
$stmt1 = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_name = :xyz");
$stmt1 -> execute(array(":xyz" => $_SESSION['user_name']));
$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows1 as $row1) {
  $name = $row1['first_name']." ".$row1['last_name'];
}

$stmt = $pdo->prepare("SELECT Count(*) as count FROM comments WHERE post_id = :xyz");
$stmt -> execute(array(":xyz" => $_POST['post_id']));
$comments = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT Count(*) as count FROM post_stats WHERE post_id = :xyz AND liked = :lkd");
$stmt -> execute(array(":xyz" => $_POST['post_id'],
":lkd" => htmlentities('1')));
$likes = $stmt->fetch(PDO::FETCH_ASSOC);
$first = "<p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'>".$likes['count']." Likes     ".$comments['count']." Comments</p>";
$second = "<table style = 'color: #000; width: 510px; text-align: left; margin-bottom: 0px; overflow-wrap: break-word; padding: 20px;'><tr>
<th style = 'float: left;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></th>
<th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
<th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($date, 0, 10)))."</th>
</tr><tr>
<td style = 'width: 392px; float: left; margin-left: 50px; padding: 10px; border: 0.1em solid; font-weight: 300;'>".nl2br($_POST['comment'], false)."</td>
</tr>
</table>";
$stuff = array('first' => $first, 'second' => $second);

$stmt = $pdo->prepare("SELECT Count(*) as count FROM post_stats WHERE post_id = :xyz AND user_name = :xyz1");
$stmt -> execute(array(":xyz" => $_POST['post_id'],
":xyz1" => $_SESSION['user_name']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(htmlentities($row['count'] == 0)){
  $stmt = $pdo->prepare('INSERT INTO post_stats (post_id, user_name, commented) VALUES ( :pid, :un, :cmt)');
  $stmt->execute(array(
    ':pid' => htmlentities($_POST['post_id']),
    ':un' => htmlentities($_SESSION['user_name']),
    ':cmt' => htmlentities(1))
  );
}
else{
  $stmt = $pdo->prepare('UPDATE post_stats SET commented = commented + 1 WHERE post_id = :pid');
  $stmt->execute(array(':pid' => htmlentities($_POST['post_id'])));
}
echo(json_encode($stuff));

?>

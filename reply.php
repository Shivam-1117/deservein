<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
header('Content-Type: application/json; charset=utf-8');
if(!isset($_POST['reply_id']) || !isset($_POST['reply'])){
  return;
}

$date = date('Y-m-d H:i:s');
$str = $_POST['reply_id'];
$pattern = "/[0-9]+/i";
preg_match_all($pattern, $str, $matches);
$post_id = $matches[0][0];
$comment_id = $matches[0][1];
$stmt = $pdo->prepare('INSERT INTO replies (post_id, comment_id, replied_by, replied_on, reply) VALUES ( :pid, :cid, :rby, :dt, :rpy)');
$stmt->execute(array(
  ':pid' => htmlentities($post_id),
  ':cid' => htmlentities($comment_id),
  ':rby' => htmlentities($_SESSION['user_name']),
  ':dt' => htmlentities($date),
  ':rpy' => htmlentities($_POST['reply']))
);

$stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_name = :xyz");
$stmt -> execute(array(":xyz" => $_SESSION['user_name']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $row['first_name']." ".$row['last_name'];

$second =  "<table style = 'color: #000; width: 400px; text-align: left; margin-bottom: 0px; overflow-wrap: break-word; padding: 20px;'><tr>
<th style = 'float: left;'><img src = 'img/pic.jpg' height='40px' width='40px' style='border-radius: 50%;'/></th>
<th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
<th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($date, 0, 10)))."</th>
</tr><tr>
<td style = 'width: 300px; float: left; margin-left: 50px; padding: 10px; border: 2px solid rgba(5, 60, 73, 0.7); font-weight: 300;'>".nl2br($_POST['reply'], false)."</td>
</tr>
</table>";
$first = "first";
$stuff = array('first' => $first, 'second' => $second);
echo(json_encode($stuff));

?>

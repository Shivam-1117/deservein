<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once 'pdo.php';
if(!isset($_POST['user_id'])){
  return;
}

$stmt = $pdo->prepare('UPDATE relationships SET pending = :pnd, connected = :cnd, follow = :flw WHERE user_id_1 = :uid1 AND user_id_2 = :uid2');
$stmt -> execute(array(':uid1' => htmlentities($_POST['user_id']),
    ':pnd' => htmlentities('0'),
    ':cnd' => htmlentities('1'),
    ':flw' => htmlentities('1'),
    ':uid2' => htmlentities($_SESSION['user_id'])));
    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
    $stmt2 -> execute(array(":xyz" => htmlentities($_POST['user_id'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    echo "<div id = 'links".$row2['user_id']."'>
    <table style='text-align: left;'><tr>
    <th style='width: 150px; padding: 10px;'><img src = 'img/pic.jpg' class = 'circle_img' height='150px' width='150px'/></th>
    <th style='padding-left: 100px; font-weight: 500;'><a style='color: #000;'>".$row2['first_name']." ".$row2['last_name']."</a><br>
    <a style='color: #000;'>IIT Dhanbad</a><br>
    <a style='color: #000;'>Software Enginner</a><br>
    <a style='color: #000;'>12 mutual<img src = 'img/link.svg'  height='40px' width='40px' style='position: relative; top: 15px;'/>
    </a></th>
    <th><a style='color: #000;' class = 'dots' id = 'dots".$row2['user_id']."'>
    <span class='dot'></span><span class='dot'></span><span class='dot'></span></a><br>
    <button class = 'remove_link' id = 'remove_link".$row2['user_id']."' style = 'padding: 0px; border: none; background: #fff; display: none;'>Remove</button>
    </th></tr></table><hr class = 'divider'></div>";
?>

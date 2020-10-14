<?php
require_once "pdo.php";

function suggestions(){
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name != :un");
  $stmt -> execute(array(":un" => htmlentities($_SESSION['user_name'])));
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $name = $row['first_name']." ".$row['last_name'];

    $stmt2 = $pdo -> prepare("SELECT * FROM relationships WHERE (user_id_1 = :xyz AND user_id_2 = :xyz1) OR (user_id_1 = :xyz1 AND user_id_2 = :xyz)");
    $stmt2 -> execute(array(":xyz1" => htmlentities($row['user_id']),
    ":xyz" => htmlentities($_SESSION['user_id'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if($stmt2 -> rowCount() == 0 || ($row2['pending'] == '0' && $row2['connected'] == '0')){
      echo "
      <div class = 'suggestions' id = 'suggestions".$row['user_id']."'>
      <table style='text-align: left;'><tr>
      <th style='width: 150px; padding: 10px;'><img src = 'img/pic.jpg' class = 'circle_img' height='150px' width='150px'/></th>
      <th><a>".$name."</a><br>
      <a>IIT Dhanbad</a><br>
      <a>Software Enginner</a><br>
      <a>12 mutual<img src = 'img/link.svg' height='40px' width='40px' style='position: relative; top: 15px; filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(174deg) brightness(102%) contrast(102%);'/>
      </a></th>
      <th style='width: 70px; font-weight: 300;'><a class = 'remove' id = 'remove".$row['user_id']."'>Remove</a></th>
      <th style='width: 125px;'><button class = 'connect' id = 'connect".$row['user_id']."' style='width: 92px; height: 32px; padding: 5px; border-width: 1px; border-radius: 10px; outline: none;'>Connect</button></th></tr></table>
      <br></div>";
    }
  }
}

function pending(){
  global $pdo;

  $stmt = $pdo -> prepare("SELECT * FROM relationships WHERE user_id_2 = :xyz1 AND pending = :pnd");
  $stmt -> execute(array(":xyz1" => htmlentities($_SESSION['user_id']),
  ":pnd" => htmlentities('1')));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
      $stmt2 -> execute(array(":xyz" => htmlentities($row['user_id_1'])));
      $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

      echo "
      <div class = 'pending' id = 'pending".$row['user_id_1']."'>
      <table style='text-align: left;'><tr>
      <th style='width: 50px; padding: 10px;'><img src = 'img/pic.jpg' class = 'circle_img' height='70px' width='70px'/></th>
      <th style='padding-top: 10px; padding-bottom: 10px;'><a>".$row2['first_name']." ".$row2['last_name']."</a><br>
      <a>IIT Dhanbad</a><br>
      <a>Software Enginner</a><br>
      <a>12 mutual<img src = 'img/link.svg' height='30px' width='30px' style='position: relative; top: 10px; filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(174deg) brightness(102%) contrast(102%);'/>
      </a></th>
      <th style='width: 70px;'><a class = 'cancel' id = 'cancel".$row['user_id_1']."'>Cancel</a></th>
      <th style='width: 125px;'><button class = 'accept' id = 'accept".$row['user_id_1']."' style='width: 92px; height: 32px; padding: 5px; border-width: 1px;'>Accept</button></th></tr></table><hr class = 'divider'>
      <br></div>
      ";
  }
}

function your_links(){
  global $pdo;

  $stmt = $pdo -> prepare("SELECT * FROM relationships WHERE (user_id_2 = :xyz1 OR user_id_1 = :xyz1) AND connected = :cnd");
  $stmt -> execute(array(":xyz1" => htmlentities($_SESSION['user_id']),
  ":cnd" => htmlentities('1')));
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['user_id_1'] == $_SESSION['user_id']){
    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
    $stmt2 -> execute(array(":xyz" => htmlentities($row['user_id_2'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  }
  else{
    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
    $stmt2 -> execute(array(":xyz" => htmlentities($row['user_id_1'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  }
    echo "
    <div id = 'links".$row2['user_id']."'>
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
    </th></tr></table><hr class = 'divider'></div>
    ";
  }
}

function following(){
  global $pdo;

  $stmt = $pdo -> prepare("SELECT * FROM relationships WHERE (user_id_2 = :xyz1 OR user_id_1 = :xyz1) AND follow = :flw");
  $stmt -> execute(array(":xyz1" => htmlentities($_SESSION['user_id']),
  ":flw" => htmlentities('1')));
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($row['user_id_1'] == $_SESSION['user_id']){
    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
    $stmt2 -> execute(array(":xyz" => htmlentities($row['user_id_2'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  }
  else{
    $stmt2 = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
    $stmt2 -> execute(array(":xyz" => htmlentities($row['user_id_1'])));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  }
    echo "
    <div id = 'following".$row2['user_id']."'>
    <table style='text-align: left;'><tr>
    <th style='width: 150px; padding: 10px;'><img src = 'img/pic.jpg' class = 'circle_img' height='150px' width='150px'/></th>
    <th style='padding-left: 100px; font-weight: 500;'><a style='color: #000;'>".$row2['first_name']." ".$row2['last_name']."</a><br>
    <a style='color: #000;'>IIT Dhanbad</a><br>
    <a style='color: #000;'>Software Enginner</a><br>
    <a style='color: #000;'>12 mutual<img src = 'img/link.svg'  height='40px' width='40px' style='position: relative; top: 15px;'/>
    </a></th>
    <th><a style='color: #000;' class = 'follow_dots' id = 'follow_dots".$row2['user_id']."'><span class='dot'></span><span class='dot'></span><span class='dot'></span></a><br>
    <button class = 'remove_link' id = 'unfollow".$row2['user_id']."' style = 'border: none; background: #fff; display: none; padding: 0px;'>Remove</button></th></tr></table>
    <hr class = 'divider'></div>
    ";
  }
}
?>

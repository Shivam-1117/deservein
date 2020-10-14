<?php
require_once "pdo.php";
function create_posts(){
  global $pdo;
  if(!empty($_FILES["image"]["name"]) || !empty($_FILES["video"]["name"]) || !empty($_FILES["doc"]["name"])){
    if(!empty($_FILES["image"]["name"])){
      $targetDir = "posts_media/images/";
      $fileName = basename($_FILES["image"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
      if($_POST['create_post'] != ""){
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo -> prepare('INSERT INTO posts (file_name, date_of_upload, user_name, content) VALUES ( :fn, :dou, :un, :cn)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']),
            ':cn' => htmlentities($_POST['create_post']))
          );
          header("Location: feed.php");
          return;
        }
      }
      else{
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo -> prepare('INSERT INTO posts (file_name, date_of_upload, user_name) VALUES ( :fn, :dou, :un)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']))
          );
          header("Location: feed.php");
          return;
        }
      }
    }

    if(!empty($_FILES["video"]["name"])){
      $targetDir = "posts_media/videos/";
      $fileName = basename($_FILES["video"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
      if($_POST['create_post'] != ""){
        if(move_uploaded_file($_FILES["video"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo->prepare('INSERT INTO posts (file_name, date_of_upload, user_name, content) VALUES ( :fn, :dou, :un, :cn)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']),
            ':cn' => htmlentities($_POST['create_post']))
          );
          header("Location: feed.php");
          return;
        }
      }
      else{
        if(move_uploaded_file($_FILES["video"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo->prepare('INSERT INTO posts (file_name, date_of_upload, user_name) VALUES ( :fn, :dou, :un)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']))
          );
          header("Location: feed.php");
          return;
        }
      }
    }

    if(!empty($_FILES["doc"]["name"])){
      $targetDir = "posts_media/documents/";
      $fileName = basename($_FILES["doc"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
      if($_POST['create_post'] != ""){
        if(move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo->prepare('INSERT INTO posts (file_name, date_of_upload, user_name, content) VALUES ( :fn, :dou, :un, :cn)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']),
            ':cn' => htmlentities($_POST['create_post']))
          );
          header("Location: feed.php");
          return;
        }
      }
      else{
        if(move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
          $stmt = $pdo->prepare('INSERT INTO posts (file_name, date_of_upload, user_name) VALUES ( :fn, :dou, :un)');
          $stmt->execute(array(
            ':fn' => htmlentities($fileName),
            ':dou' => htmlentities(date('Y-m-d H:i:s')),
            ':un' => htmlentities($_SESSION['user_name']))
          );
          header("Location: feed.php");
          return;
        }
      }
    }
  }
  else{
    $stmt = $pdo->prepare('INSERT INTO posts (date_of_upload, user_name, content) VALUES ( :dou, :un, :cn)');
    $stmt->execute(array(
      ':dou' => htmlentities(date('Y-m-d H:i:s')),
      ':un' => htmlentities($_SESSION['user_name']),
      ':cn' => htmlentities($_POST['create_post']))
    );
    header("Location: feed.php");
    return;
  }
}

function feed_posts(){
  global $pdo;
  $stmt = $pdo->query("SELECT * FROM posts ORDER BY date_of_upload DESC");
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
    $stmt1 = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_name = :xyz");
    $stmt1 -> execute(array(":xyz" => $row["user_name"]));
    $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows1 as $row1) {
      $name = $row1['first_name']." ".$row1['last_name'];
    }

    $stmt2 = $pdo->prepare("SELECT * FROM comments, users WHERE post_id = :abc AND comments.commented_by = users.user_name ORDER BY commented_on DESC");
    $stmt2 -> execute(array(":abc" => $row["post_id"]));
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $stmt3 = $pdo->prepare("SELECT Count(*) as count FROM comments WHERE post_id = :xyz");
    $stmt3 -> execute(array(":xyz" => $row['post_id']));
    $comments = $stmt3->fetch(PDO::FETCH_ASSOC);
    $stmt4 = $pdo->prepare("SELECT Count(*) as count FROM post_stats WHERE post_id = :xyz AND liked = :lkd");
    $stmt4 -> execute(array(":xyz" => $row['post_id'],
    ":lkd" => htmlentities('1')));
    $likes = $stmt4->fetch(PDO::FETCH_ASSOC);

    $stmt5 = $pdo->prepare("SELECT Count(*) as count FROM post_stats WHERE post_id = :xyz AND liked = :lkd AND user_name = :un");
    $stmt5 -> execute(array(":xyz" => $row['post_id'],
    ":lkd" => htmlentities('1'),
    ":un" => htmlentities($_SESSION['user_name'])));
    $liked_before = $stmt5->fetch(PDO::FETCH_ASSOC);

    if(!is_null($row['file_name'])){
      $ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
      if(in_array($ext, array('jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp', 'ico', 'cur', 'gif', 'bmp', 'apng', 'png', 'svg', 'tif', 'tiff', 'webp', 'svgz', 'xbm', 'dib', 'avif'))){
        echo
        "<div class = 'posts'>
        <div style='display: inline-block; padding-left: 20px;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></div>
        <div style='display: inline-block; padding-left: 10px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad<br>posted on "
        . date('d-m-Y', strtotime(substr($row['date_of_upload'], 0, 10)))."</p></div><br><hr class = 'divider'>";

        content_div($row['post_id'], $row['content'], true);

        echo "<div class ='content_media'><img src = 'posts_media/images/".$row['file_name']."' width='100%'/></div><br>
        <div class = 'posts_stats' id = 'posts_stats".$row['post_id']."'><p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'>".$likes['count']." Likes     ".$comments['count']." Comments</p>
        </div><br><hr class = 'divider'>
        <div class = 'reaction'>
        <table style='width: 200px;'>
        <tr>
        <th><a id = 'like".$row['post_id']."' class = 'like' style='text-decoration: none; cursor: pointer; padding-left: 10px;'>";
        if($liked_before['count'] == 0){
          echo "<img src = 'img/like.svg' width= '30px' height='30px'/>Like";
        }
        else{
          echo "<img src = 'img/like.svg' width= '30px' height='30px'
          style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
        }
        echo "</a></th>
        <th><a id = 'comment".$row['post_id']."' class = 'comment'><img src = 'img/comment.svg' width= '25px' height='25px'/>Comment</a></th>
        <th><a id = 'share".$row['post_id']."' class = 'share'><img src = 'img/Share-02.svg' width= '30px' height='30px'/>Share</a></th>
        </tr>
        </table></div><br>
        <div style='display: inline-block; overflow: hidden;'>";
        comment_div($row['post_id']);
            echo "</div></div><br>";
        }
        else if(in_array($ext, array('xlsx', 'xls', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'pdf'))){
          echo
          "<div class = 'posts'>
          <div style='display: inline-block; padding-left: 20px;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></div>
          <div style='display: inline-block; padding-left: 10px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad<br>posted on "
          . date('d-m-Y', strtotime(substr($row['date_of_upload'], 0, 10)))."</p></div><br><hr class = 'divider'>";

          content_div($row['post_id'], $row['content'], true);

          echo "<div class ='content_media'><iframe src = 'posts_media/documents/".$row['file_name']."' width='500px' height = '500px;'></iframe></div><br>
          <div class = 'posts_stats' id = 'posts_stats".$row['post_id']."'><p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'> ".$likes['count']." Likes     ".$comments['count']." Comments</p>
          </div><br><hr class = 'divider'>
          <div class = 'reaction'>
          <table style='width: 200px;'>
          <tr>
          <th><a id = 'like".$row['post_id']."' class = 'like' style='text-decoration: none; cursor: pointer; padding-left: 10px;'>";
          if($liked_before['count'] == 0){
            echo "<img src = 'img/like.svg' width= '30px' height='30px'/>Like";
          }
          else{
            echo "<img src = 'img/like.svg' width= '30px' height='30px'
            style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
          }
          echo "</a></th>
          <th><a id = 'comment".$row['post_id']."' class = 'comment'><img src = 'img/comment.svg' width= '25px' height='25px'/>Comment</a></th>
          <th><a id = 'share".$row['post_id']."' class = 'share'><img src = 'img/Share-02.svg' width= '30px' height='30px'/>Share</a></th>
          </tr>
          </table></div><br>
          <div style='display: inline-block; overflow: hidden;'>";
          comment_div($row['post_id']);
              echo "</div></div><br>";
            }
            else{
              echo
              "<div class = 'posts'>
              <div style='display: inline-block; padding-left: 20px;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></div>
              <div style='display: inline-block; padding-left: 10px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad<br>posted on "
              . date('d-m-Y', strtotime(substr($row['date_of_upload'], 0, 10)))."</p></div><br><hr class = 'divider'>";

              content_div($row['post_id'], $row['content'], true);

              echo "<div class ='content_media'><video controls autoplay muted style = 'width: 500px;'><source src = 'posts_media/videos/".$row['file_name']."'/></video></div><br>
              <div class = 'posts_stats' id = 'posts_stats".$row['post_id']."'><p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'> ".$likes['count']." Likes     ".$comments['count']." Comments</p>
              </div><br><hr class = 'divider'>
              <div class = 'reaction'>
              <table style='width: 200px;'>
              <tr>
              <th><a id = 'like".$row['post_id']."' class = 'like' style='text-decoration: none; cursor: pointer; padding-left: 10px;'>";
              if($liked_before['count'] == 0){
                echo "<img src = 'img/like.svg' width= '30px' height='30px'/>Like";
              }
              else{
                echo "<img src = 'img/like.svg' width= '30px' height='30px'
                style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
              }
              echo "</a></th>
              <th><a id = 'comment".$row['post_id']."' class = 'comment'><img src = 'img/comment.svg' width= '25px' height='25px'/>Comment</a></th>
              <th><a id = 'share".$row['post_id']."' class = 'share'><img src = 'img/Share-02.svg' width= '30px' height='30px'/>Share</a></th>
              </tr>
              </table></div><br>
              <div style='display: inline-block; overflow: hidden;'>";
              comment_div($row['post_id']);
                  echo "</div></div><br>";
                }
              }
              else{
                echo
                "<div class = 'posts'>
                <div style='display: inline-block; padding-left: 20px;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></div>
                <div style='display: inline-block; padding-left: 10px;'>".$name."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad<br>posted on "
                . date('d-m-Y', strtotime(substr($row['date_of_upload'], 0, 10)))."</p></div><br><hr class = 'divider'>";

                content_div($row['post_id'], $row['content'], false);

                echo "<div class = 'posts_stats' id = 'posts_stats".$row['post_id']."'><p style = 'padding-left: 10px; margin: 0px; font-weight: 400;'> ".$likes['count']." Likes     ".$comments['count']." Comments</p></div><br><hr class = 'divider'>
                <div class = 'reaction'>
                <table style='width: 200px; text-align: left; '>
                <tr>
                <th><a id = 'like".$row['post_id']."' class = 'like' style='text-decoration: none; cursor: pointer; padding-left: 10px;'>";
                if($liked_before['count'] == 0){
                  echo "<img src = 'img/like.svg' width= '30px' height='30px'/>Like";
                }
                else{
                  echo "<img src = 'img/like.svg' width= '30px' height='30px'
                  style = 'filter: invert(49%) sepia(81%) saturate(3174%) hue-rotate(174deg) brightness(98%) contrast(92%);'/>Like";
                }
                echo "</a></th>
                <th><a id = 'comment".$row['post_id']."' class = 'comment'><img src = 'img/comment.svg' width= '25px' height='25px'/>Comment</a></th>
                <th><a id = 'share".$row['post_id']."' class = 'share'><img src = 'img/Share-02.svg' width= '30px' height='30px'/>Share</a></th>
                </tr>
                </table></div><br>
                <div style='display: inline-block; overflow: hidden;'>";

                comment_div($row['post_id']);

                echo "</div></div><br>";
                  }
                }
              }


          function content_div($row, $content, $media){
            $array_of_content = explode('<br>', nl2br($content, false));

            if(!$media){
              if (count($array_of_content) <= 10){
                echo "<div class = 'content' style = 'padding-bottom: 20px;'>".join('<br>', $array_of_content)."</div><br>";
              }
              else{
                echo "<div class = 'content'>".join('<br>', array_slice($array_of_content, 0, 10))."<br><span class='dots'id = 'dots"
                .$row."'>...</span><span class='more' id = 'more".$row."' style='display: none;'>"
                .join('<br>', array_slice(explode('<br>', nl2br($content, false)), 10))."</span><br>
                <a class='myBtn' id = 'myBtn".$row."'style='text-decoration: none; font-size: 13px; cursor: pointer; float: right; font-weight: 100; color: #000;'>Show more</a></div><br>";
              }
            }
            else{
              if (count($array_of_content) <= 4){
                echo "<div class = 'content'>".join('<br>', $array_of_content)."</div><br>";
            }
              else{
                echo "<div class = 'content'>".join('<br>', array_slice($array_of_content, 0, 4))."<br><span class='dots'id = 'dots"
                .$row."'>...</span><span class='more' id = 'more".$row."' style='display: none;'>"
                .join('<br>', array_slice(explode('<br>', nl2br($content, false)), 4))."</span><br>
                <a class='myBtn' id = 'myBtn".$row."'style='text-decoration: none; font-size: 13px; cursor: pointer; float: right; font-weight: 100; color: #000;'>Show more</a></div><br>";
              }
            }
          }

          function comment_div($row){

            global $pdo;

            echo "<div class = 'comment_div' id = 'comment_div".$row."'>
            <form method= 'post' class = 'comment_box' id = 'comment_box".$row."'><table><tr>
            <th><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></th>
            <th><textarea placeholder= 'Add a Comment' id = 'text".$row."' cols = '30' maxlength = '250' wrap: 'hard'></textarea></th></tr></table>
            <button type = 'reset' id = 'post".$row."'>Post</button>
            </form><div id = 'recent_comment".$row."'></div>";

            $stmt2 = $pdo->prepare("SELECT * FROM comments, users WHERE post_id = :abc AND comments.commented_by = users.user_name ORDER BY comment_id DESC LIMIT 1");
            $stmt2 -> execute(array(":abc" => $row));
            $rows2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            if($stmt2 -> rowCount() > 0){

              echo "<table style = 'color: #000; width: 510px; text-align: left; margin-bottom: 0px; overflow-wrap: break-word; padding: 20px;'><tr>
              <th style = 'float: left;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></th>
              <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$rows2['first_name']." ".$rows2['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
              <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($rows2['commented_on'], 0, 10)))."</th>
              </tr><tr>
              <td style = 'width: 392px; float: left; margin-left: 50px; padding: 10px;  font-weight: 300;'>".nl2br($rows2['comment'], false)."</td>
              </tr><tr><td  style = 'border: none; padding-left: 75px;'><a class = 'reply' id = 'reply".$row."cid".$rows2['comment_id']."' style = 'cursor: pointer;'><img src = 'img/reply.svg' height='20px' width='20px'/></a></td></tr>
              </table>";

              echo "<div class = 'reply_div' id = 'reply_div".$row."cid".$rows2['comment_id']."' style = 'display: none; float: right; width: 400px; padding-right: 30px;'>
              <form method= 'post' class = 'reply_box' id = 'reply_box".$row."cid".$rows2['comment_id']."' style = 'width: 390px;'><table style = 'width: 400px;'><tr>
              <th><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></th>
              <th><textarea placeholder= 'Add a reply' id = 'text".$row."cid".$rows2['comment_id']."' cols = '30' maxlength = '250' wrap: 'hard' style = 'width: 324px; height: 44px;'></textarea></th></tr></table>
              <button type = 'reset' id = 'post".$row."cid".$rows2['comment_id']."' style = 'margin-right: 15px;'>Post</button>
              </form><div id = 'recent_reply".$row."cid".$rows2['comment_id']."'></div>";

              $stmt3 = $pdo->prepare("SELECT * FROM replies, users WHERE comment_id = :abc AND replies.replied_by = users.user_name ORDER BY reply_id DESC LIMIT 1");
              $stmt3 -> execute(array(":abc" => $rows2["comment_id"]));
              $rows3 = $stmt3->fetch(PDO::FETCH_ASSOC);

              if($stmt3 -> rowCount() > 0){
                echo "<table style = 'color: #000; width: 390px; text-align: left; float: right; margin-bottom: 0px; overflow-wrap: break-word; padding-top: 10px;'><tr>
                <th style = 'float: left;'><img src = 'img/pic.jpg' height='40px' width='40px' style='border-radius: 50%;'/></th>
                <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$rows3['first_name']." ".$rows3['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
                <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($rows3['replied_on'], 0, 10)))."</th>
                </tr><tr>
                <td style = 'width: 300px; float: left; margin-left: 50px; padding: 10px; border: 2px solid rgba(5, 60, 73, 0.7); font-weight: 300;'>".nl2br($rows3['reply'], false)."</td>
                </tr>
                </table>";

                $stmt3 = $pdo->prepare("SELECT * FROM replies, users WHERE comment_id = :abc AND replies.replied_by = users.user_name ORDER BY reply_id DESC LIMIT 18446744073709551615 OFFSET 1");
                $stmt3 -> execute(array(":abc" => $rows2["comment_id"]));
                $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                if($stmt3 -> rowCount() > 0){
                  echo "<span class = 'load_reply' id = 'load_reply".$row."cid".$rows2['comment_id']."'></span><span class='load_more_reply' id = 'load_more_reply".$row."cid".$rows2['comment_id']."' style='display: none;'>";
                  foreach ($rows3 as $row3) {
                    echo "<table style = 'color: #000; width: 390px; text-align: left; float: right; margin-bottom: 0px; overflow-wrap: break-word; padding-top: 10px;'><tr>
                    <th style = 'float: left;'><img src = 'img/pic.jpg' height='40px' width='40px' style='border-radius: 50%;'/></th>
                    <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$row3['first_name']." ".$row3['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
                    <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($row3['replied_on'], 0, 10)))."</th>
                    </tr><tr>
                    <td style = 'width: 300px; float: left; margin-left: 50px; padding: 10px; border: 2px solid rgba(5, 60, 73, 0.7); font-weight: 300;'>".nl2br($row3['reply'], false)."</td>
                    </tr>
                    </table>";
                  }
                  echo "</span><a class='myBtn2' id = 'myBtn2".$row."cid".$rows2['comment_id']."'style='padding-bottom: 20px; text-decoration: none; font-size: 13px; cursor: pointer; float: right; font-weight: 100; color: #000;'>Load more replies...</a></div>";
                }
                else{
                  echo "</div>";
                }
              }
              else{
                echo "</div>";
              }

              $stmt2 = $pdo->prepare("SELECT * FROM comments, users WHERE post_id = :abc AND comments.commented_by = users.user_name ORDER BY comment_id DESC
                LIMIT 18446744073709551615 OFFSET 1");
                $stmt2 -> execute(array(":abc" => $row));
                $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if($stmt2 -> rowCount() > 0){
                  echo "<span class = 'load' id = 'load".$row."'></span><span class='load_more' id = 'load_more".$row."' style='display: none;'>";
                  foreach ($rows2 as $row2) {
                    echo "<table style = 'color: #000; width: 510px; text-align: left; margin-bottom: 0px; overflow-wrap: break-word; padding: 20px;'><tr>
                    <th style = 'float: left;'><img src = 'img/pic.jpg' class = 'circle_img' height='50px' width='50px' style='border-radius: 50%;'/></th>
                    <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$row2['first_name']." ".$row2['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
                    <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($row2['commented_on'], 0, 10)))."</th>
                    </tr><tr>
                    <td style = 'width: 392px; float: left; margin-left: 50px; padding: 10px; font-weight: 300;'>".nl2br($row2['comment'], false)."</td>
                    </tr>
                    <tr><td  style = 'border: none; padding-left: 75px;'><a class = 'reply' id = 'reply".$row."cid".$row2['comment_id']."' style = 'cursor: pointer;'><img src = 'img/reply.svg' height='20px' width='20px'/></a></td></tr>
                    </table>";

                    echo "<div class = 'reply_div' id = 'reply_div".$row."cid".$row2['comment_id']."' style = 'display: none; width: 400px; float: right; padding-right: 30px;'>
                    <form method= 'post' class = 'reply_box' id = 'reply_box".$row."cid".$row2['comment_id']."' style = 'width: 390px;'><table style = 'width: 400px;'><tr>
                    <th><img src = 'img/pic.jpg' class = 'circle_img' height='40px' width='40px' style='border-radius: 50%;'/></th>
                    <th><textarea placeholder= 'Add a reply' id = 'text".$row."cid".$row2['comment_id']."' cols = '30' maxlength = '250' wrap: 'hard' style = 'width: 324px; height: 44px;'></textarea></th></tr></table>
                    <button type = 'reset' id = 'post".$row."cid".$row2['comment_id']."' style = 'margin-right: 15px;'>Post</button>
                    </form><div id = 'recent_reply".$row."cid".$row2['comment_id']."'></div>";

                    $stmt3 = $pdo->prepare("SELECT * FROM replies, users WHERE comment_id = :abc AND replies.replied_by = users.user_name ORDER BY reply_id DESC LIMIT 1");
                    $stmt3 -> execute(array(":abc" => $row2["comment_id"]));
                    $rows3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                    if($stmt3 -> rowCount() > 0){
                      echo "<table style = 'color: #000; width: 390px; text-align: left; float: right; margin-bottom: 0px; overflow-wrap: break-word; padding-top: 10px;'><tr>
                      <th style = 'float: left;'><img src = 'img/pic.jpg' height='40px' width='40px' style='border-radius: 50%;'/></th>
                      <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$rows3['first_name']." ".$rows3['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
                      <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($rows3['replied_on'], 0, 10)))."</th>
                      </tr><tr>
                      <td style = 'width: 300px; float: left; margin-left: 50px; padding: 10px; border: 2px solid rgba(5, 60, 73, 0.7); font-weight: 300;'>".nl2br($rows3['reply'], false)."</td>
                      </tr>
                      </table>";

                      $stmt3 = $pdo->prepare("SELECT * FROM replies, users WHERE comment_id = :abc AND replies.replied_by = users.user_name ORDER BY reply_id DESC LIMIT 18446744073709551615 OFFSET 1");
                      $stmt3 -> execute(array(":abc" => $row2["comment_id"]));
                      $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                      if($stmt3 -> rowCount() > 0){
                        echo "<span class = 'load_reply' id = 'load_reply".$row."cid".$row2['comment_id']."'></span><span class='load_more_reply' id = 'load_more_reply".$row."cid".$row2['comment_id']."' style='display: none;'>";
                        foreach ($rows3 as $row3) {
                          echo "<table style = 'color: #000; width: 390px; text-align: left; float: right; margin-bottom: 0px; overflow-wrap: break-word; padding-top: 10px;'><tr>
                          <th style = 'float: left;'><img src = 'img/pic.jpg' height='40px' width='40px' style='border-radius: 50%;'/></th>
                          <th style = 'padding-left: 10px; float: left; font-weight: 500; font-size: 16px;'>".$row3['first_name']." ".$row3['last_name']."<p style = 'font-weight: 100; margin: 0px; font-size: 13px;'>IIT Dhanbad</p></th>
                          <th style = 'float: right; font-weight: 100; font-size: 13px;'>on ".date('d-m-Y', strtotime(substr($row3['replied_on'], 0, 10)))."</th>
                          </tr><tr>
                          <td style = 'width: 300px; float: left; margin-left: 50px; padding: 10px; border: 2px solid rgba(5, 60, 73, 0.7); font-weight: 300;'>".nl2br($row3['reply'], false)."</td>
                          </tr>
                          </table>";
                        }
                        echo "</span><a class='myBtn2' id = 'myBtn2".$row."cid".$row2['comment_id']."'style='padding-bottom: 20px; text-decoration: none; font-size: 13px; cursor: pointer; float: right; font-weight: 100; color: #000;'>Load more replies...</a></div>";
                      }
                      else{
                        echo "</div>";
                      }
                    }
                    else{
                      echo "</div>";
                    }
                  }
                  echo "</span><a class='myBtn1' id = 'myBtn1".$row."'style='padding-bottom: 20px; text-decoration: none; font-size: 13px; cursor: pointer; float: right; font-weight: 100; color: #000;'>Load more comments...</a>";
                }
              }
              echo "</div>";
          }

        ?>

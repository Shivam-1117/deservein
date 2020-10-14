<?php
session_start();
if ( ! isset($_SESSION['user_name']) ) {
  die(header("Location: login.php"));
}
require_once "pdo.php";
include_once "util_link.php";
date_default_timezone_set("Asia/Kolkata");
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href = "linkstyle.css" rel = "stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet"/>
</head>
<body>
  <div class = "container1">
    <h1><img src = "img/logo2.svg" alt = "logo" width= "60px" height="60px" class="logo"/></h1>
    <form method="post" class = "search"><input type="text" name="user_email" placeholder= "Search" class = "box" id = "search"/></form>
    <div id = "top">
      <ul>
        <li><a href = "feed.php"><img src = "img/home.svg" alt = "logo" width= "30px" height="30px" class = "nav_img"/><br>Home</a></li>
        <li style = "width: 200px; padding: 0px; top: -5px;"><a><img src = "img/course_company.svg" alt = "logo" width= "35px" height="35px" class = "nav_img"/><br>Courses to Company</a></li>
        <li><a><img src = "img/noti.svg" alt = "logo" width= "30px" height="30px" class = "nav_img"/><br>Notifications</a></li>
        <li style="top:-5px;"><a><img src = "img/jobs.svg" alt = "logo" width= "35px" height="35px" class = "nav_img" style="position: relative; top: 3px;"/><br>Jobs</a></li>
        <li><a><img src = 'img/pic.jpg' height='38px' width='38px' class = "me"/><br>Shivam</a>
          <ul>
            <li><a href = "myprofile.php">My Profile</a><hr class = "rounded"></li>
            <li><a href="logout.php">Sign Out</a></li>
          </ul></li>
        </ul>
      </div>
    </div><br>
    <div class = 'container'>
      <div id = "links_stats">
        <ul>
          <li style="height: 110px;"><a id = 'links' style="font-size: 16px;"><img src = 'img/user-network.svg' height='60px' width='60px' class = "links_stats_img" style='top: 20px;'/><br>Links 2020</a></li>
          <li style="height: 80px;"><a id = 'follow' style="font-size: 16px;"><img src = 'img/follow.svg' height='30px' width='30px' class = "links_stats_img"/><br>Following</a></li>
          <li style="height: 100px;"><a style="font-size: 16px;"><img src = 'img/pages.svg' height='50px' width='50px' class = "links_stats_img"/><br>Pages</a></li>
          <li style="height: 100px;"><a style="font-size: 16px;"><img src = 'img/hashtag-sign.svg' height='30px' width='30px' class = "links_stats_img"/><br>HashTags</a></li>
        </ul>
        <ul id = "premium" style="height: 140px;"><li style="height: 140px;"><a style = 'font-size: 30px; color: #fff; text-shadow: 1px 1px 2px #badbd7;'><img src = 'img/premium.svg' height='60px' width='60px'
          style='position: relative; top: 20px;
          filter: invert(69%) sepia(74%) saturate(424%) hue-rotate(3deg) brightness(91%) contrast(86%) drop-shadow(1px 1px 0px #badbd7);'/><br>Premium</a></li></ul>
          <div id = "side_navbar">
            <ul>
              <li><a href = "feed.php"><img src = "img/home.svg" alt = "logo" width= "30px" height="30px" class = "side_navbar_img"/></a></li>
              <li style = "padding: 0px; top: -5px;"><a><img src = "img/course_company.svg" alt = "logo" width= "35px" height="35px" class="side_navbar_img"/></a></li>
              <li><a><img src = "img/noti.svg" alt = "logo" width= "30px" height="30px" class="side_navbar_img"/></a></li>
              <li><a><img src = "img/jobs.svg" alt = "logo" width= "35px" height="35px" class="side_navbar_img" style="position: relative; top: 3px;"/></a></li>
              <li><a href = "myprofile.php"><img src = 'img/pic.jpg' height='38px' width='38px' class="me"/></a>
              </li>
              <li><a href="logout.php"><img src = "img/logout.svg" alt = "logo" width= "35px" height="35px" class="side_navbar_img" style="position: relative; top: 3px;"/></a></li>
            </ul>
          </div>
        </div>
        <div style="display: inline-block; float: right; width: 800px; padding-left: 0px;">
          <div style="display: inline-block; overflow: hidden;">
            <div id = "pending">
              <?= pending(); ?>
            </div>
          </div><br>
          <div id = "suggestions_block">
            <hr class = "divider" style="margin-left: 0px; width : 700px;">
            <p style="margin-left: 0px; font-size: 30px; font-weight: 300; margin-top: 30px;">Suggestions for you</p><br>
            <?= suggestions(); ?>
          </div>
          <img src = "img/feed_image.svg" id = "feed_image" width= "400px" height="400px" style="cursor: pointer; position: absolute; top: 200px; left: 1100px; float: right;"/>
        </div>
      </div>
      <div id = "dialog">
        <div style="display: inline-block; overflow: hidden; margin-left: 400px; margin-top: 30px;">
          <div id = "your_links">
            <form method="post" class = "search_links"><input type="text" name="user_email" placeholder= "Search" class = "box" id = "search"/></form><hr class = "divider">
            <?= your_links(); ?>
            <br></div>
          </div>
        </div>
        <div id = "dialog2">
          <div style="display: inline-block; overflow: hidden; margin-left: 400px; margin-top: 30px;">
            <div id = "following">
              <form method="post" class = "search_links"><input type="text" name="user_email" placeholder= "Search" class = "box" id = "search"/></form><hr class = "divider">
              <?= following(); ?>
              <br></div>
            </div>
          </div>

          <script type="text/javascript" src="jquery.min.js"></script>
          <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

          <script>

          $(window).scroll(function(e){
            var $el = $('#premium');
            var $el1 = $('#feed_image');
            var $el3 = $('#side_navbar');
            var isPositionFixed3 = ($el3.css('position') == 'fixed');
            var isPositionFixed = ($el.css('position') == 'fixed');
            var isPositionFixed1 = ($el1.css('position') == 'fixed');
            if ($(this).scrollTop() > 520 && !isPositionFixed3){
              $el3.fadeIn(50, function(){
                $(this).css({'display': 'inline-block', 'position': 'fixed', 'top': '180px'});
              });
            }
            if ($(this).scrollTop() <= 520 && isPositionFixed3){
              $el3.fadeOut(100, function(){
                $(this).css({'display': 'none', 'position': 'absolute', 'top': '650px'});
              });
            }
            if ($(this).scrollTop() > 200 && !isPositionFixed1){
              $el1.css({'position': 'fixed', 'top': '30px'});
            }
            if ($(this).scrollTop() <= 200 && isPositionFixed1){
              $el1.css({'position': 'absolute', 'top': '200px'});
            }
            if ($(this).scrollTop() > 520 && !isPositionFixed){
              $el.css({'position': 'fixed', 'top': '0px'});
            }
            if ($(this).scrollTop() <= 520 && isPositionFixed){
              $el.css({'position': 'relative', 'top': '0px'});
            }
          });

          $(".connect").click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(7);
            $.post( 'send_request.php', { 'user_id': user_id },
            function(){
            });


            $('#suggestions' + user_id).fadeOut(500, function(){
              $(this).remove();
            });

          });

          $(".accept").click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(6);
            $.post( 'accept_request.php', { 'user_id': user_id },
            function(data){
              $('#your_links').append(data);
              $('#following').append(data);
            });
            $('#pending' + user_id).fadeOut(500, function(){
              $(this).remove();
            });
          });

          if($.trim($("#pending").val()) == ""){
            $('#pending').append("<p style = 'font-style: italic; font-weight: lighter; margin: 0px;'>No Pending Invitations</p>");
          }

          $('.dots').click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(4);
            var btn = document.getElementById("remove_link" + user_id);
            if(btn.style.display == "block"){
              btn.style.display = "none";
            }
            else{
              btn.style.display = "block";
            }
          });

          $('.remove_link').click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(11);
            $.post( 'unlink.php', { 'user_id': user_id },
            function(){
            });
            $('#links' + user_id).fadeOut(500, function(){
              $(this).remove();
            });
            $('#following' + user_id).fadeOut(500, function(){
              $(this).remove();
            });
          });

          $('.follow_dots').click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(11);
            var btn = document.getElementById("unfollow" + user_id);
            if(btn.style.display == "block"){
              btn.style.display = "none";
            }
            else{
              btn.style.display = "block";
            }
          });

          $('.unfollow').click(function(){
            var btnid = this.id;
            var user_id = btnid.substring(8);
            $.post( 'unlink.php', { 'user_id': user_id },
            function(){
            });
            $('#links' + user_id).fadeOut(500, function(){
              $(this).remove();
            });
            $('#following' + user_id).fadeOut(500, function(){
              $(this).remove();
            });
          });

          var modal = document.getElementById("dialog");
          var btn = document.getElementById("links");
          btn.onclick = function() {
            modal.style.display = "block";
          }

          var modal2 = document.getElementById("dialog2");
          var btn2 = document.getElementById("follow");
          btn2.onclick = function() {
            modal2.style.display = "block";
          }
          window.onclick = function(event) {
            if (event.target == modal || event.target == modal2) {
              modal.style.display = "none";
              modal2.style.display = "none";
            }
          }
          </script>

        </body>
        </html>

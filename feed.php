<?php
session_start();
if ( ! isset($_SESSION['user_name']) ) {
  die(header("Location: login.php"));
}
require_once "pdo.php";
include_once "util.php";
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST["post"])){
  create_posts();
}
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href = "feedstyle.css" rel = "stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400&display=swap" rel="stylesheet"/>
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
    </div>
    <div class = "container2">
      <div id = "news">
        <h2 style="font-family: 'Noto Sans JP', sans-serif; font-size: 25px; font-weight: 500;">News feeds</h2>
        <ul id = "news_feed">
        </ul>
      </div>
      <img src = "img/feed_image.svg" id = "feed_image" width= "400px" height="400px"/>
      <div id = "about">
        <h2 style="font-size: 25px; font-weight: 500;"><a>About us</a></h2>
        <table><tr>
          <th><a>Privacy and terms</a></th>
          <th><a>Services</a></th>
        </tr>
        <tr>
          <td><a>Help Center</a></td>
          <td><a>Goincite Co-operation@2020</a></td>
        </tr>
      </table>
    </div>
    <div id = "status">
      <form method="post"><input type="text" name = "thoughts" size = "23" placeholder="Share your thoughts here" class = "stats" id = "stats1"/>
        <table><tr>
          <th><label for = "img"><img src = "img/image.png" width= "30px" height="30px" class="status_img"/></label></th>
          <th><label for = "vdo"><img src = "img/video.svg" width= "40px" height="40px" class="status_img"/></label></th>
          <th><label for = "file"><img src = "img/file.svg" width= "40px" height="40px" class="status_img"/></label></th>
          <input id = "img" type = "file"  accept="image/*" style="display: none;"/>
          <input id = "vdo"  type = "file" accept="video/*" style="display: none;"/>
          <input id = "file" type = "file" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .txt,.pdf" style="display: none;"/>
        </tr></table></form>
      </div>
      <div style="display: inline-block;">
        <?php feed_posts(); ?>
        <p style = "text-align: center;">@2020 Goincite.com</p>
      </div>
      <div id = "right">
        <ul>
          <li><a href = "links.php"><img src = 'img/user-network.svg' height='60px' width='60px' class = "right_img"/><br>My Links</a></li>
          <li><a><img src = 'img/pages.svg' height='50px' width='50px' style='position: relative; top: 20px; filter: drop-shadow(2px 2px 2px rgba(5, 60, 73, 0.7));'/><br>Pages</a></li>
          <li><a><img src = 'img/groups.svg' height='50px' width='50px' class="right_img"/><br>Groups</a></li>
          <li><a><img src = 'img/hashtag-sign.svg' height='30px' width='30px' style='position: relative; top: 15px; filter: drop-shadow(2px 2px 2px rgba(5, 60, 73, 0.7));'/><br>HashTags</a></li>
        </ul>
      </div><br>
      <div id = "right2">
        <ul>
          <li><a><img src = 'img/events.svg' height='50px' width='50px' class = "right_img"/><br>Events</a></li>
          <li><a><img src = 'img/meetup.svg' height='50px' width='50px' style='position: relative; top: 20px; filter: drop-shadow(2px 2px 2px rgba(5, 60, 73, 0.7));'/><br>Meetups</a></li>
          <li><a><img src = 'img/premium.svg' height='50px' width='50px' style='position: relative; top: 20px;
          filter: invert(69%) sepia(74%) saturate(424%) hue-rotate(3deg) brightness(91%) contrast(86%) drop-shadow(0px 1px 1px rgba(5, 60, 73, 0.7));'/><br>Premium</a>
        </li>
      </ul>
    </div>
    <div id = "dialog">
      <div id = "status1">
        <table><tr><th style="color: #000;">Write post</th></tr></table>
        <form method="post" enctype="multipart/form-data"><textarea name="create_post" wrap = "hard" id = "create_post1" rows="20" cols="60" maxlength = '250'></textarea>
          <table style="border-top-left-radius: 0em; border-top-right-radius: 0em; border-bottom-left-radius: 0.3em; border-bottom-right-radius: 0.3em;"><tr>
            <th><label for = "img1"><img src = "img/image.png" width= "30px" height="30px" style="cursor: pointer;"/></label></th>
            <th><label for = "vdo1"><img src = "img/video.svg" width= "40px" height="40px" style="cursor: pointer;"/></label></th>
            <th><label for = "file1"><img src = "img/file.svg" width= "40px" height="40px" style="cursor: pointer;"/></label></th>
            <th style="padding-right: 10px;"><input type="submit" name = "post" id = "post1" value="Post" class="button" style="float: right; cursor: pointer;" disabled="disabled"/></th>
            <input id = "img1" type = "file" name = "image" accept="image/*" style="display: none;" />
            <input id = "vdo1" type = "file" name = "video" accept="video/*" style="display: none;"/>
            <input id = "file1" type = "file" name = "doc" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .txt,.pdf" style="display: none;"/>
            <div id = "file_preview">
            </div>
          </tr></table></form>
        </div>
      </div><br>
    </div>
    <div class="container3">
      <div id = "promotions">
        <h2 style="font-size: 25px; font-weight: 500;"><a>Promotions</a></h2>
        <table><tr>
          <th><a>Udacity</a></th>
          <th><a>MBA</a></th>
          <th><a>Linkedin</a></th>
        </tr></table>
      </div>
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

    <script type="text/javascript" src="jquery.min.js">
    </script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script type="text/javascript">
    $(window).scroll(function(e){
      var $el = $('#about');
      var $el1 = $('#promotions');
      var $el2 = $('#feed_image');
      var $el3 = $('#side_navbar');
      var isPositionFixed = ($el.css('position') == 'fixed');
      var isPositionFixed1 = ($el1.css('position') == 'fixed');
      var isPositionFixed2 = ($el2.css('position') == 'fixed');
      var isPositionFixed3 = ($el3.css('position') == 'fixed');
      if ($(this).scrollTop() > 910 && !isPositionFixed3){
        $el3.fadeIn(50, function(){
          $(this).css({'display': 'inline-block', 'position': 'fixed', 'top': '150px'});
        });
      }
      if ($(this).scrollTop() <= 910 && isPositionFixed3){
        $el3.fadeOut(100, function(){
          $(this).css({'display': 'none', 'position': 'absolute', 'top': '1250px'});
        });
      }
      if ($(this).scrollTop() > 460 && !isPositionFixed2){
        $el2.css({'position': 'fixed', 'top': '50px'});
      }
      if ($(this).scrollTop() <= 460 && isPositionFixed2){
        $el2.css({'position': 'absolute', 'top': '460px'});
      }
      if ($(this).scrollTop() > 460 && !isPositionFixed){
        $el.css({'position': 'fixed', 'top': '470px'});
      }
      if ($(this).scrollTop() <= 460 && isPositionFixed){
        $el.css({'position': 'absolute', 'top': '880px'});
      }
      if ($(this).scrollTop() > 910 && !isPositionFixed1){
        $el1.css({'position': 'fixed', 'top': '50px'});
      }
      if ($(this).scrollTop() <= 910 && isPositionFixed1){
        $el1.css({'position': 'absolute', 'top': '950px'});
      }
    });


    $(".myBtn").click (function(){
      var btnid = this.id;
      var post_id = btnid.substring(5);
      var dots = document.getElementById("dots" + post_id);
      var more = document.getElementById("more" + post_id);
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        $("#"+btnid).html("Show more");
        more.style.display = "none";
      } else {
        dots.style.display = "none";
        $("#"+btnid).html("Show less");
        more.style.display = "inline";
      }
    });

    $(".myBtn1").click (function(){
      var btnid = this.id;
      var post_id = btnid.substring(6);
      var dots = document.getElementById("load" + post_id);
      var more = document.getElementById("load_more" + post_id);
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        $("#"+btnid).html("Load more comments...");
        more.style.display = "none";
      } else {
        dots.style.display = "none";
        $("#"+btnid).html("");
        more.style.display = "inline";
      }
    });

    $(".myBtn2").click (function(){
      var btnid = this.id;
      var reply_id = btnid.substring(6);
      var dots = document.getElementById("load_reply" + reply_id);
      var more = document.getElementById("load_more_reply" + reply_id);
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        $("#"+btnid).html("Load more replies...");
        more.style.display = "none";
      } else {
        dots.style.display = "none";
        $("#"+btnid).html("");
        more.style.display = "inline";
      }
    });

    $(".like").click(function(){
      var btnid = this.id;
      var post_id = btnid.substring(4);
      window.console && console.log('Sending POST for like');
      $.post( 'like.php', { 'post_id': post_id },
      function(data){
        window.console && console.log(data);
        $('#posts_stats' + post_id).empty().append(data.first);
        $('#like' + post_id).empty().append(data.second);
      });
    });

    $(".comment").click(function(){
      var btnid = this.id;
      var post_id = btnid.substring(7);
      var cmt_div = document.getElementById("comment_div" + post_id);
      var post_btn = document.getElementById("post" + post_id);
      cmt_div.style.display = "block";

      $("#text"+post_id).on( 'input', function(){
        $(this).height( 'auto' ).height( this.scrollHeight );
        if($.trim($("#text"+post_id).val()) != ""){
          post_btn.style.display = "inline-block";
        }
        else{
          post_btn.style.display = "none";
        }
      });

      $("#post" + post_id).click(function(event) {
        var txt = $("#text"+post_id).val();
        $.post( 'comment.php', { 'post_id': post_id, 'comment': txt },
        function(data){
          $('#posts_stats' + post_id).empty().append(data.first);
          $('#recent_comment' + post_id).prepend(data.second);
          post_btn.style.display = "none";
        }
      );
    });

  });


  $(".reply").click(function(){
    var btnid = this.id;
    var reply_id = btnid.substring(5);
    var rpy_div = document.getElementById("reply_div" + reply_id);
    var post_btn = document.getElementById("post" + reply_id);
    rpy_div.style.display = "block";

    $("#text"+reply_id).on( 'input', function(){
      $(this).height( 'auto' ).height( this.scrollHeight );
      if($.trim($("#text"+reply_id).val()) != ""){
        post_btn.style.display = "inline-block";
      }
      else{
        post_btn.style.display = "none";
      }
    });

    $("#post" + reply_id).click(function(event) {
      var txt = $("#text"+reply_id).val();
      $.post( 'reply.php', { 'reply_id': reply_id, 'reply': txt },
      function(data){
        $('#recent_reply' + reply_id).prepend(data.second);
        post_btn.style.display = "none";
      }
    );
  });

});

var modal = document.getElementById("dialog");
var btn = document.getElementById("stats1");
btn.onclick = function() {
  modal.style.display = "block";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var btnSubmit = document.getElementById("post1");
function display_img(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(event) {
      $('#myid').attr('src', event.target.result)
      .width(555);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#img1").change(function() {
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $("#file_preview").append("<img id = 'myid' style='border:none; outline: none;'/>");
  display_img(this);
  btnSubmit.disabled = false;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  $("#close").click(function(){
    $('#myid').remove();
    $('#close').remove();
    $("#img1").val('');
    btnSubmit.disabled = true;
  });
});

$("#img").change(function() {
  modal.style.display = "block";
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $("#file_preview").append("<img id = 'myid' style='border:none; outline: none;'/>");
  display_img(this);
  btnSubmit.disabled = false;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  var file1 = document.querySelector('#img');
  var file2 = document.querySelector('#img1');
  file2.files = file1.files;
  $("#close").click(function(){
    $('#myid').remove();
    $('#close').remove();
    $("#img1").val('');
    $("#img").val('');
    btnSubmit.disabled = true;
  });
});


$ ("#vdo1").change(function () {
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $("#file_preview").append("<video controls class='video' style='display: none;' width= '555px''></video >");
  var fileInput = document.getElementById('vdo1');
  var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
  $(".video").attr("src", fileUrl);
  $(".video").show();
  btnSubmit.disabled = false;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  $("#close").click(function(){
    $('.video').remove();
    $('#close').remove();
    $("#vdo1").val('');
    btnSubmit.disabled = true;
  });
});

$ ("#vdo").change(function () {
  modal.style.display = "block";
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $("#file_preview").append("<video controls class='video' style='display: none;' width='555px''></video >");
  var fileInput = document.getElementById('vdo');
  var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
  $(".video").attr("src", fileUrl);
  $(".video").show();
  btnSubmit.disabled = false;
  var file1 = document.querySelector('#vdo');
  var file2 = document.querySelector('#vdo1');
  file2.files = file1.files;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  $("#close").click(function(){
    $('.video').remove();
    $('#close').remove();
    $("#vdo").val('');
    $("#vdo1").val('');
    btnSubmit.disabled = true;
  });
});

$('#file1').change(function (event) {
  var file = URL.createObjectURL(event.target.files[0]);
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $('#file_preview').append('<a id = "document" href="' + file + '" target="_blank"><img src="img/google-docs.svg" width = 30px height = 30px style = "padding-right: 10px;"/>' + event.target.files[0].name + '</a>');
  btnSubmit.disabled = false;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  $("#close").click(function(){
    $('#document').remove();
    $('#close').remove();
    $("#file1").val('');
    btnSubmit.disabled = true;
  });
});

$('#file').change(function (event) {
  modal.style.display = "block";
  var file = URL.createObjectURL(event.target.files[0]);
  $("#file_preview").empty().append("<span id='close'>&times;</span>");
  $('#file_preview').append('<a id = "document" href="' + file + '" target="_blank"><img src="img/google-docs.svg" width = 30px height = 30px style = "padding-right: 10px;"/>' + event.target.files[0].name + '</a>');
  btnSubmit.disabled = false;
  var file2 = document.querySelector('#file');
  var file3 = document.querySelector('#file1');
  file3.files = file2.files;
  var cross = document.getElementById("close");
  cross.style.display = "block";
  $("#close").click(function(){
    $('#document').remove();
    $('#close').remove();
    $("#file").val('');
    $("#file1").val('');
    btnSubmit.disabled = true;
  });
});

$("#create_post1").on( 'input', function(){
  var btnSubmit = document.getElementById("post1");
  if($.trim($("#create_post1").val()) != ""){
    btnSubmit.disabled = false;
  }
  else{
    btnSubmit.disabled = true;
  }
});


/**function EnableDisable() {
  var btnSubmit = document.getElementById("post1");
  var create_post1 = document.getElementById("create_post1");
  if (create_post1.value.trim() != "" || $("#file_preview").html() != "") {
    btnSubmit.disabled = false;
  } else {
    btnSubmit.disabled = true;
  }
}**/

/**$(document).ready( function () {
var i;
$.getJSON('newsfeed.php', function(data) {
window.console && console.log(data);
for (i = 0; i < data.articleCount; i++){
var x = document.createElement("LI");
var a = document.createElement('a');
a.setAttribute('href',data.articles[i].url);
a.innerHTML = data.articles[i].title;
x.appendChild(a);
document.getElementById("news_feed").appendChild(x);
}
})
}
);
**/

</script>
</body>
</html>

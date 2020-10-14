<?php
session_start();
if ( ! isset($_SESSION['user_name']) ) {
  die(header("Location: login.php"));
}
require_once "pdo.php";
date_default_timezone_set("Asia/Kolkata");
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href = "profilestyle.css" rel = "stylesheet"/>
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

    <div id = "intro">
      <div id = "cover">
        <img src = 'img/pic.jpg' class = 'circle_img' height='150px' width='150px'/>
      </div>
      <ul id = "intro_left">
        <li style="font-size: 30px;">Shivam Mishra</li>
        <li style="font-size: 20px;">Software Engineer at Amazon</li>
        <li style="font-weight: 100;">Currently in Lucknow, Uttar Pradesh, India</li>
      </ul>
      <ul id = "intro_right">
        <li><a><img src = "img/amazon.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 5px; padding-right: 10px;"/> Amazon</a></li>
        <li style="padding-top: 5px;" ><a><img src = "img/iitdhanbad.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 5px; padding-right: 10px;"/> IIT Dhanbad</a></li>
        <li>
          <ul>
            <li><a>500+ Links</a></li>
            <li><a>Contact Info</a></li>
          </ul></li>
        </ul>
      </div>
      <div id = "about">
        <h1>About</h1><br>
        <p style="display: inline-block;">Software Engineer at Amazon</p>
      </div>
      <div id = "experience_education">
        <div id = "experience" style="display: inline-block;">
          <h1>Experience</h1>
          <p><ul>
            <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Software Engineer</li>
            <li style="padding-left: 80px; font-weight: 500;">Amazon</li>
            <li style="padding-left: 80px; font-weight: 100;">July 2020 - Present</li>
          </ul></p>
        </div>
        <hr class="divider" style="width: 85%;"><br>
        <div style="display: inline-block; overflow: hidden;">
          <h1 class="edu" style="display: block; width: 400px;">Education</h1>
          <div id = "education">
            <ul>
              <li><img src = "img/iitdhanbad.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Indian Institute of technology, Dhanbad</li>
              <li style="padding-left: 80px; font-weight: 100;">Master's Degree, Mathematics and Computing</li>
              <li style="padding-left: 80px; font-weight: 100;">2019-2021</li>
            </ul><hr class="divider" style="width: 50%;">
            <ul>
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Banaras Hindu University, Varanasi</li>
              <li style="padding-left: 80px; font-weight: 100;">Bachelor's Degree, Mathematics/Statistics/Physics, 8.17 CGPA</li>
              <li style="padding-left: 80px; font-weight: 100;">2016-2019</li>
            </ul><hr class="divider" style="width: 50%;">
            <ul>
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Saraswati Vidya Mandir Senior Secondary School, Aliganj, Sector Q, Lucknow</li>
              <li style="padding-left: 80px; font-weight: 100;">Intermediate, Science, 86.20%</li>
              <li style="padding-left: 80px; font-weight: 100;">2014-2016</li>
            </ul><hr class="divider" style="width: 50%;">
            <ul>
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>New Way Senior Secondary School, Aliganj, Sector K, Lucknow</li>
              <li style="padding-left: 80px; font-weight: 100;">High School, 9.0 CGPA</li>
              <li style="padding-left: 80px; font-weight: 100;">2012-2014</li>
            </ul>
          </div>
        </div>
      </div><br>
      <div id = "licenses">
        <div style="display: inline-block; overflow: hidden;">
          <h1>Licenses &amp Certifications</h1>
          <div id = "licenses_in">
            <ul style="list-style: none; display: inline-block; margin: 0px;">
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Web Applications for Everybody Specialization</li>
              <li style="padding-left: 80px; font-weight: 100;">Coursera</li>
              <li style="padding-left: 80px; font-weight: 100;">Issued Aug 2020 - No Expiration Date</li>
              <li style="padding-left: 80px; font-weight: 100;">Credential ID ABCHDXGJ1</li>
              <li style="padding-left: 80px; font-weight: 100;"><a>See Credential</a></li>
            </ul><br>
            <ul style="list-style: none; display: inline-block; margin: 0px;">
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Data Science: Foundations using R Specialization</li>
              <li style="padding-left: 80px; font-weight: 100;">Coursera</li>
              <li style="padding-left: 80px; font-weight: 100;">Issued Aug 2020 - No Expiration Date</li>
              <li style="padding-left: 80px; font-weight: 100;">Credential ID XBNBDXGJ1</li>
              <li style="padding-left: 80px; font-weight: 100;"><a>See Credential</a></li>
            </ul><br>
            <ul style="list-style: none; display: inline-block; margin: 0px;">
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Deep Learning Specialization</li>
              <li style="padding-left: 80px; font-weight: 100;">Coursera</li>
              <li style="padding-left: 80px; font-weight: 100;">Issued Jun 2020 - No Expiration Date</li>
              <li style="padding-left: 80px; font-weight: 100;">Credential ID BDKJDXGJ1</li>
              <li style="padding-left: 80px; font-weight: 100;"><a>See Credential</a></li>
            </ul><br>
            <ul style="list-style: none; display: inline-block; margin: 0px;">
              <li><img src = "img/amazon.png" alt = "logo" width= "60px" height="60px" style="padding-right: 20px;position: relative;top: 40px;"/>Python Certificate</li>
              <li style="padding-left: 80px; font-weight: 100;">HackerRank</li>
              <li style="padding-left: 80px; font-weight: 100;">Issued Jul 2020 - No Expiration Date</li>
              <li style="padding-left: 80px; font-weight: 100;"><a>See Credential</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div id = "skills" style="display: inline-block; border: 1px solid;">
        <h1>Skills &amp Endorsements</h1>
      </div>

      <script type="text/javascript" src="jquery.min.js">
      </script>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>
    </html>

<?php
session_start();
if ( ! isset($_SESSION['user_name']) ) {
  die(header("Location: login.php"));
}
require_once "pdo.php";
require_once "util_profile.php";

date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['title']) && isset($_POST['company']) && isset($_POST['city'])
 && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['start_month'])
  && isset($_POST['start_year']) && isset($_POST['headline'])){
  add_experience();
}

if(isset($_POST['school'])){
  add_education();
}

if(isset($_POST['name']) && isset($_POST['organization'])){
  add_licenses();
}

if(isset($_POST['skill'])){
  add_skill();
}

?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href = "profilestyle.css" rel = "stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400&display=swap" rel="stylesheet"/>
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
    <div class = "profile_section">
      <ul>
        <li><a href="#about">About</a></li>
        <li><a href="#experience">Experience</a></li>
        <li><a href="#education">Education</a></li>
        <li><a href="#licenses">Certifications</a></li>
        <li><a href="#skills">Skills</a></li>
      </ul>
    </div>

    <div id = "intro">
      <div id = "cover">
        <img src = 'img/pic.jpg' class = 'circle_img' height='150px' width='150px'/>
      </div>
      <ul id = "intro_left">
        <li style="font-size: 30px;">Shivam Mishra</li>
        <li style="font-size: 20px;">Software Engineer at Amazon</li>
        <li style="font-weight: 100; font-size: 15px; ">Currently in Lucknow, Uttar Pradesh, India</li>
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
      <img src = "img/feed_image.svg" id = "feed_image" width= "400px" height="400px" style="cursor: pointer; position: absolute; top: 140px; left: 1100px; float: right;"/><br>
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
      <div id = "about">
        <h1>About<a style="margin:0px; float: right;"><img src = "img/edit1.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 20px; right: 40px;"/></a></h1><br>
        <p>Software Engineer at Amazon</p>
      </div>
      <div id = "experience_education">
        <?php load_exprience();?>
          <hr class="divider" style="width: 85%;"><br>
          <?php load_education();?>
        </div><br>
        <div id = "licenses">
          <h1>Certifications <a class = "add" id = "2" style="margin:0px; float: right;">&#43;</a></h1>
          <img src = "img/certifications.png" alt = "logo" width= "200px" height="200px" style="filter: invert(15%) sepia(69%) saturate(1190%) hue-rotate(157deg) brightness(95%) contrast(96%) drop-shadow(5px 5px 5px #badbd7); position: relative; top: -50px; left: 20px;"/>
          <?php load_certifications();?>
        </div>
        <div id = "skills">
          <h1>Skills &amp Endorsements <a class = "add" id = "3" style="margin:0px; float: right;">&#43;</a>
            <a style="margin:0px; float: right;"><img src = "img/edit1.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 15px; right: 50px;"/></a></h1>
            <img src = "img/skills1.png" alt = "logo" width= "300px" height="400px" style="filter: drop-shadow(2px 2px 2px #badbd7); position: relative; top: 50px; left: 50px;"/>
            <?php load_skills();?>
            </div>

            <div class = "dialog">
              <div class="dialog_in_1">
                <div class = "dialog_in_2">
                  <h2>Add Experience</h2>
                  <hr class="divider" style="width: 100%; margin: 0px;">
                </div>
                <div class="dialog_in_3" id = "add_experience">
                  <form id = "exp_form" method="post" enctype="multipart/form-data" style="padding: 20px; margin-bottom: 0px;">
                    <table>
                      <tr><th align = "left">Title &#42;</th></tr>
                      <tr><td><input type="text" name="title" size="73" id = "title" class="box1"/></td></tr>
                    </table>
                    <div id = "exp_res_1"></div>
                    <table>
                      <tr><th align = "left">Employment type</th></tr>
                      <tr><td><select class="box1" id = "emp_type">
                          <option>-</option>
                          <option>Full-time</option>
                          <option>Part-time</option>
                          <option>Self-employed</option>
                          <option>Freelance</option>
                          <option>Internship</option>
                          <option>Trainee</option>
                        </select></td></tr>
                      </table>
                      <table>
                        <tr><th align = "left">Company Name &#42;</th></tr>
                        <tr><td><input type="text" name="company" size="73" id = "company" class="box1"/></td></tr>
                      </table>
                      <div id = "exp_res_2"></div>
                      <table><tr><th align = "left">City &#42;</th><th align = "left">State &#42;</th><th align = "left">Country &#42;</th></tr>
                        <tr><td><input type="text" name="city0" size="20" id = "city0" class="box3"/></td>
                          <td><input type="text" name="state0" size="20" id = "state0" class="box3"/></td>
                          <td><input type="text" name="country0" size="20" id = "country0" class="box3" style="width: 185px;"/></td>
                        </tr>
                      </table>
                      <div id = "res_20" style="float: left; display:inline-block;"></div>
                      <div id = "res_30" style="display: inline-block; margin-left: 33px; position: relative; left: 152px;"></div>
                      <div id = "res_40" style="float: right; display:inline-block; margin-right: 10px;"></div>
                      <p style="color: #000; font-size: 13px; font-weight: 400;"><input type="checkbox" id = "still_working" onclick="toggleEndDate()"/>Presently working in this role</p>
                      <table>
                        <tr><th align = "left">Start Date &#42;</th> <th align = "left">End Date &#42;</th></tr>
                        <tr><td><select name = "start_month" class="box4" id ="start_date_month0">
                          <option>Month</option>
                          <?php
                          $m = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July',
                          8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                          $i = 1;
                          while ( $i < 13){
                            echo '<option>';
                            echo $m[$i];
                            echo '</option>';
                            $i = $i + 1;
                          }
                          ?>
                        </select>
                        <select name = "start_year" class="box4" id ="start_date_year0">
                          <option>Year</option>
                          <?php
                          $i = substr(date('Y-m-d H:i:s'), 0, 4);
                          $year = (int)$i;
                          while ( $year >= 1950){
                            echo '<option>';
                            echo $year;
                            echo '</option>';
                            $year = $year - 1;
                          }
                          ?>
                        </select>
                      </td>
                      <td id = "end_date0">
                        <select name = "end_month" class="box4" id = "end_date_month0">
                          <option>Month</option>
                          <?php
                          $m = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July',
                          8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                          $i = 1;
                          while ( $i < 13){
                            echo '<option>';
                            echo $m[$i];
                            echo '</option>';
                            $i = $i + 1;
                          }
                          ?>
                        </select>
                        <select name = "end_year" class="box4" id = "end_date_year0" style="width: 137px;">
                          <option>Year</option>
                          <?php
                          $i = substr(date('Y-m-d H:i:s'), 0, 4);
                          $year = (int)$i;
                          while ( $year >= 1950){
                            echo '<option>';
                            echo $year;
                            echo '</option>';
                            $year = $year - 1;
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                  </table>
                  <div id = "exp_res_3" style="float: left;"></div><div id = "exp_res_4" style="float: right;"></div>
                  <table>
                    <tr><th align = "left">Headline &#42;</th></tr>
                    <tr>
                      <td><input type="text" name="headline" size="73" id = "headline" class="box1"/></td>
                    </tr>
                  </table>
                  <div id = "exp_res_5"></div>
                </form>
              </div>
              <div style="background: #f7faf8; display: inline-block; margin-left: 0px; width: 602px; border-bottom-left-radius: 0.3em; border-bottom-right-radius: 0.3em;">
                  <p style="float: right; margin: 0px; padding: 10px;">
                    <button type="reset" name = "save" id = "exp_save" class="button" style="float: right; cursor: pointer;"
                       disabled="disabled" form = "exp_form" onclick="!this.form && document.getElementById('exp_form').reset()">Save</button></p>
              </div>
            </div>
          </div>
          <div class = "dialog">
            <div class="dialog_in_1">
              <div class = "dialog_in_2">
                <h2>Add Education</h2>
                <hr class="divider" style="width: 100%; margin: 0px;">
              </div>
              <div class="dialog_in_3" id = "add_education">
                <form method="post" enctype="multipart/form-data" id = "add_edu_form" style="padding: 20px; margin-bottom: 0px;">
                  <table><tr><th align = "left">Institute Name &#42;</th></tr>
                    <tr>
                      <td><input type="text" name="school" size="73" value = "" id = "school" class="box1" style="padding-left: 40px;"/></td>
                    </tr>
                  </table>
                  <div id = "edu_res_1"></div>
                  <table><tr><th align = "left">City &#42;</th><th align = "left">State &#42;</th><th align = "left">Country &#42;</th></tr>
                    <tr>
                      <td><input type="text" name="city1" size="20" id = "city1" class="box3"/></td>
                      <td><input type="text" name="state1" size="20" id = "state1" class="box3"/></td>
                      <td><input type="text" name="country1" size="20" id = "country1" class="box3" style="width: 185px;"/></td>
                    </tr>
                  </table><div id = "res_21" style="float: left; display:inline-block;"></div>
                  <div id = "res_31" style="display: inline-block; margin-left: 33px; position: relative; left: 152px;"></div>
                  <div id = "res_41" style="float: right; display:inline-block; margin-right: 10px;"></div>
                  <table><tr><th align = "left">Degree</th></tr>
                    <tr>
                      <td><input type="text" name="degree" size="73" id = "degree" class="box1"/></td>
                    </tr>
                  </table>
                  <table><tr><th align = "left">Field of Study</th></tr>
                    <tr>
                      <td><input type="text" name="field" size="73" id = "field" class="box1"/></td>
                    </tr>
                  </table>
                  <table><tr><th align = "left">Start Year</th> <th align = "left">End Year</th></tr>
                    <tr>
                      <td>
                        <select id = "edu_start_year" class="box2">
                          <option>Year</option>
                          <?php
                          $i = substr(date('Y-m-d H:i:s'), 0, 4);
                          $year = (int)$i;
                          while ( $year >= 1950){
                            echo '<option>';
                            echo $year;
                            echo '</option>';
                            $year = $year - 1;
                          }
                          ?>
                        </select>
                      </td>
                      <td>
                        <select id = "edu_end_year" class="box2">
                          <option>Year</option>
                          <?php
                          $i = substr(date('Y-m-d H:i:s'), 0, 4);
                          $year = (int)$i + 7;
                          while ( $year >= 1950){
                            echo '<option>';
                            echo $year;
                            echo '</option>';
                            $year = $year - 1;
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                  </table>
                  <table style="color: #000;"><tr><th align = "left">Grade</th></tr>
                    <tr>
                      <td><input type="text" name="grade" size="73" id = "grade" class="box1"/></td>
                    </tr>
                  </table>
                </form>
              </div>
              <div style="background: #f7faf8; display: inline-block; margin-left: 0px; width: 602px; border-bottom-left-radius: 0.3em; border-bottom-right-radius: 0.3em;">
                <p style="float: right; margin: 0px; padding: 10px;"><button type="reset" name = "save" id = "save" class="button" style="float: right; cursor: pointer;"
                   disabled="disabled" form = "add_edu_form" onclick="!this.form && document.getElementById('add_edu_form').reset()">
                Save</button></p>
              </div>
            </div>
          </div>
          <div class = "dialog">
            <div class="dialog_in_1">
              <div class = "dialog_in_2">
                <h2>Add Certifications</h2>
                <hr class="divider" style="width: 100%; margin: 0px;">
              </div>
              <div class="dialog_in_3" id = "add_licenses">
                <form id = "lic_form" method="post" enctype="multipart/form-data" style="padding: 20px; margin-bottom: 0px;">
                  <table><tr><th align = "left">Name &#42;</th></tr>
                    <tr>
                      <td><input type="text" name="lic_name" size="73" id = "lic_name" class="box1"/></td>
                    </tr>
                  </table>
                  <div id = "lic_res_1"></div>
                  <table><tr><th align = "left">Issuing Organization &#42;</th></tr>
                    <tr>
                      <td><input type="text" name="organization" size="73" id = "organization" class="box1"/></td>
                    </tr>
                  </table>
                  <div id = "lic_res_2"></div>
                  <p style="color: #000; font-size: 13px; font-weight: 400;"><input id = "no_expire" type="checkbox" onclick="toggleEndDate()"/>This Credential will not expire</p>
                  <table><tr><th align = "left">Issue Date</th> <th align = "left">Expiration Date</th></tr>
                    <tr>
                      <td><select name = "month0" class="box4" id = "start_date_month2">
                        <option>Month</option>
                        <?php
                        $m = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July',
                        8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                        $i = 1;
                        while ( $i < 13){
                          echo '<option>';
                          echo $m[$i];
                          echo '</option>';
                          $i = $i + 1;
                        }
                        ?>
                      </select>
                      <select name = "year0" class="box4" id = "start_date_year2">
                        <option>Year</option>
                        <?php
                        $i = substr(date('Y-m-d H:i:s'), 0, 4);
                        $year = (int)$i;
                        while ( $year >= 1950){
                          echo '<option>';
                          echo $year;
                          echo '</option>';
                          $year = $year - 1;
                        }
                        ?>
                      </select>
                    </td>
                    <td id = "end_date2">
                      <select name = "month0" class="box4" id = "end_date_month2">
                        <option>Month</option>
                        <?php
                        $m = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July',
                        8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                        $i = 1;
                        while ( $i < 13){
                          echo '<option>';
                          echo $m[$i];
                          echo '</option>';
                          $i = $i + 1;
                        }
                        ?>
                      </select>
                      <select name = "year0" class="box4" id = "end_date_year2" style="width: 137px;">
                        <option>Year</option>
                        <?php
                        $i = substr(date('Y-m-d H:i:s'), 0, 4);
                        $year = (int)$i;
                        while ( $year >= 1950){
                          echo '<option>';
                          echo $year;
                          echo '</option>';
                          $year = $year - 1;
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                </table>
                <table style="color: #000;"><tr><th align = "left">Credential URL</th></tr>
                  <tr>
                    <td><input type="text" name="cred_url" size="73" id = "cred_url" class="box1"/></td>
                  </tr>
                </table>
              </form>
            </div>
            <div style="background: #f7faf8; display: inline-block; margin-left: 0px; width: 602px; border-bottom-left-radius: 0.3em; border-bottom-right-radius: 0.3em;">
              <p style="float: right; margin: 0px; padding: 10px;"><button type="reset" name = "lic_save" id = "lic_save" class="button" style="float: right; cursor: pointer;"
                 disabled="disabled" form = "lic_form" onclick="!this.form && document.getElementById('lic_form').reset()">
              Save</button></p>
            </div>
          </div>
        </div>

        <div class = "dialog">
          <div class="dialog_in_1">
            <div class = "dialog_in_2" style="width: 603px;">
              <h2>Add New Skills</h2>
              <hr class="divider" style="width: 100%; margin: 0px;">
            </div>
            <div class="dialog_in_3" id = "add_skills" style="height: 400px;">
              <form id = "skill_form" method="post" enctype="multipart/form-data" style="padding: 20px; margin-bottom: 0px; width: 561px;">
                <table><tr><th align = "left">Skill &#42;</th><th></th></tr>
                  <tr>
                    <td><input type="text" placeholder = "Search Skill" name="skills" size="73" id = "skill_name" class="box1" style="width: 489px;"/></td>
                    <td><button type="reset" name = "skill_add" id = "skill_add" class="button_side" style="float: right; cursor: pointer;"
                       disabled="disabled">Add</button></td>
                  </tr>
                </table>
            </form>
            <div id = "selected_skills" style="display: inline-block; padding-left: 20px; padding-right: 20px;"></div>
          </div>
          <hr class="divider" style="width: 100%; margin: 0px;">
          <div style="background: #f7faf8; display: inline-block; margin-left: 0px; width: 603px; border-bottom-left-radius: 0.3em; border-bottom-right-radius: 0.3em;">
            <p style="float: right; margin: 0px; padding: 10px;"><button type="reset" name = "skill_save" id = "skill_save" class="button" style="float: right; cursor: pointer;"
               disabled="disabled" form = "skill_form" onclick="!this.form && document.getElementById('skill_form').reset()">
            Save</button></p>
          </div>
        </div>
      </div>

        <script type="text/javascript" src="jquery.min.js">
        </script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function(){

        $('#school').autocomplete({
        source: "institute.php",
        appendTo: '#add_education',
        minLength: 1,
        select: function(event, ui)
        {
          var btnSubmit = document.getElementById("save");
          $('#school').val(ui.item.value);
          $("#school").css("background-image", "url(logo/" + ui.item.img + ")");
          $('#city1').val(ui.item.city);
          $('#state1').val(ui.item.state);
          $('#country1').val(ui.item.country);
          btnSubmit.disabled = false;
          $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
        }
      }).data('ui-autocomplete')._renderItem = function(ul, item){
        return $("<li style = 'height: 50px; padding-left: 10px; font-weight: 400; font-size: 13px;overflow-wrap: break-word;'></li>")
          .data("item.autocomplete", item)
          .append(item.label)
          .appendTo(ul);
      };

      $('#degree').autocomplete({
        source: "degree.php",
        appendTo: '#add_education'
      });

      $('#field').autocomplete({
        source: "field.php",
        appendTo: '#add_education'
      });

      $('#skill_name').autocomplete({
        source: "skill.php",
        appendTo: '#add_skills'
      });

      });

        $("#title").on('input', function(){
          if($.trim($("#title").val()) == ""){
            $("#title").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_1').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter your title</p>');
          }
          else{
            $("#title").closest("td").css({'padding-bottom': "20px"});
            $('#exp_res_1').empty().append("");
          }
        });

        $("#company").on('input', function(){
          if($.trim($("#company").val()) == ""){
            $("#company").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_2').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a Company name</p>');
          }
          else{
            $("#company").closest("td").css({'padding-bottom': "20px"});
            $('#exp_res_2').empty().append("");
          }
        });

        $("#start_date_month0").on('input', function(){
          if($("#start_date_month0 option:selected").text() == "Month" && $("#start_date_year0 option:selected").text() == "Year"){
            $("#start_date_month0").closest("td").css({'padding-bottom': "0px"});
            $("#end_date_month0").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_3').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a Start Date</p>');
            if(document.getElementById("end_date0").innerHTML == "Working"){
              $("#end_date0").css({'padding-bottom': "0px"});
            }
          }
          else{
            if($.trim($("#exp_res_4").html()) == ""){
              $("#start_date_month0").closest("td").css({'padding-bottom': "20px"});
              $("#end_date_month0").closest("td").css({'padding-bottom': "20px"});
            }
            if(document.getElementById("end_date0").innerHTML == "Working"){
              $("#end_date0").css({'padding-bottom': "20px"});
            }
            $('#exp_res_3').empty().append("");
          }
        });

        $("#start_date_year0").on('input', function(){
          if($("#start_date_month0 option:selected").text() == "Month" && $("#start_date_year0 option:selected").text() == "Year"){
            $("#start_date_year0").closest("td").css({'padding-bottom': "0px"});
            $("#end_date_year0").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_3').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a Start Date</p>');
            if(document.getElementById("end_date0").innerHTML == "Working"){
              $("#end_date0").css({'padding-bottom': "0px"});
            }
          }
          else{
            if($.trim($("#exp_res_4").html()) == "")
            {
              $("#start_date_year0").closest("td").css({'padding-bottom': "20px"});
              $("#end_date_year0").closest("td").css({'padding-bottom': "20px"});
            }
            if(document.getElementById("end_date0").innerHTML == "Working"){
              $("#end_date0").css({'padding-bottom': "20px"});
            }
            $('#exp_res_3').empty().append("");
          }
        });

        $("#end_date0").on('change', "#end_date_month0", function(){
          if($("#end_date_month0 option:selected").text() == "Month" && $("#end_date_year0 option:selected").text() == "Year"){
            $("#end_date_month0").closest("td").css({'padding-bottom': "0px"});
            $("#start_date_month0").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_4').empty().append('<p style = "margin: 0px; color: red; padding-right: 5px; font-size: 13px; padding-bottom: 20px;">Please enter an End Date</p>');
          }
          else{
            if($.trim($("#exp_res_3").html()) == ""){
              $("#end_date_month0").closest("td").css({'padding-bottom': "20px"});
              $("#start_date_month0").closest("td").css({'padding-bottom': "20px"});
            }
            $('#exp_res_4').empty().append("");
          }
        });

        $("#end_date0").on('change', "#end_date_year0", function(){
          if($("#end_date_month0 option:selected").text() == "Month" && $("#end_date_year0 option:selected").text() == "Year"){
            $("#end_date_year0").closest("td").css({'padding-bottom': "0px"});
            $("#start_date_year0").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_4').empty().append('<p style = "margin: 0px; color: red; padding-right: 5px; font-size: 13px; padding-bottom: 20px;">Please enter an End Date</p>');
          }
          else{
            if($.trim($("#exp_res_3").html()) == ""){
              $("#end_date_year0").closest("td").css({'padding-bottom': "20px"});
              $("#start_date_year0").closest("td").css({'padding-bottom': "20px"});
            }
            $('#exp_res_4').empty().append("");
          }
        });

        $("#headline").on('input', function(){
          if($.trim($("#headline").val()) == ""){
            $("#headline").closest("td").css({'padding-bottom': "0px"});
            $('#exp_res_5').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a headline</p>');
          }
          else{
            $("#headline").closest("td").css({'padding-bottom': "20px"});
            $('#exp_res_5').empty().append("");
          }
        });

        $("#school").on( 'input', function(){
          if($.trim($("#school").val()) != ""){
            $("#school").closest("td").css({'padding-bottom': "20px"});
            $('#edu_res_1').empty().append("");
          }
          else{
            $("#school").closest("td").css({'padding-bottom': "0px"});
            $('#edu_res_1').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter an Institute name</p>');
          }
        });

        $("#city0").on( 'input', function(){
          if($.trim($("#city0").val()) != ""){
            $('#res_20').empty().append("");
            if(document.getElementById("res_30").innerHTML != ""){
              $("#res_30").css({'position': "relative", 'left': '152px'});
              $("#still_working").closest("p").css({'margin-top': "13px"});
            }
          }
          else{
            $("#city0").closest("tr td").css({'padding-bottom': "0px"});
            $("#state0").closest("tr td").css({'padding-bottom': "0px"});
            $("#country0").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_20').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a City name</p>');
            if(document.getElementById("res_30").innerHTML != ""){
              $("#res_30").css({'position': "relative", 'left': '0px'});
            }
            else{
              $("#still_working").closest("p").css({'margin-top': "40px"});
            }
          }
        });
        $("#state0").on( 'input', function(){
          if($.trim($("#state0").val()) != ""){
            $('#res_30').empty().append("");
            if(document.getElementById("res_20").innerHTML != ""){
              $("#res_20").css({'position': "relative", 'left': '152px'});
              $("#still_working").closest("p").css({'margin-top': "13px"});
            }
          }
          else{
            $("#city0").closest("tr td").css({'padding-bottom': "0px"});
            $("#state0").closest("tr td").css({'padding-bottom': "0px"});
            $("#country0").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_30').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a State name</p>');
            if(document.getElementById("res_20").innerHTML != ""){
              $("#res_30").css({'position': "relative", 'left': '0px'});
              $("#still_working").closest("p").css({'margin-top': "13px"});
            }
            else{
            $("#res_30").css({'position': "relative", 'left': '152px'});
          }
        }
        });
        $("#country0").on( 'input', function(){
          if($.trim($("#country0").val()) != ""){
            $('#res_40').empty().append("");
          }
          else{
            $("#city0").closest("tr td").css({'padding-bottom': "0px"});
            $("#state0").closest("tr td").css({'padding-bottom': "0px"});
            $("#country0").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_40').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a Country name</p>');
          }
        });

        $("#city1").on( 'input', function(){
          if($.trim($("#city1").val()) != ""){
            $('#res_21').empty().append("");
            if(document.getElementById("res_31").innerHTML != ""){
              $("#res_31").css({'position': "relative", 'left': '152px'});
            }
          }
          else{
            $("#city1").closest("tr td").css({'padding-bottom': "0px"});
            $("#state1").closest("tr td").css({'padding-bottom': "0px"});
            $("#country1").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_21').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a City name</p>');
            if(document.getElementById("res_31").innerHTML != ""){
              $("#res_31").css({'position': "relative", 'left': '0px'});
            }
          }
        });
        $("#state1").on( 'input', function(){
          if($.trim($("#state1").val()) != ""){
            $('#res_31').empty().append("");
          }
          else{
            $("#city1").closest("tr td").css({'padding-bottom': "0px"});
            $("#state1").closest("tr td").css({'padding-bottom': "0px"});
            $("#country1").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_31').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a State name</p>');
            if(document.getElementById("res_21").innerHTML != ""){
              $("#res_31").css({'position': "relative", 'left': '0px'});
            }
            else{
            $("#res_31").css({'position': "relative", 'left': '152px'});
          }
          }
        });
        $("#country1").on( 'input', function(){
          if($.trim($("#country1").val()) != ""){
            $('#res_41').empty().append("");
          }
          else{
            $("#city1").closest("tr td").css({'padding-bottom': "0px"});
            $("#state1").closest("tr td").css({'padding-bottom': "0px"});
            $("#country1").closest("tr td").css({'padding-bottom': "0px"});
            $('#res_41').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter a Country name</p>');
          }
        });

        $("#exp_form").on('input', function(){
          var btnSubmit = document.getElementById("exp_save");
          if($.trim($("#title").val()) != "" && $.trim($("#company").val()) != "" && $.trim($("#headline").val()) != "" && $.trim($("#city0").val()) != ""
          && $.trim($("#state0").val()) != "" && $.trim($("#country0").val()) != "" && $("#start_date_month0 option:selected").text() != "Month"
          && $("#start_date_year0 option:selected").text() != "Year" && (($("#end_date_month0 option:selected").text() != "Month" && $("#end_date_year0 option:selected").text() != "Year")
          || $("#still_working").prop("checked"))){
            btnSubmit.disabled = false;
            $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
            $("#still_working").closest("p").css({'margin-top': "13px"});
            $("#city0").closest("tr td").css({'padding-bottom': "20px"});
            $("#state0").closest("tr td").css({'padding-bottom': "20px"});
            $("#country0").closest("tr td").css({'padding-bottom': "20px"});
          }
          else{
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
            if($.trim($("#city0").val()) != "" && $.trim($("#state0").val()) != "" && $.trim($("#country0").val()) != ""){
              $("#still_working").closest("p").css({'margin-top': "13px"});
            $("#city0").closest("tr td").css({'padding-bottom': "20px"});
            $("#state0").closest("tr td").css({'padding-bottom': "20px"});
            $("#country0").closest("tr td").css({'padding-bottom': "20px"});
          }
          }
        });

        $("#add_edu_form").on('input', function(){
          var btnSubmit = document.getElementById("save");
          if($.trim($("#school").val()) != "" && $.trim($("#city1").val()) != "" && $.trim($("#state1").val()) != "" && $.trim($("#country1").val()) != ""){
            btnSubmit.disabled = false;
            $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
            $("#city1").closest("tr td").css({'padding-bottom': "20px"});
            $("#state1").closest("tr td").css({'padding-bottom': "20px"});
            $("#country1").closest("tr td").css({'padding-bottom': "20px"});
          }
          else{
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
            if($.trim($("#city1").val()) != "" && $.trim($("#state1").val()) != "" && $.trim($("#country1").val()) != ""){
            $("#city1").closest("tr td").css({'padding-bottom': "20px"});
            $("#state1").closest("tr td").css({'padding-bottom': "20px"});
            $("#country1").closest("tr td").css({'padding-bottom': "20px"});
          }
          }
        });

        $("#lic_form").on('input', function(){
          var btnSubmit = document.getElementById("lic_save");
          if($.trim($("#lic_name").val()) != "" && $.trim($("#organization").val()) != ""){
            btnSubmit.disabled = false;
            $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
          }
          else{
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
          }
        });

        $("#skill_form").on('input', function(){
          var btnsave = document.getElementById("skill_save");
          var btnadd = document.getElementById("skill_add");
          if($.trim($("#skill_name").val()) != ""){
            btnadd.disabled = false;
            $(".button_side").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
          }
          else{
            btnadd.disabled = true;
            $(".button_side").css({'background': 'none', 'color': '#000'});
          }
          if(!$.trim($("#selected_skills").html())){
            btnsave.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
          }
          else{
            btnsave.disabled = false;
            $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
          }
        });

        $("#lic_name").on('input', function(){
          if($.trim($("#lic_name").val()) == ""){
            $("#lic_name").closest("td").css({'padding-bottom': "0px"});
            $('#lic_res_1').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter the name of your Certificate</p>');
          }
          else{
            $("#lic_name").closest("td").css({'padding-bottom': "20px"});
            $('#lic_res_1').empty().append("");
          }
        });

        $("#organization").on('input', function(){
          if($.trim($("#organization").val()) == ""){
            $("#organization").closest("td").css({'padding-bottom': "0px"});
            $('#lic_res_2').empty().append('<p style = "margin: 0px; color: red; padding-left: 5px; font-size: 13px; padding-bottom: 20px;">Please enter the name of issuing organization</p>');
          }
          else{
            $("#organization").closest("td").css({'padding-bottom': "20px"});
            $('#lic_res_2').empty().append("");
          }
        });

        function toggleEndDate(){
          var data = document.getElementById("end_date" + add_id);
          var tog_id = add_id;
          var inner = "Working";
          $('#exp_res_4').empty().append("");
          if(add_id == 2){
            tog_id = add_id - 1;
            inner = "No Expiration Date";
          }
          if(data.innerHTML == inner){
            $("#end_date" + add_id).empty();
            var i = ['Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var select = document.createElement("select");
            select.style.marginRight = "4px";
            select.className = "box4";
            select.id = "end_date_month" + add_id;
            select.name = "end_month";
            for (var v of i){
              var opt = document.createElement("option");
              opt.text = v;
              select.appendChild(opt);
            }
            data.appendChild(select);
            var i = <?php $i = substr(date('Y-m-d H:i:s'), 0, 4); $year = (int)$i; echo $year; ?>;
            var select = document.createElement("select");
            select.className = "box4";
            select.id = "end_date_year" + add_id;
            select.name = "end_year";
            var opt = document.createElement("option");
            opt.text = "Year";
            select.appendChild(opt);
            while(i >= 1950){
              var opt = document.createElement("option");
              opt.text = i;
              select.appendChild(opt);
              i = i - 1;
            }
            data.appendChild(select);
            if($.trim($("#exp_res_3").html()) == ""){
              data.style.paddingBottom = "20px";
              $("#start_date_month" + add_id).closest("td").css({'padding-bottom': "20px"});
            }
            else{
              data.style.paddingBottom = "0px";
              $("#start_date_month0" + add_id).closest("td").css({'padding-bottom': "0px"});
            }
          }
          else{
            $("#end_date" + add_id).empty().append(inner);
            data.style.fontStyle = "italic";
            data.style.fontSize = "13px";
            data.style.fontWeight = "400";
            if($.trim($("#exp_res_3").html()) == ""){
              data.style.paddingBottom = "20px";
              $("#start_date_month" + add_id).closest("td").css({'padding-bottom': "20px"});
            }
            else{
              data.style.paddingBottom = "0px";
              $("#start_date_month0" + add_id).closest("td").css({'padding-bottom': "0px"});
            }
          }
        }

        var add_id;
        var modal = document.getElementsByClassName("dialog");
        $(".add").click (function(){
          add_id = parseInt(this.id);
          modal[add_id].style.display = "block";
          $('html, body').css({overflow: 'hidden'
        });

        });
        window.onclick = function(event) {
          if (event.target == modal[add_id]) {
            modal[add_id].style.display = "none";
            $('html, body').css({overflow: 'auto'
          });
          }
        }

        $("#save").click(function(event){

          var school = $("#school").val();
          var city = $("#city1").val();
          var state = $("#state1").val();
          var country = $("#country1").val();
          var degree = $("#degree").val();
          var field = $("#field").val();
          var start_year = $("#edu_start_year").val();
          var end_year = $("#edu_end_year").val();
          var grade = $("#grade").val();
          $.post( 'myprofile.php', { 'school': school, 'city': city, 'state': state, 'country': country,
           'degree': degree, 'field': field, 'start_year': start_year, 'end_year': end_year, 'grade': grade},
          function(data){
            var btnSubmit = document.getElementById("save");
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
            modal[add_id].style.display = "none";
            $('html, body').css({overflow: 'auto'
          });
          }
        );

        });

        $("#exp_save").click(function(event){

          var title = $("#title").val();
          var type = $("#emp_type").val();
          var company = $("#company").val();
          var city = $("#city0").val();
          var state = $("#state0").val();
          var country = $("#country0").val();
          var start_month = $("#start_date_month0").val();
          var start_year = $("#start_date_year0").val();
          var end_month = $("#end_date_month0").val();
          var end_year = $("#end_date_year0").val();
          var headline = $("#headline").val();
          $.post( 'myprofile.php', { 'title': title, 'type': type, 'company': company, 'city': city, 'state': state, 'country': country,
           'start_month': start_month, 'start_year': start_year, 'end_month': end_month, 'end_year': end_year, 'headline': headline},
          function(data){
            var btnSubmit = document.getElementById("exp_save");
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
            modal[add_id].style.display = "none";
            $('html, body').css({overflow: 'auto'
          });
          var data = document.getElementById("end_date" + add_id);
          if(data.innerHTML == "Working")
            {
              toggleEndDate();
            }
          }
        );

        });

        $("#lic_save").click(function(event){

          var name = $("#lic_name").val();
          var organization = $("#organization").val();
          var start_month = $("#start_date_month2").val();
          var start_year = $("#start_date_year2").val();
          var end_month = $("#end_date_month2").val();
          var end_year = $("#end_date_year2").val();
          var url = $("#cred_url").val();
          $.post( 'myprofile.php', { 'name': name, 'organization': organization, 'start_month': start_month,
          'start_year': start_year, 'end_month': end_month, 'end_year': end_year, 'url': url},
          function(data){
            var btnSubmit = document.getElementById("lic_save");
            btnSubmit.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
            modal[add_id].style.display = "none";
            $('html, body').css({overflow: 'auto'
          });
          var data = document.getElementById("end_date" + add_id);
          if(data.innerHTML == "No Expiration Date")
            {
              toggleEndDate();
            }
          }
        );

        });

        var skill_id = 1;

        $("#skill_add").click(function(event){
          var skill = $("#skill_name").val();
          var btnsave = document.getElementById("skill_save");
          var data = document.getElementById("selected_skills");
          var p = document.createElement("p");
          p.className = "selected_skills_para";
          p.id = "skill" + skill_id;
          skill_id = skill_id + 1;
          p.textContent = skill;
          data.appendChild(p);
          document.forms["skill_form"].reset();
          document.getElementById("skill_add").setAttribute("disabled","disabled");
          $(".button_side").css({'background': 'none', 'color': '#000'});
          btnsave.disabled = false;
          $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
        });

        $("#selected_skills").on('click', ".selected_skills_para", function(event){
          var id = this.id;
          var btnsave = document.getElementById("skill_save");
          $("#" + id).remove();
          if(!$.trim($("#selected_skills").html())){
            btnsave.disabled = true;
            $(".button").css({'background': 'none', 'color': '#000'});
          }
          else{
            btnsave.disabled = false;
            $(".button").css({'background': 'rgba(5, 60, 73, 0.7)', 'color': '#fff'});
          }
        });

        $("#skill_save").click(function(event){
          var x = document.getElementById("selected_skills").querySelectorAll(".selected_skills_para");
          for (var i = 0, len = x.length; i < len; i++) {
            var skill = x[i].textContent;
            $.post( 'myprofile.php', { 'skill': skill},
            function(){
            });
          }
          $("#selected_skills").empty();
          $(".button").css({'background': 'none', 'color': '#000'});
          modal[add_id].style.display = "none";
          $('html, body').css({overflow: 'auto'
        });
      });

      </script>

      <script>
      $(window).scroll(function(e){
        var $el = $('.profile_section');
        var $el3 = $('#side_navbar');
        var isPositionFixed3 = ($el3.css('position') == 'fixed');
        var isPositionFixed = ($el.css('position') == 'fixed');
        if ($(this).scrollTop() > 540 && !isPositionFixed3){
          $el3.fadeIn(50, function(){
            $(this).css({'display': 'inline-block', 'position': 'fixed', 'top': '30px'});
          });
        }
        if ($(this).scrollTop() <= 540 && isPositionFixed3){
          $el3.fadeOut(100, function(){
            $(this).css({'display': 'none', 'position': 'absolute', 'top': '540px'});
          });
        }
        if ($(this).scrollTop() > 140 && !isPositionFixed){
          $el.css({'position': 'fixed', 'top': '30px'});
        }
        if ($(this).scrollTop() <= 140 && isPositionFixed){
          $el.css({'position': 'absolute', 'top': '140px'});
        }
      });
    </script>
  </body>
  </html>

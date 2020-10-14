<?php
session_start();
require_once "pdo.php";
if ( isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])
&& isset($_POST['user_name']) && isset($_POST['contact']) && isset($_POST['password'])) {
  $options = [
    'salt' => "SsMishraDdRMDdeepika_@*",
  ];
  $salted_pass = password_hash(htmlentities($_POST['password']), PASSWORD_BCRYPT, $options);
  $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, user_name, email, contact, password) VALUES ( :fn, :ln, :un, :em, :con, :pss)');
  $stmt->execute(array(
    ':fn' => htmlentities($_POST['fname']),
    ':ln' => htmlentities($_POST['lname']),
    ':un' => htmlentities($_POST['user_name']),
    ':em' => htmlentities($_POST['email']),
    ':con' => htmlentities($_POST['contact']),
    ':pss' => $salted_pass)
  );
  header("Location: register.php");
  return;
}
?>
<html>
<head>
  <link href = "regstyle.css" rel = "stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"/>
</head><body>
  <h1>Welcome to our GoIncite Community</h1>
  <div class="container">
    <p>
      <form method = "post" id = "target">
        <table><tr>
          <th align = "left">First name</th> <th align = "left">Last name</th></tr>
          <tr><td><input type="text" name="fname" size="25" class = "box" id = "fn"/></td>
            <td><input type="text" name="lname" size="25" class = "box" id = "ln"/></td></tr></table>
            <table><tr><th align = "left">User name</th></tr><tr>
              <td><input type="text" name="user_name" size="58" class = "box" id = "un"/></td></tr></table>
              <div id="result3" style = "font-size:12px; color: red; text-align: left; margin-left:22px; margin-top:0px;"></div>
              <table><tr><th align = "left">Email</th></tr><tr>
                <td><input type="text" name="email" size = "58" class = "box" id = "em"/></td></tr></table>
                <div id="result1" style = "font-size:12px; color: red; text-align: left; margin-left:22px; margin-top:0px;"></div>
                <table><tr><th align = "left">Contact number</th></tr><tr>
                  <td><input type="text" name="contact" size = "58" class = "box" id = "con"/></td></tr></table>
                  <div id="result4" style = "font-size:12px; color: red; text-align: left; margin-left:22px; margin-top:0px;"></div>
                  <table style= "margin-bottom:0px;"><tr>
                    <th align = "left">Create password</th> <th align = "left">Confirm password</th></tr>
                    <tr><td><input type="password" name="password" size = "25" class = "box" id="password-field"/></td>
                      <td><input type= "password" name="password" size = "25" class = "box" id="password-field1"/></td></tr></table>
                      <p style = "font-size:13px; text-align: left; margin-left:20px; margin-top:0px;"><input class="button1" type="checkbox" onclick="togglePassword()"/>
                        Show Password</p>
                        <div id="result2" style = "font-size:12px; color: red; text-align: left; margin-left:22px; margin-top:0px;"></div>
                        <table><tr><th><input type="submit" name = "add" value="Join now" class="button" onclick="return submit_form()"/></th></tr></table>
                      </form>
                      <p>Already on GoIncite? <a style="text-decoration:none;" href = "login.php"> Log In</a></p>
                    </p>
                  </div>

                  <script type="text/javascript" src="jquery.min.js">
                  </script>


                  <script type = "text/javascript" src = "js/toggle.js">
                  </script>

                  <script type="text/javascript">

                  var msg1 = "" ;
                  var msg2 = "" ;
                  var msg3 = "" ;
                  var msg4 = "" ;

                  $('#target').change(function(event) {
                    var txt4 = $("#un").val();
                    window.console && console.log('Sending POST');
                    $.post( 'val_uname.php', { 'user_name' : txt4 },
                    function( data ) {
                      window.console && console.log(data);
                      msg1 = data;
                      $('#result3').empty().append(data);
                    }
                  ).error( function() {
                    $('#target').css('background-color', 'red');
                    alert("Dang!");
                  });
                });

                $('#target').change(function(event) {
                  var form = $("#target");
                  var txt3 = form.find('input[name = "email"]').val();
                  window.console && console.log('Sending POST');
                  $.post( 'val_email.php', { 'email': txt3 },
                  function( data ) {
                    window.console && console.log(data);
                    msg2 = data;
                    $('#result1').empty().append(data);
                  }
                ).error( function() {
                  $('#target').css('background-color', 'red');
                  alert("Dang!");
                });
              });

              $('#target').change(function(event) {
                var txt1 = $("#password-field").val();
                var txt2 = $("#password-field1").val();
                window.console && console.log('Sending POST');
                $.post( 'val_pass.php', { 'pass': txt1, 'cnf_pass' : txt2 },
                function( data ) {
                  window.console && console.log(data);
                  msg3 = data;
                  $('#result2').empty().append(data);
                }
              ).error( function() {
                $('#target').css('background-color', 'red');
                alert("Dang!");
              });
            });

            $('#target').change(function(event) {
              var txt5 = $("#con").val();
              window.console && console.log('Sending POST');
              $.post( 'val_contact.php', {'contact' : txt5 },
              function( data ) {
                window.console && console.log(data);
                msg4 = data;
                $('#result4').empty().append(data);
              }
            ).error( function() {
              $('#target').css('background-color', 'red');
              alert("Dang!");
            });
          });

          function submit_form() {
            if (validate())
            {
              /**document.getElementById("target").submit();**/
              alert("Joined Successfully :)");
              return true;
            }
            else{
              return false;
            }
          }

          function validate() {
            var txt1 = document.getElementById("fn").value;
            var txt2 = document.getElementById("ln").value;
            var txt3 = document.getElementById("un").value;
            var txt4 = document.getElementById("em").value;
            var txt5 = document.getElementById("con").value;
            var txt6 = document.getElementById("password-field").value;
            var txt7 = document.getElementById("password-field1").value;
            if(txt1 === '' || txt2 === '' || txt3 === '' || txt4 === '' || txt5 === '' || txt6 === '' || txt7 === ''){
              alert("All fields are required !");
              return false;
            }
            else if ((msg1 !== '' && msg2 !== '' && msg3 !== '' && msg4 !== '') || (msg1 !== '' && msg2 !== '') || (msg2 !== '' && msg3 !== '') || (msg3 !== '' && msg4 !== '') ||
            (msg4 !== '' && msg1 !== '') || (msg2 !== '' && msg4 !== '') || (msg3 !== '' && msg1 !== '')) {
              alert("Please fill the required details correctly !");
              return false;
            }
            else if (msg1 !== '') {
              alert("Validating...");
              return false;
            }
            else if (msg2 !== '') {
              alert("Validating...");
              return false;
            }
            else if (msg3 !== '') {
              alert("Validating...");
              return false;
            }
            else if (msg4 !== '') {
              alert("Validating...");
              return false;
            }
            return true;
          }

        </script>

      </body>
      </html>

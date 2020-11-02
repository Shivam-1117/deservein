<?php
session_start();
if ( isset($_POST['join']) ) {
  header('Location: register.php');
  return;
}
if ( isset($_POST['login']) ) {
  header('Location: login.php');
  return;
}
?>
<html>
<head>
  <link href = "style.css" rel = "stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
  <div class = "container">
    <h1><img src = "img/logo1.png" alt = "logo" width= "150px" height="150px" class="logo"/></h1>
    <nav id = "navbar">
      <ul>
        <li><a style="text-decoration:none" href="index.php">Home</a></li>
        <li><a style="text-decoration:none" href="index.php">About</a>
          <ul>
            <li><a style="text-decoration:none" href="#div1">Overview</a></li>
            <li><a style="text-decoration:none" href="#div2">Our team</a></li>
            <li><a style="text-decoration:none" href="#div3">Objectives</a></li>
            <li><a style="text-decoration:none" href="#div4">Vision &amp; Mision</a></li>
          </ul></li>
          <li><a style="text-decoration:none" href="login.php">Login or Sign Up</a></li>
          <li><a style="text-decoration:none" href="#div5">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </head>
  <body>
    <div id = "join">
      <img src="img/success-2697951.jpg" height="400px" width="600px" align = "right" margin = "0px" class="inline-photo show-on-scroll"/>
      <form method="post">
        <input type="submit" name="join" value="Join Now" class = "button">
      </form>
      <p>If you already have an account then Login Below:</p>
      <form method="post">
        <input type="submit" name="login" value="Login" class = "button">
      </form>
    </div>
    <div id = "div1">
      <img src="img/startup-593296.jpg" height="400px" width="600px" align = "left" margin = "10px" class="inline-photo show-on-scroll"/>
      <p>
        <h1>Overview</h1>
        <ul>
          <li>Strong Brand Endorsement and Recommendation by GOINCITE.</li>
          <li>Provide non- profit Consortium of Fortune 500 HR Departments and University Career centers.</li>
          <li>Exposure of GOINCITE to enormous Free Lancing Jobs.</li>
          <li>Enables very strong Recommendation and network effects with STANDARD user Trusts.</li>
          <li>Generate Leads for Credits with trusted Transaction volume.</li>
          <li>Filtered Job Listings according to the JOB Type for all Professionals and Non Professionals.</li>
        </ul>
      </p>
    </div>
    <div id = "div2">
      <img src="img/team.jpg" height="400px" width="600px" align = "right" margin = "10px" class="inline-photo show-on-scroll"/>
      <p>
        <h1>Our Team</h1>
        <ul>
          <li>Deepa RM, Team Leader & Web Developer
            <ul>
              <li>Computer Science (CSE)</li>
              <li>Sapthagiri College of Engineering</li>
            </ul>
          </li>
        </ul>
        <ul>
          <li>Deepika.S, Idea pitcher & Team Member
            <ul>
              <li>Electronics & Telecommunications(TCE)</li>
              <li>Dr.Ambedkar	Institution of technology</li>
            </ul>
          </li>
        </ul>
      </p>
    </div>
    <div id = "div3">
      <img src="img/job-2860035.jpg" height="400px" width="600px" align = "left" margin = "10px" class="inline-photo show-on-scroll"/>
      <p>
        <h1>Objectives</h1>
        <ul>
          <li>Effective Job employment opportunities for every individual who's jobs are shut in COVID-19 crises.</li>
          <li>Reduces 1/2 of the HR Work email inbox work and the company's too.</li>
          <li>Customers find you on GOINCITE and can reach to you. We'll also send you all the leads matching to you.</li>
        </ul>
      </p>
    </div>
    <div id = "div4">
      <img src="img/vision-2372177.jpg" height="400px" width="600px" align = "right" margin = "10px" class="inline-photo show-on-scroll"/>
      <h1>Vision</h1>
      <p>
        Setting up a huge professional social media  networking platform and providing  employment opportunity
        for every individual  (professionals) With a  demand based digital economy for service  businesses to
        make finding pro’s to get their job  done at a very ease and affordable rate also  helping them find
        new customers & manage  them.
      </p>
      <h1>Mission</h1>
      <p>
        Connect and Ignite the World’s  Professional Profile Standardized  Platform with a Web based service
        market place to get small  businesses, service buyers to suitable service providers, also to Ignite
        the opportunity by setting huge digital connection & to  connect every clients with leads to  get
        their job done.
      </p>
    </div>
    <div id = "div5">
      <h1><u>Contact us</u></h1>
      <p style = "font-size:15px; text-align: center; margin-left:0px; margin-top:0px; margin-right: 600px;">goincitetechnologies@gmail.com</p>
      <p style = "font-size:15px; text-align: center; margin-left:0px; margin-top:0px; margin-right: 600px;">+91 78928 47112</p>
      <p style = "font-size:15px; text-align: center; margin-left:0px; margin-top:0px; margin-right: 600px;">+91 95357 83016</p>
    </div>

    <script type="text/javascript" src="jquery.min.js">
    </script>

    <script>
    $("a[href^='#']").click(function(e) {
      e.preventDefault();

      var position = $($(this).attr("href")).offset().top;

      $("body, html").animate({
        scrollTop: position
      }, 1000 );
    });
  </script>
  <script>
  var scroll = window.requestAnimationFrame ||
  function(callback){ window.setTimeout(callback, 1000/60)};
  var elementsToShow = document.querySelectorAll('.show-on-scroll');

  function loop() {

    Array.prototype.forEach.call(elementsToShow, function(element){
      if (isElementInViewport(element)) {
        element.classList.add('is-visible');
      } else {
        element.classList.remove('is-visible');
      }
    });

    scroll(loop);
  }

  loop();

  function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
      el = el[0];
    }
    var rect = el.getBoundingClientRect();
    return (
      (rect.top <= 0
        && rect.bottom >= 0)
        ||
        (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.top <= (window.innerHeight || document.documentElement.clientHeight))
        ||
        (rect.top >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
        );
      }
    </script>
  </body>
  </html>

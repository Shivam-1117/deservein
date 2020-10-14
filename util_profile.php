<?php
require_once "pdo.php";

function add_education(){
  global $pdo;
  $school = $_POST['school'];
  $institution_id = false;
  $stmt = $pdo -> prepare('SELECT institution_id FROM
  institution WHERE name = :name');
  $stmt -> execute(array(':name' => htmlentities($school)));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row !== false){
    $institution_id = $row['institution_id'];
  }
  if($institution_id === false){
    $stmt = $pdo -> prepare('INSERT INTO institution
    (name, city, state, country) VALUES (:name, :city, :state, :country)');
    $stmt -> execute(array(':name' => htmlentities($school),
                          ':city' => htmlentities($_POST['city']),
                          ':state' => htmlentities($_POST['state']),
                          ':country' => htmlentities($_POST['country'])));
    $institution_id = $pdo -> lastInsertId();
  }

  $stmt = $pdo -> prepare('SELECT degree FROM courses WHERE degree = :degree');
  $stmt -> execute(array(':degree' => htmlentities($_POST['degree'])));
  $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
  if($stmt -> rowCount() == 0){
    $stmt = $pdo -> prepare('INSERT INTO courses (degree) VALUES (:degree)');
    $stmt -> execute(array(':degree' => htmlentities($_POST['degree'])));
  }

  $stmt = $pdo -> prepare('SELECT field FROM courses WHERE field = :field');
  $stmt -> execute(array(':field' => htmlentities($_POST['field'])));
  $row = $stmt->fetchALL(PDO::FETCH_ASSOC);

  if($stmt -> rowCount() == 0){
    $stmt = $pdo -> prepare('INSERT INTO courses (field) VALUES (:field)');
    $stmt -> execute(array(':field' => htmlentities($_POST['field'])));
  }

  $stmt = $pdo -> prepare('INSERT INTO education
  (user_id, institution_id, start_year, end_year, degree, field, grade) VALUES (:user_id, :iid, :start_year, :end_year, :degree, :field, :grade)');
  $stmt -> execute(array(
    ':user_id' => htmlentities($_SESSION['user_id']),
    ':iid' => htmlentities($institution_id),
    ':start_year' => htmlentities($_POST['start_year']),
    ':end_year' => htmlentities($_POST['end_year']),
    ':degree' => htmlentities($_POST['degree']),
    ':field' => htmlentities($_POST['field']),
    ':grade' => htmlentities($_POST['grade'])
  ));
}

function add_experience(){
  global $pdo;
  $company = $_POST['company'];
  $company_id = false;
  $stmt = $pdo -> prepare('SELECT company_id FROM
  company WHERE name = :name AND city = :city AND state = :state AND country = :country');
  $stmt -> execute(array(':name' => htmlentities($_POST['company']),
                        ':city' => htmlentities($_POST['city']),
                        ':state' => htmlentities($_POST['state']),
                        ':country' => htmlentities($_POST['country'])
                      ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row !== false){
    $company_id = $row['company_id'];
  }
  if($company_id === false){
    $stmt = $pdo -> prepare('INSERT INTO company
    (name, city, state, country) VALUES (:name, :city, :state, :country)');
    $stmt -> execute(array(':name' => htmlentities($_POST['company']),
                          ':city' => htmlentities($_POST['city']),
                          ':state' => htmlentities($_POST['state']),
                          ':country' => htmlentities($_POST['country'])
                        ));
    $company_id = $pdo -> lastInsertId();
  }

  $stmt = $pdo -> prepare('INSERT INTO experience
  (user_id, company_id, title, type, start_month, start_year, end_month, end_year, headline)
  VALUES (:user_id, :cid, :title, :type, :start_month, :start_year, :end_month, :end_year, :headline)');
  $stmt -> execute(array(
    ':user_id' => htmlentities($_SESSION['user_id']),
    ':cid' => htmlentities($company_id),
    ':title' => htmlentities($_POST['title']),
    ':type' => htmlentities($_POST['type']),
    ':start_month' => htmlentities($_POST['start_month']),
    ':start_year' => htmlentities($_POST['start_year']),
    ':end_month' => htmlentities($_POST['end_month']),
    ':end_year' => htmlentities($_POST['end_year']),
    ':headline' => htmlentities($_POST['headline'])
  ));
}

function add_licenses(){
  global $pdo;
  $org_id = false;
  $stmt = $pdo -> prepare('SELECT org_id FROM
  organizations WHERE organization = :organization');
  $stmt -> execute(array(':organization' => htmlentities($_POST['organization'])
                      ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row !== false){
    $org_id = $row['org_id'];
  }
  if($org_id === false){
    $stmt = $pdo -> prepare('INSERT INTO organizations
    (organization) VALUES (:organization)');
    $stmt -> execute(array(':organization' => htmlentities($_POST['organization'])
                        ));
    $org_id = $pdo -> lastInsertId();
  }

  $stmt = $pdo -> prepare('INSERT INTO certifications
  (user_id, org_id, name, issue_month, issue_year, expire_month, expire_year, url)
  VALUES (:user_id, :oid, :name, :start_month, :start_year, :end_month, :end_year, :url)');
  $stmt -> execute(array(
    ':user_id' => htmlentities($_SESSION['user_id']),
    ':oid' => htmlentities($org_id),
    ':name' => htmlentities($_POST['name']),
    ':start_month' => htmlentities($_POST['start_month']),
    ':start_year' => htmlentities($_POST['start_year']),
    ':end_month' => htmlentities($_POST['end_month']),
    ':end_year' => htmlentities($_POST['end_year']),
    ':url' => htmlentities($_POST['url'])
  ));
}

function add_skill(){
  global $pdo;
  $skill_id = false;
  $stmt = $pdo -> prepare('SELECT * FROM
  skills_available WHERE industry = :skill OR tool = :skill OR other = :skill');
  $stmt -> execute(array(':skill' => htmlentities($_POST['skill'])));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row !== false){
    $skill_id = $row['skill_id'];
    if($row['industry'] == htmlentities($_POST['skill'])){
      $stmt = $pdo -> prepare('SELECT * FROM
      skills_industry WHERE industry = :skill AND user_id = :user_id');
      $stmt -> execute(array(':skill' => htmlentities($_POST['skill']),
                              ':user_id' => htmlentities($_SESSION['user_id'])));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row === false){
        $stmt = $pdo -> prepare('INSERT INTO skills_industry
          (user_id, industry) VALUES (:user_id, :industry)');
          $stmt -> execute(array(
            ':user_id' => htmlentities($_SESSION['user_id']),
            ':industry' => htmlentities($_POST['skill'])
          ));
        }
      }
    elseif($row['tool'] == htmlentities($_POST['skill'])){
      $stmt = $pdo -> prepare('SELECT * FROM
      skills_tool WHERE tool = :skill AND user_id = :user_id');
      $stmt -> execute(array(':skill' => htmlentities($_POST['skill']),
                              ':user_id' => htmlentities($_SESSION['user_id'])));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row === false){
        $stmt = $pdo -> prepare('INSERT INTO skills_tool
          (user_id, tool) VALUES (:user_id, :tool)');
          $stmt -> execute(array(
            ':user_id' => htmlentities($_SESSION['user_id']),
            ':tool' => htmlentities($_POST['skill'])
          ));
        }
      }
    else{
      $stmt = $pdo -> prepare('SELECT * FROM
      skills_other WHERE other = :skill AND user_id = :user_id');
      $stmt -> execute(array(':skill' => htmlentities($_POST['skill']),
                              ':user_id' => htmlentities($_SESSION['user_id'])));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row === false){
      $stmt = $pdo -> prepare('INSERT INTO skills_other
      (user_id, other)
      VALUES (:user_id, :other)');
      $stmt -> execute(array(
        ':user_id' => htmlentities($_SESSION['user_id']),
        ':other' => htmlentities($_POST['skill'])
      ));
    }
  }
  }
  if($skill_id === false){
    $stmt = $pdo -> prepare('INSERT INTO skills_available
    (other) VALUES (:skill)');
    $stmt -> execute(array(':skill' => htmlentities($_POST['skill'])));
    $stmt = $pdo -> prepare('INSERT INTO skills_other
    (user_id, other)
    VALUES (:user_id, :other)');
    $stmt -> execute(array(
      ':user_id' => htmlentities($_SESSION['user_id']),
      ':other' => htmlentities($_POST['skill'])
    ));
  }
}

function load_exprience(){
  global $pdo;

  $stmt = $pdo -> prepare('SELECT * FROM company c, experience e WHERE c.company_id = e.company_id AND user_id = :uid ORDER BY end_year DESC,
     FIELD(end_month, "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "Present") DESC');
  $stmt -> execute(array(':uid' => htmlentities($_SESSION['user_id'])));

  echo '<div id = "experience">
    <h1>Experience <a class = "add" id = "0" style="margin:0px; float: right;">&#43;</a></h1><br>
    <img src = "img/experience.png" alt = "logo" width= "150px" height="245px" style="filter: invert(15%) sepia(69%) saturate(1190%) hue-rotate(157deg) brightness(95%) contrast(96%) drop-shadow(5px 5px 5px #badbd7); position: relative; top: 0px; left: 50px; transform: scaleX(-1);"/>
    <div>';

  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
  echo '<ul><a style="margin:0px; float: right;"><img src = "img/edit1.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 20px; right: 30px;"/></a>
        <li class = "exp_logo"><img src = "img/'.$row['logo'].'" alt = "logo" width= "30px" height="30px"/></li>
        <li class = "exp_company">'.$row['name'].'</li>
        <li class = "exp_role">'.$row['title'].'</li>
        <li class = "exp_duration">'.$row['start_month'].' '.$row['start_year'].' - '.$row['end_month'].' '.$row['end_year'].'</li>
      </ul>';
  }
  echo '</div></div>';
}
function load_education(){
  global $pdo;

  $stmt = $pdo -> prepare('SELECT * FROM education e, institution i WHERE e.institution_id = i.institution_id AND user_id = :uid ORDER BY end_year DESC');
  $stmt -> execute(array(':uid' => htmlentities($_SESSION['user_id'])));

  echo '<div id = "education">
    <h1 class="edu">Education <a class = "add" id = "1" style="margin:0px; float: right;">&#43;</a></h1>
    <img src = "img/education.svg" alt = "logo" width= "250px" height="300px" style="filter: drop-shadow(2px 2px 2px #badbd7); position: relative; top: 0px; left: 10px;"/>
    <div>';

  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
  echo '<ul><a style="margin:0px; float: right;"><img src = "img/edit1.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 20px; right: 60px;"/></a>
        <li><img src = "img/'.$row['logo'].'" alt = "logo" width= "40px" height="40px" style="padding-right: 10px;position: relative;top: 0px;"/></li>
        <li class = "edu_name">'.$row['name'].', '.$row['city'].', '.$row['state'].', '.$row['country'].'</li>
        <li class = "edu_details">'.$row['degree'].'<br>'.$row['field'].'<br>'.$row['grade'].'<br>'.$row['start_year'].'-'.$row['end_year'].'</li>
      </ul>';
}
echo '</div>
</div>';
}

function load_certifications(){
  global $pdo;
  $stmt = $pdo -> prepare('SELECT * FROM organizations o, certifications c WHERE o.org_id = c.org_id AND user_id = :uid ORDER BY issue_year DESC,
     FIELD(issue_month, "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "Present") DESC');
  $stmt -> execute(array(':uid' => htmlentities($_SESSION['user_id'])));
  echo '<div id = "licenses_in">';

  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
  echo '
    <ul style="list-style: none; display: inline-block; margin: 0px; width: 100%;">
      <a style="margin:0px; float: right;"><img src = "img/edit1.png" alt = "logo" width= "20px" height="20px" style="position: relative; top: 20px; right: 40px;"/></a>
      <li><img src = "img/'.$row['logo'].'" alt = "logo" width= "40px" height="40px" style="padding-right: 0px;position: relative;top: 10px"/></li>
      <li class = "lic_details">'.$row['name'].'<br>'.$row['organization'].'<br><p>Issued '.$row['issue_month'].' '.$row['issue_year'].' - '.$row['expire_month'].' '.$row['expire_year'].'</p></li>
      <li class = "lic_url"><a href = "'.$row['url'].'">Show</a></li>
    </ul><br>';
}
echo '</div>';
}

function load_skills(){
  global $pdo;

  echo '
  <div>
    <ul id = "ul_1">
      <li><h2>Industry Knowledge</h2>
        <ul>
          <li>Algorithms</li>
          <li>Programming</li>
          <li>Deep Learning</li>
          <li>Optimization</li>
          <li>Artificial Intelligence (AI)</li>
          <li>Data Analysis</li>
          <li>Data Visualization</li>
          <li>Mathematics</li>
          <li>Analytics</li>
          <li>Virtualization</li>
          <li>Web Development</li>
          <li>Analytical Skills</li>
          <li>Data Mining</li>
          <li>Business Analysis</li>
        </ul>
      </li>
      <li><h2>Tools &amp Technologies</h2>
        <ul>
          <li>C (Programming Language)</li>
          <li>Deep Neural Networks (DNN)</li>
          <li>Pandas (Software)</li>
          <li>Seaborn</li>
          <li>MySQL</li>
          <li>PhpMyAdmin</li>
          <li>PHP</li>
          <li>HTML5</li>
          <li>Cascading Style Sheets (CSS)</li>
          <li>SQL</li>
          <li>Databases</li>
          <li>R</li>
          <li>JavaScript</li>
          <li>jQuery</li>
          <li>JSON</li>
        </ul>
      </li>
      <li><h2>Other Skills</h2>
        <ul>
          <li>Neural Networks</li>
          <li>Convolutional Neural Networks (CNN)</li>
          <li>Programming Languages</li>
          <li>Artificial Neural Networks</li>
          <li>Machine Learning Algorithms</li>
          <li>Pattern Recognition</li>
          <li>Computing</li>
          <li>Data Cleaning</li>
          <li>Matplotlib</li>
          <li>NumPy</li>
          <li>Data virtualization</li>
          <li>Data Representation</li>
          <li>Chart</li>
          <li>Data Analytics</li>
          <li>Exploratory Data Analysis</li>
          <li>RStudio</li>
        </ul>
      </li></ul>
    </div>
  ';
}
?>

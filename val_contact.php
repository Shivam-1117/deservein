<?php
require_once "pdo.php";
if ( !isset($_POST['contact']) ){
  return;
}
if ( strlen($_POST['contact']) > 1){
  $pattern = "/^\d+$/";
  if(preg_match($pattern, $_POST['contact']) == 0){
   echo "Invalid Contact";
   return;
 }
}
?>

<?php
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=goincite',
   'shivam', 'shivam_goincite');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

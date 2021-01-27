<?php
include("../include/connection.php");

$_SESSION['personId']='';
$_SESSION['personWeight']='';
$_SESSION['personHeight']='';
header("Location: ../main/login.php");
  
?>

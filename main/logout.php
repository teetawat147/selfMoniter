<?php
include("../include/connection.php");

$_SESSION['personId']='';
$_SESSION['lineId']='';
$_SESSION['fname']='';
$_SESSION['lname']='';
$_SESSION['personWeight']='';
$_SESSION['personHeight']='';
header("Location: ../main/login.php");
  
?>

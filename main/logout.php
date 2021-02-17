<?php
include("../include/connection.php");

$_SESSION['personId']='';
$_SESSION['fname']='';
$_SESSION['lname']='';
$_SESSION['personWeight']='';
$_SESSION['personHeight']='';
$_SESSION['officeId']='';
$_SESSION['groupId']='';
$_SESSION['districtCode']='';

header("Location: ../main/login.php");
  
?>

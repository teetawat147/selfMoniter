<?php
// print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");

$sql="UPDATE person SET ". 
    " cid='".$_POST['cid']."' ".
    " ,fname='".$_POST['fname']."' ".
    " ,lname='".$_POST['lname']."' ".
    " ,birthdate='".$_POST['birthdate']."' ".
    " ,sexId='".$_POST['sexId']."' ".
    " ,phone='".$_POST['phone']."' ".
    " ,address='".$_POST['address']."' ".
    " ,provinceCode='".$_POST['provinceCode']."' ".
    " ,districtCode='".$_POST['districtCode']."' ".
    " ,subdistrictCode='".$_POST['subdistrictCode']."' ".
    " ,officeId='".$_POST['officeId']."' ".
    " ,departmentId='".$_POST['departmentId']."' ".
    " ,personWeight='".$_POST['personWeight']."' ".
    " ,personHeight='".$_POST['personHeight']."' ".
    " ,email='".$_POST['email']."' ".
    " ,groupId='".$_POST['groupId']."' ".
    " WHERE personId ='".$_POST['personId']."'";
// echo $sql;
$result = $conn->prepare($sql);
$result->execute();
header("Location: ../main/personGet.php");

// print_r($result);
?>
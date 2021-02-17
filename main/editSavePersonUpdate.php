<?php
// print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");

$sql="UPDATE person SET ". 
    " cid='".$_POST['cid']."' ".
    " ,fname='".$_POST['fname']."' ".
    " ,lname='".$_POST['lname']."' ".
    " ,phone='".$_POST['phone']."' ".
    " ,address='".$_POST['address']."' ".
    " ,provinceCode='".$_POST['provinceCode']."' ".
    " ,districtCode='".$_POST['districtCode']."' ".
    " ,subdistrictCode='".$_POST['subdistrictCode']."' ".
    " ,email='".$_POST['email']."' ".
    " ,groupId='".$_POST['groupId']."' ".
    " WHERE personId ='".$_POST['personId']."'";
// echo $sql;
$result = $conn->prepare($sql);
$result->execute();
header("Location: ../main/personGet.php");

// print_r($result);
?>
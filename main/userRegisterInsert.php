<?php
print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");

$sql ="INSERT into person (
        cid, 
        fname, 
        lname, 
        sexId, 
        phone, 
        address, 
        provinceCode, 
        districtCode, 
        subdistrictCode, 
        officeId, 
        departmentId, 
        personWeight, 
        personHeight, 
        email, 
        password
    )
    
    value (
        '".$_POST['cid']."', 
        '".$_POST['fname']."', 
        '".$_POST['lname']."', 
        '".$_POST['sexId']."',
        '".$_POST['phone']."',
        '".$_POST['address']."',
        '".$_POST['provinceCode']."', 
        '".$_POST['districtCode']."', 
        '".$_POST['subdistrictCode']."', 
        '".$_POST['officeId']."',
        '".$_POST['departmentId']."', 
        '".$_POST['personWeight']."', 
        '".$_POST['personHeight']."', 
        '".$_POST['email']."', 
        md5('".$_POST['password']."') 
    )";
echo $sql ; 
$result = $conn->prepare($sql);
$result->execute();
$personId = $conn->lastInsertId();
$_SESSION['personId']=$personId;
$_SESSION['fname']=$_POST['fname'];
$_SESSION['lname']=$_POST['lname'];
$_SESSION['personWeight']=$_POST['personWeight'];
$_SESSION['personHeight']=$_POST['personHeight'];
header("Location: ../main/consent.php");
?>
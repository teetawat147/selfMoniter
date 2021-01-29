<?php
print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");
//  $sql ="INSERT into office (officeName, personId, inputDatetime) value ('รพ.สว่างแดนดิน', 1, '$datetime')";
// $personWeight=$_POST['personWeight'];
// $personWeight=$_POST['personWeight'];

$sql ="UPDATE person
        SET cid = '".$_POST['cid']."',
            fname = '".$_POST['fname']."', 
            lname = '".$_POST['lname']."',
            phone = '".$_POST['phone']."',
            address = '".$_POST['address']."',
            provinceCode = '".$_POST['provinceCode']."',
            districtCode = '".$_POST['districtCode']."',
            subdistrictCode = '".$_POST['subdistrictCode']."',
            email = '".$_POST['email']."'
        WHERE personId='".$_SESSION['personId']."' ";

echo $sql ; 
$result = $conn->prepare($sql);
$result->execute();
$lastId = $conn->lastInsertId();
$_SESSION['cid']=$_POST['cid'];
$_SESSION['fname']=$_POST['fname'];
$_SESSION['lname']=$_POST['lname'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['address']=$_POST['address'];
$_SESSION['provinceCode']=$_POST['provinceCode'];
$_SESSION['districtCode']=$_POST['districtCode'];
$_SESSION['subdistrictCode']=$_POST['subdistrictCode'];
$_SESSION['email']=$_POST['email'];
header("Location: ../main/dashboard.php");
?>
<?php
// print_r($_POST);
include "../include/connection.php";
$datetime = date("Y-m-d H:i:s");

$sql = "INSERT into person (
        cid,
        fname,
        lname,
        sexId,
        birthdate,
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
        lineId,
        groupId,
        password
        )
        VALUE (
        '" . $_POST['cid'] . "',
        '" . $_POST['fname'] . "',
        '" . $_POST['lname'] . "',
        '" . $_POST['sexId'] . "',
        '".adjustDate($_POST['birthdate'])."',
        '" . $_POST['phone'] . "',
        '" . $_POST['address'] . "',
        '" . $_POST['provinceCode'] . "',
        '" . $_POST['districtCode'] . "',
        '" . $_POST['subdistrictCode'] . "',
        '" . $_POST['officeId'] . "',
        '" . $_POST['departmentId'] . "',
        '" . $_POST['personWeight'] . "',
        '" . $_POST['personHeight'] . "',
        '" . $_POST['email'] . "',
        '" . $_POST['lineId'] . "',
        '" . $_POST['groupId'] . "',
        md5('".$_POST['password']."'),
        )";

$result = $conn->prepare($sql);
$result->execute();
$personId = $conn->lastInsertId();
$_SESSION['personId']=$personId;
$_SESSION['lineId']=$_POST['lineId'];
$_SESSION['fname']=$_POST['fname'];
$_SESSION['lname']=$_POST['lname'];
$_SESSION['personWeight']=$_POST['personWeight'];
$_SESSION['personHeight']=$_POST['personHeight'];
header("Location: ../main/consent.php");

// print_r($result);

function adjustDate($date){
    $_yyyy=substr($date,0,4);
    if (substr($date,0,4)>'2400'){
        $_yyyy=substr($date,0,4)-543;
    }
    return $_yyyy.substr($date,4,6);
}
?>
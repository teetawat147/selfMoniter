<?php
// print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");

$sql="UPDATE office SET ". 
    " office_name='".$_POST['office_name']."' ".
    " ,office_code='".$_POST['office_code']."' ".
    " ,office_type='".$_POST['office_type']."' ".
    " ,changwat_code='".$_POST['changwat_code']."' ".
    " ,ampur_code='".$_POST['ampur_code']."' ".
    " WHERE office_id ='".$_POST['officeId']."'";
echo $sql;
// $result = $conn->prepare($sql);
// $result->execute();
// header("Location: ../main/personGet.php");

// print_r($result);
?>
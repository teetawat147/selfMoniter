<?php
// print_r($_POST);
include "../include/connection.php";

$sql = "INSERT into office (
        office_name,
        office_code,
        office_type,
        changwat_code,
        ampur_code,
        count_person
        )
        VALUE (
        '" . $_POST['office_name'] . "',
        '" . $_POST['office_code'] . "',
        '" . $_POST['office_type'] . "',
        '" . $_POST['provinceCode'] . "',
        '" . $_POST['districtCode'] . "',
        '" . $_POST['count_person'] . "'
        )";
    
// echo $sql;
$result = $conn->prepare($sql);
$result->execute();
header("Location: ../main/officeGet.php");

// print_r($result);

?>
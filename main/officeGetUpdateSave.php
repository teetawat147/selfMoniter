<?php
    include("../include/connection.php");

    $sql = "UPDATE office SET ". 
            " office_name='".$_POST['office_name']."' ".
            " ,office_code='".$_POST['office_code']."' ".
            " ,office_type='".$_POST['office_type']."' ".
            " ,changwat_code='".$_POST['provinceCode']."' ".
            " ,ampur_code='".$_POST['districtCode']."' ".
            " ,count_person='".$_POST['count_person']."' ".
            " WHERE office_id ='".$_POST['office_id']."' ";

    $result = $conn -> prepare($sql);
    $result -> execute();
    header("location: ../main/officeGet.php");
?>
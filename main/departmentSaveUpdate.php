<?php 
    include("../include/connection.php");
    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE department SET ".
            " officeId = '".$_POST['officeId']."' ".
            " ,departmentName = '".$_POST['departmentName']."' ".
            " ,personId = '".$_SESSION['personId']."' ".
            " ,countPersonDept = '".$_POST['countPersonDept']."' ".
            " WHERE departmentId = '".$_POST['departmentId']."' ";

    $result = $conn -> prepare($sql)    ;
    $result -> execute();
    header("location: ../main/departmentGet.php");

    // print_r($result);
?>
<?php
    include('../include/connection.php');

    $sqlInsert = "INSERT INTO waist(waistName, waistConclude, waistDetail, sex1Max, sex2max, waistAdvice)
    VALUE (
        '".$_POST['waistName']."',
        '".$_POST['waistConclude']."',
        '".$_POST['waistDetail']."',
        '".$_POST['sex1max']."',
        '".$_POST['sex2max']."',
        '".$_POST['waistDetail']."'
    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    header("location: ../main/waistGet.php");
?>
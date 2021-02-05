<?php
    include('../include/connection.php');

    // $sql="UPDATE waist SET ( ". 
    // " waistName,waistConclude,waistDetail ".
    // " ,sex1max,sex2max,waistAdvice ". 
    // " ) ".
    // " VALUES ( ".
    // ",'".$_POST['waistName']."' ".
    // ",'".$_POST['waistConclude']."' ".
    // ",'".$_POST['waistDetail']."' ".
    // ",'".$_POST['sex1max']."' ".
    // ",'".$_POST['sex2max']."' ".
    // ",'".$_POST['waistAdvice']."' ".
    // " WHERE waistId ='".$_POST['waistId']."'";

    $sql="UPDATE waist SET ". 
    " waistName='".$_POST['waistName']."' ".
    " ,waistConclude='".htmlspecialchars($_POST['waistConclude'])."' ".
    " ,waistDetail='".htmlspecialchars($_POST['waistDetail'])."' ".
    " ,sex1max='".$_POST['sex1max']."' ".
    " ,sex2max='".$_POST['sex2max']."' ".
    " ,waistAdvice='".htmlspecialchars($_POST['waistAdvice'])."' ".
    " WHERE waistId ='".$_POST['waistId']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/waistGet.php');
//     print_r($result);
?>

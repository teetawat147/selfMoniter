<?php
    include('../include/connection.php');

    // $sql="UPDATE cvdScore SET ( ". 
    // " cvdName,conclude,advice ".
    // " ,cvdMin,cvdMax ". 
    // " ) ".
    // " VALUES ( ".
    // ",'".$_POST['cvdName']."' ".
    // ",'".$_POST['conclude']."' ".
    // ",'".$_POST['advice']."' ".
    // ",'".$_POST['cvdMin']."' ".
    // ",'".$_POST['cvdMax']."' ".
    // " WHERE cvdScoreId ='".$_POST['cvdScoreId']."'";

    $sql = "UPDATE alcohol SET ". 
    " alcoholName='".$_POST['alcoholName']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " WHERE alcoholId ='".$_POST['alcoholId']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/alcoholGet.php');
    //print_r($result);
?>

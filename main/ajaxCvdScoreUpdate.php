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

    $sql = "UPDATE cvdScore SET ". 
    " cvdName='".$_POST['cvdName']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " ,cvdMin='".$_POST['cvdMin']."' ".
    " ,cvdMax='".$_POST['cvdMax']."' ".
    " WHERE cvdScoreId ='".$_POST['cvdScoreId']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/cvdScoreGet.php');
    //print_r($result);
?>

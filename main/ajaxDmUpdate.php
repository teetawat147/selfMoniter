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

    $sql = "UPDATE bloodSugar SET ". 
    " bloodSugarName='".$_POST['bloodSugarName']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " ,bloodSugarDetail='".$_POST['bloodSugarDetail']."' ".
    " ,fbs='".$_POST['fbs']."' ".
    " WHERE bloodSugarId ='".$_POST['bloodSugarId']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/dmGet.php');
    //print_r($result);
?>

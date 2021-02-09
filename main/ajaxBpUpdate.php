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

    $sql = "UPDATE bloodPressure SET ". 
    " bloodPressureName='".$_POST['bloodPressureName']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " ,sbp='".$_POST['sbp']."' ".
    " ,dbp='".$_POST['dbp']."' ".
    " WHERE bloodPressureId ='".$_POST['bloodPressureId']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/bpGet.php');
    //print_r($result);
?>

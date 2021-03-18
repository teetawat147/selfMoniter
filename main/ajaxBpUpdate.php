<?php
    include('../include/connection.php');

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

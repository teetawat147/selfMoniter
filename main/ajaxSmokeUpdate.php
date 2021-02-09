<?php
    include('../include/connection.php');

    $sql="UPDATE smoke SET ( ". 
    " smokeName,map,conclude, advice ".
    " ) ".
    " VALUES ( ".
    ",'".$_POST['smokeName']."' ".
    ",'".$_POST['conclude']."' ".
    ",'".$_POST['advice']."' ".
    " WHERE smokeId ='".$_POST['smokeId']."'";

    $sql="UPDATE smoke SET ". 
    " smokeName='".$_POST['smokeName']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " WHERE smokeId ='".$_POST['smokeId']."'";

    $result = $conn -> prepare($sql);
    $result -> execute();
    header('location: ../main/smokeGet.php');
    // print_r($result);
?>

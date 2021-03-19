<?php 
    include("../include/connection.php");

    $sqlInsert = "INSERT INTO smoke(smokeName, map, conclude, advice)
                    VALUE(
                        '".$_POST['smokeName']."',
                        '".$_POST['map']."',
                        '".$_POST['conclude']."',
                        '".$_POST['advice']."'
                    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();    
    header("Location: ../main/smokeGet.php");
    // print_r($result);
?>
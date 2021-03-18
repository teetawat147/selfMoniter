<?php 
    include("../include/connection.php");

    $sqlInsert = "INSERT INTO bloodPressure(bloodPressureName, conclude, advice, sbp, dbp)
                    VALUE (
                        '".$_POST['bloodPressureName']."',
                        '".$_POST['conclude']."',
                        '".$_post['advice']."',
                        '".$_POST['sbp']."',
                        '".$_POST['dbp']."'
                    )";
    
    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    header("Location: ../main/bpGet.php");
?>
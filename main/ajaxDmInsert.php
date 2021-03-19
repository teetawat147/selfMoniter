<?php 
    include("../include/connection.php");

    $sqlInsert = "INSERT INTO bloodSugar(bloodSugarName, conclude, advice, bloodSugarDetail, fbs)
                    VALUE(
                        '".$_POST['bloodSugarName']."',
                        '".$_post['conclude']."',
                        '".$_post['advice']."',
                        '".$_POST['bloodSugarDetail']."',
                        '".$_POST['fbs']."'
                    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    header("Location: ../main/dmGet.php");
?>
<?php 
    include("../include/connection.php");

    $sqlInsert = "INSERT INTO cvdScore(cvdName, conclude, advice, cvdMin, cvdMax)
                    VALUE (
                        '".$_POST['cvdName']."',
                        '".$_POST['conclude']."',
                        '".$_POST['advice']."',
                        '".$_POST['cvdMin']."',
                        '".$_POST['cvdMax']."'
                    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    header("Location: ../main/cvdScoreGet.php");
    // print_r($result);
?>
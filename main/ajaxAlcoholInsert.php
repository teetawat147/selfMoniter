<?php 
    include("../include/connection.php");

    $sqlInsert = "INSERT INTO alcohol(alcoholName, conclude, advice)
                    VALUE(
                        '".$_POST['alcoholName']."',
                        '".$_POST['conclude']."',
                        '".$_POST['advice']."'
                    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    header("Location: ../main/alcoholGet.php");
    // print_r($result);

?>
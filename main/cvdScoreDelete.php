<?php 
    include("../include/connection.php");

    $sqlDelete = "DELETE FROM cvdScore WHERE cvdScoreId=".$_GET["cvdScoreId"];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("Location: ../main/cvdScoreGet.php");
?>
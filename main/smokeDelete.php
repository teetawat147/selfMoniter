<?php 
    include("../include/connection.php");

    $sqlDelete = "DELETE FROM smoke WHERE smokeId=".$_GET["smokeId"];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("location: ../main/smokeGet.php");
?>
<?php 
    include("../include/connection.php");

    $sqlDelete = "DELETE FROM alcohol WHERE alcoholId=".$_GET["alcoholId"];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("Location: ../main/alcoholGet.php");
?>
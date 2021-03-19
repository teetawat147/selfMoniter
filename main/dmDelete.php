<?php 
    include("../include/connection.php");

    $sqlDelete = "DELETE FROM bloodSugar WHERE bloodSugarId=".$_GET["bloodSugarId"];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("Location: ../main/dmGet.php");
?>
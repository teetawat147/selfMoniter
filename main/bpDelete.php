<?php 
    include("../include/connection.php");

    $sqlDelete = "DELETE FROM bloodPressure WHERE bloodPressureId=".$_GET["bloodPressureId"];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("Location: ../main/bpGet.php");
?>
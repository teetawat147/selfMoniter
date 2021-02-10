<?php
    include('../include/connection.php');

    $sqlDelete = "DELETE FROM `waist` WHERE waistId=".$_GET['waistId'];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("location: ../waistGet.php");
?>

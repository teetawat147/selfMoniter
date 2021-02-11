<?php
    include('../include/connection.php');

    $sqlDelete = "DELETE FROM `bmi` WHERE id=".$_GET['id'];
    $result = $conn -> prepare($sqlDelete);
    $result -> execute();
    header("location: ../main/bmiGet.php");
?>
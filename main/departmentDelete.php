<?php 
    include('../include/connection.php');

    $sql = "DELETE FROM department WHERE departmentId = '".$_GET['departmentId']."' ";
    $result = $conn -> prepare($sql);
    $result -> execute();
    header("location: ../main/departmentGet.php");
?>
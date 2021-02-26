<?php 
    include('../include/connection.php');
    $datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO department (
                officeId,
                departmentName,
                personId,
                inputDatetime,
                countPersonDept
            ) VALUE (
                '".$_POST['officeId']."',
                '".$_POST['departmentName']."',
                '".$_SESSION['personId']."',
                '".$datetime."',
                '".$_POST['countPersonDept']."'
            )";

$result = $conn -> prepare($sql);
$result -> execute();

// print_r($result);
header('location: ../main/departmentGet.php');
?>
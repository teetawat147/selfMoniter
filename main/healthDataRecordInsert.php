<?php
print_r($_POST);
include "../include/connection.php";
$datetime = date("Y-m-d H:i:s");
$sql = "INSERT into health_data_record (
        diabetesId,
        bloodId,
        healthHeight,
        healthWeight,
        waist,
        bpUpper,
        bpLower,
        bloodSugar,
        smokeId,
        alcoholId,
        inputDatetime,
        personId
        )

        values (
            '" . $_POST['diabetesId'] . "',
            '" . $_POST['bloodId'] . "',
            '" . $_SESSION['personHeight'] . "',
            '" . $_POST['healthWeight'] . "',
            '" . $_POST['waist'] . "',
            '" . $_POST['bpUpper'] . "',
            '" . $_POST['bpLower'] . "',
            '" . $_POST['bloodSugar'] . "',
            '" . $_POST['smokeId'] . "',
            '" . $_POST['alcoholId'] . "',
            '" . $datetime . "',
            " . $_SESSION['personId'] . "
        )";

//echo $sql;
$result = $conn->prepare($sql);
$result->execute();
$lastId = $conn->lastInsertId();
header("Location: ../main/healthScreen.php?helpRecordId=" . $lastId);
// header("location: ../main/healthScreen.php");

?>
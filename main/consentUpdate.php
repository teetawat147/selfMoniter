<?php
// print_r($_POST);
include("../include/connection.php");
$datetime = date("Y-m-d H:i:s");
//  $sql ="INSERT into office (officeName, personId, inputDatetime) value ('รพ.สว่างแดนดิน', 1, '$datetime')";
// $personWeight=$_POST['personWeight'];
// $personWeight=$_POST['personWeight'];

$sql ="UPDATE person
        SET personWeight = '".$_POST['personWeight']."', 
            personHeight = '".$_POST['personHeight']."'
        WHERE personId='".$_SESSION['personId']."' ";

// echo $sql ; 
$result = $conn->prepare($sql);
$result->execute();
$lastId = $conn->lastInsertId();
$_SESSION['personWeight']=$_POST['personWeight'];
$_SESSION['personHeight']=$_POST['personHeight'];
header("Location: ../main/healthDataRecord.php");
?>
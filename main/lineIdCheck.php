<?php
include("../include/connection.php");
print_r($_POST);
$sql = "SELECT * FROM `person` WHERE lineId = :lineId";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':lineId'=> $_POST['lineId']));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
if(count($result)>0){
    $_SESSION['personId']=$result[0]['personId'];
    $_SESSION['lineId']=$result[0]['lineId'];
    $_SESSION['fname']=$result[0]['fname'];
    $_SESSION['lname']=$result[0]['lname'];
    $_SESSION['personWeight']=$result[0]['personWeight'];
    $_SESSION['personHeight']=$result[0]['personHeight'];    
    header("Location: ../main/Healthdatarecord.php");
    echo "Ok";
}else{
    $_SESSION['personId']='';
    $_SESSION['lineId']='';
    $_SESSION['fname']='';
    $_SESSION['lname']='';
    $_SESSION['personWeight']='';
    $_SESSION['personHeight']='';
    echo "Fail";
}
?>
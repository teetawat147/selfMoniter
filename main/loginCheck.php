<?php
include("../include/connection.php");
print_r($_POST);
$sql = "SELECT * FROM `person` WHERE email = :userName and password = MD5(:userPassword)";
$stmt = $conn->prepare($sql);
  $stmt->execute(array(':userName'=> $_POST['username'], ':userPassword'=> $_POST['password']));

  // set the resulting array to associative
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  print_r($result);
  if(count($result)>0){
      
    $_SESSION['personId']=$result[0]['personId'];
    $_SESSION['fname']=$result[0]['fname'];
    $_SESSION['lname']=$result[0]['lname'];
    $_SESSION['personWeight']=$result[0]['personWeight'];
    $_SESSION['personHeight']=$result[0]['personHeight'];
     
      header("Location: ../main/Healthdatarecord.php");
  }else{
    $_SESSION['personId']='';
    $_SESSION['fname']='';
    $_SESSION['lname']='';
    $_SESSION['personWeight']='';
    $_SESSION['personHeight']='';
      header("Location: ../main/login.php");
  }
?>
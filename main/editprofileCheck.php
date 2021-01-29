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
    $_SESSION['cid']=$result[0]['cid'];
    $_SESSION['fname']=$result[0]['fname'];
    $_SESSION['lname']=$result[0]['lname'];
    $_SESSION['phone']=$result[0]['phone'];

     
      header("Location: ../main/Healthdatarecord.php");
  }else{
    $_SESSION['personId']='';
    $_SESSION['cid']='';
    $_SESSION['fname']='';
    $_SESSION['lname']='';
    $_SESSION['phone']='';

      header("Location: ../main/editProfile.php");
  }
?>

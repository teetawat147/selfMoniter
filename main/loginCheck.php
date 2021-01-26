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
      header("Location: ../main/Healthdatarecord.php");
  }else{
    $_SESSION['personId']='';
      header("Location: ../main/login.php");
  }
?>

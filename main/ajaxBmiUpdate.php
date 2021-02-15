<?php
    include('../include/connection.php');


    $sql = "UPDATE bmi SET ". 
    " nameBmi='".$_POST['nameBmi']."' ".
    " ,riskBmi='".$_POST['riskBmi']."' ".
    " ,conclude='".$_POST['conclude']."' ".
    " ,advice='".$_POST['advice']."' ".
    " ,sex1min='".$_POST['sex1min']."' ".
    " ,sex1max='".$_POST['sex1max']."' ".
    " ,sex2min='".$_POST['sex2min']."' ".
    " ,sex2max='".$_POST['sex2max']."' ".
    " WHERE id ='".$_POST['id']."'";

    $result = $conn->prepare($sql);
    $result->execute();
    header('location: ../main/bmiGet.php');
    print_r($result);
?>

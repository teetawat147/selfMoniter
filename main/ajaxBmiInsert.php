<?php
    include('../include/connection.php');

    $sqlInsert = "INSERT INTO bmi(
                    nameBmi,
                    riskBmi,
                    sex1min,
                    sex1max,
                    sex2min,
                    sex2max,
                    conclude,
                    advice
                 )
                 VALUE (
                    '".$_POST['nameBmi']."',
                    '".$_POST['riskBmi']."',
                    '".$_POST['sex1min']."',
                    '".$_POST['sex1max']."',
                    '".$_POST['sex2min']."',
                    '".$_POST['sex2max']."',
                    '".$_POST['conclude']."',
                    '".$_POST['advice']."',
                    )";

    $result = $conn -> prepare($sqlInsert);
    $result -> execute();
    // header("location: ../main/bmiGet.php");
    print_r($result);
?>
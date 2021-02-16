<?php 
    include('../include/connection.php');

    $sql = "UPDATE office
            SET count_person = '".$_POST[count_person]."'
            WHERE office_id = '".$_SESSION['officeId']."' ";

    $result = $conn -> prepare($sql);
    $result -> execute();
    header("location: ../main/adminHealthAmpur.php");

    // print_r($result);
?>
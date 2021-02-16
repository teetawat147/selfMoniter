<?php 
    include('../include/connection.php');

    $sql = "INSERT INTO office(count_person) VALUE ('".$_POST['count_person']."')";

    $result = $conn -> prepare($sql);
    $result -> execute();
    // header("location: ../main/")

    print_r($result);
?>
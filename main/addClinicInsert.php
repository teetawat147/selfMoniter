<?php 
    include("../include/connection.php");
    $datetime = date("Y-m-d H:i:s");

    $sqlInsertClinic = "INSERT INTO clinic(
                            clinicName,
                            ownerFname,
                            ownerLname,
                            cid,
                            address,
                            provinceCode,
                            districtCode,
                            subdistrictCode,
                            email,
                            phone,
                            inputDatetime,
                            personId
                        )
                        VALUE (
                            '".$_POST['clinicName']."',
                            '".$_POST['ownerFname']."',
                            '".$_POST['ownerLname']."',
                            '".$_POST['cid']."',
                            '".$_POST['address']."',
                            '".$_POST['provinceCode']."',
                            '".$_POST['districtCode']."',
                            '".$_POST['subdistrictCode']."',
                            '".$_POST['email']."',
                            '".$_POST['phone']."',
                            '".$datetime."',
                            '".$_SESSION['personId']."'
                        )";
    $result = $conn -> prepare($sqlInsertClinic);
    $result -> execute();
    header('location: ../main/addClinic.php');

    // print_r($result);
    
?>
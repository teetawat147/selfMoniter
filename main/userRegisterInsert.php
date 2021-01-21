 <?php
 print_r($_POST);
 include("../include/connection.php");
 $datetime = date("Y-m-d H:i:s");
//  $sql ="INSERT into office (officeName, personId, inputDatetime) value ('รพ.สว่างแดนดิน', 1, '$datetime')";
 $sql ="INSERT into person (
        cid, 
        fname, 
        lname, 
        phone, 
        address, 
        provinceCode, 
        districtCode, 
        subdistrictCode, 
        officeId, 
        departmentId, 
        personWeight, 
        personHeight, 
        email, 
        password
        )
     
        value (
            '".$_POST['cid']."', 
            '".$_POST['fname']."', 
            '".$_POST['lname']."', 
            '".$_POST['phone']."', 
            '".$_POST['address']."',
            '".$_POST['provinceCode']."', 
            '".$_POST['districtCode']."', 
            '".$_POST['subdistrictCode']."', 
            '".$_POST['officeId']."',
            '".$_POST['departmentId']."', 
            '".$_POST['personWeight']."', 
            '".$_POST['personHeight']."', 
            '".$_POST['email']."', 
            '".$_POST['password']."' 
        )";
 echo $sql ; 
 $result = $conn->prepare($sql);
 $result->execute();
header("Location: ../main/consent.php");
 ?>
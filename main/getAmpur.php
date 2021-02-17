<?php
include("../include/connection.php");

$sql ="select * from ampur where changwat_code='".$_POST['provinceCode']."' ";
$result = $conn->prepare($sql);
$result->execute();?>
<label for="districtCode">อำเภอ</label>
<select name='districtCode' id='districtCode' class='form-control' required data-error-msg="กรุณากรอกชื่ออำเภอ">
    <option selected disabled>Choose...</option>
    <?php
    while($row = $result->fetch()) {
        ?>        
        <option value="<?php echo $row['ampur_code'];?>" <?php echo (isset($_POST['districtCode']) and $_POST['districtCode']==$row['ampur_code'])?"selected":"";?>><?php echo $row['ampur_name'];?></option>
        <?php
    }
    ?>
</select>

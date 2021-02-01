<?php
include("../include/connection.php");

$sql ="select * from tambon where ampur_code_full='".$_POST['provinceCode'].$_POST['districtCode']."' ";
$result = $conn->prepare($sql);
$result->execute();?>
<label for="subdistrictCode">ตำบล</label>
<select name='subdistrictCode' id='subdistrictCode' class='form-control' required data-error-msg="กรุณากรอกชื่อตำบล">
    <option selected disabled>Choose...</option>
    <?php
    while($row = $result->fetch()) {
        ?>        
        <option value="<?php echo $row['tambon_code'];?>"><?php echo $row['tambon_name'];?></option>
        <?php
    }
    ?>
</select>

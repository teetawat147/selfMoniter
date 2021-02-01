<?php
include("../include/connection.php");

$sql ="select * from department where officeId='".$_POST['officeId']."' ";
$result = $conn->prepare($sql);
$result->execute();?>
<label for="departmentId">แผนกงาน</label>
<select name='departmentId' id='departmentId' class='form-control' required data-error-msg="กรุณากรอกชื่อแผนกงาน">
    <option selected disabled>Choose...</option>
    <?php
    while($row = $result->fetch()) {
        ?>        
        <option value="<?php echo $row['departmentId'];?>"><?php echo $row['departmentName'];?></option>
        <?php
    }
    ?>
    
</select>


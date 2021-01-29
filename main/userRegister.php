<?php
include("../include/connection.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>ลงทะเบียน</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" > -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" >
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" > -->
    
    
     <style>
        .container {
  width: 100%;
}

.progressbar {
  counter-reset: step;
}
.progressbar li {
  list-style: none;
  display: inline-block;
  width: 30.33%;
  position: relative;
  text-align: center;
  cursor: pointer;
}
.progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  line-height : 30px;
  border: 1px solid #ddd;
  border-radius: 1%;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  background-color: #fff;
}
.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 1px;
  background-color: #ddd;
  top: 15px;
  left: -50%;
  z-index : -1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.active {
  color: green;
}
.progressbar li.active:before {
  border-color: green;
} 
.progressbar li.active + li:after {
  background-color: green;
}

.progressive {
    padding-top: 20px;
}

.body {
    margin-top: 15px;
}

.button {
    display: flex;
    justify-content: center;
}

.btn-cancel,
.btn-next
{
    border-radius: 5px;
    padding: 10px 30px;
    background: #C4C4C4;
    margin: 0px 50px;
}
.has-error .help-block{
    color: red;
}
</style>
</head>
<body>
    <fieldset id="userRegister" style="display:block;">
        <div class = "container">
        <center>
        <div class="container progressive">
            <ul class="progressbar">
                <li class="active">ลงทะเบียน</li>
                <li >ข้อตกลง</li>
            </ul>
        </div>
        </center>
          <h3>ลงทะเบียน</h3>
    <form class="form" action="userRegisterInsert.php" method="POST">
        <input type="hidden" name="lineId" id="lineId" value="<?php echo (isset($_GET['lineId']))?$_GET['lineId']:"";?>" >
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="cid">เลขบัตรประจำตัวประชาชน</label>
                <input name="cid" id="cid" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเลขบัตรประจำตัวประชาชน">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fname">ชื่อ</label>
                <input name="fname" id="fname" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อ">
            </div>
        

        
            <div class="form-group col-md-6">
                <label for="lname">นามสกุล</label>
                <input name="lname" id="lname" class="form-control" min="3"  type="text" data-error-msg="กรุณากรอกนามสกุล">
            </div>
        </div>

        

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="sexId">เพศ</label>
                <select name='sexId' id='sexId' class='form-control' required data-error-msg="กรุณากรอกชื่อหน่วยงาน">
                    <option selected disabled>Choose...</option>
                    <?php 
                    $sql ="select * from sex";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['sexId'];?>"><?php echo $row['sexName'];?></option>
                        <?php   
                    }
                    ?>
                </select>
            </div>
                 
            <div class="form-group col-md-6">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input name="phone" id="phone" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเบอร์โทรศัพท์">
                
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">ที่อยู่</label>
                <input name="address" id="address" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกที่อยู่">
                
            </div>
        

       
            <div class="form-group col-md-6">
                <label for="province">จังหวัด</label>
                <input name="provinceCode" id="province" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกจังหวัด">
                
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="district">อำเภอ</label>
                <input name="districtCode" id="district" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกอำเภอ">
               
            </div>
        
     
        
            <div class="form-group col-md-6">
                <label for="subdistrict">ตำบล</label>
                <input name="subdistrictCode" id="subdistrict" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกตำบล">
               
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="officeId">ชื่อหน่วยงาน</label>
                <select name='officeId' id='officeId' class='form-control' required data-error-msg="กรุณากรอกชื่อหน่วยงาน">
                    <option selected disabled>เลือกหน่วยงาน</option>
                    <?php 
                    $sql ="select * from office";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['office_id'];?>"><?php echo $row['office_name'];?></option>
                        <?php   
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="departmentId">ชื่อแผนก</label>
                <select name='departmentId' id='departmentId' class='form-control' required data-error-msg="กรุณากรอกชื่อหน่วยงาน">
                    <option selected disabled>เลือกแผนก</option>
                    <?php 
                    $sql ="select * from department";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['departmentId'];?>"><?php echo $row['departmentName'];?></option>
                        <?php   
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="personWeight">น้ำหนัก</label>
                <input name="personWeight" id="personWeight" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกน้ำหนัก">
            </div>
        
            <div class="form-group col-md-6">
                <label for="personHeight">ส่วนสูง</label>
                <input name="personHeight" id="personHeight" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกส่วนสูง">
                
            </div>
        </div>
  
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email">Email</label>
                <input name="email" id="email" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอก Email">
            </div>
         
            <div class="form-group col-md-12">
                <label for="password">Password</label>
                <input name="password" id="password" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอก Password">
            </div>
        </div>

            <center>
                <button type="submit" class="btn btn-primary">ถัดไป</button> 
                <button type="button" class="btn btn-primary">ยกเลิก</button>              
            </center> 

    </fieldset>          
    </form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>

  </body>
</html>

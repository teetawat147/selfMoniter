<?php
include("../include/connection.php");
print_r($_SESSION);
if (!$_SESSION['personId']){
    header("Location: ../main/login.php.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    

<body>
<div class = "container">
        <center>
        <h3>แก้ไขข้อมูลส่วนตัว</h3>
        </center>

<form action="editprofileUpdate.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputnumId">เลขบัตรประจำตัวประชาชน</label>
                <!-- <input type="numId" class="form-control" id="inputnumId" placeholder="เลขบัตรประจำตัวประชาชน"> -->
                <input id="inputnumId" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน" value="<?php echo $_SESSION['cid']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fname">ชื่อ</label>
                <input name="fname" id="fname" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อ" placeholder="ชื่อ" value="<?php echo $_SESSION['fname']; ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="lname">นามสกุล</label>
                <input name="lname" id="lname" class="form-control" min="3"  type="text" data-error-msg="กรุณากรอกนามสกุล" placeholder="นามสกุล" value="<?php echo $_SESSION['lname']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputphon">เบอร์โทรศัพท์</label>
                <input type="phon" class="form-control" id="inputphon" placeholder="เบอร์โทรศัพท์" value="<?php echo $_SESSION['phone']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputaddress">ที่อยู่</label>
                <input type="address" class="form-control" id="inputaddress" placeholder="ที่อยู่" value="<?php echo $_SESSION['address']; ?>">
            </div>
        
       
            <div class="form-group col-md-6">
                <label for="inputprovince">จังหวัด</label>
                <input type="province" class="form-control" id="inputprovince" placeholder="จังหวัด" value="<?php echo $_SESSION['provinceCode']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputdistrict">อำเภอ</label>
                <input type="district" class="form-control" id="inputdistrict" placeholder="อำเภอ" value="<?php echo $_SESSION['districtCode']; ?>">
            </div>
        
            <div class="form-group col-md-6">
                <label for="inputsubdistrict">ตำบล</label>
                <input type="subdistrict" class="form-control" id="inputsubdistrict" placeholder="ตำบล" value="<?php echo $_SESSION['subdistrictCode']; ?>">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputemail">Email</label>
                <input type="email" class="form-control" id="inputemail" placeholder="Email" value="<?php echo $_SESSION['email']; ?>">
            </div>

            <div class="text-center col-12" style="display: inline-block;" >
                <button type="submit" class="btn btn-primary" >ตกลง</button>
                <button type="cancel" class="btn btn-primary" >ยกเลิก</button>
            </div>

        </fieldset>          
    </form>
    </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>
    
        <script>
        function showConsent() 
        {
        document.getElementById("consent").style.display = "block";
        document.getElementById("userRegister").style.display = "none";
        }

    </script>
    
</body>
</html>
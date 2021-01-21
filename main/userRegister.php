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
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
    <fieldset   id="userRegister" style="display:block;">
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
            <div class="form-group col-md-12">
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
                    <option selected disabled>Choose...</option>
                    <?php 
                    $sql ="select * from office";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['officeId'];?>"><?php echo $row['officeName'];?></option>
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
                    <option selected disabled>Choose...</option>
                    <option value="1">แผนก A</option>
                    <option value="2">แผนก B</option>
                    <option value="dep C">แผนก C</option>
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
                <button type="button" class="btn btn-primary">ยกเลิก</button>
                <button type="submit" class="btn btn-primary" onclick="showConsent()">ถัดไป</button>
                
            </center> 

    </fieldset>          
    </form>

    
    <fieldset id="consent" style="display:none;">
        <div class = "container">
        <center>
        <div class="container progressive" style="margin-left: 0px;">
            <ul class="progressbar">
                <li class="active">ลงทะเบียน</li>
                <li class="active">ข้อตกลง</li>
            </ul>
        </div>
        </center>
    
        <br>
        <center><h5>ข้อตกลงการใช้งาน</h5></center>
        <br>
        <center>
            <label>
                1.ข้อมูลภายใน Web Application นี้ และ ประชาชนหรือผู้ป่วยที่ปรากฎชื่อภายใน<br>
                 Web Application ซึ่งถือว่าเป็นเจ้าของข้อมูล ได้รับความคุ้มครองตาม<br>
                 `พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒`<br>
                 <br>
            </label>
        </center>

        <center>
            <label>
                2.ผู้ใช้งาน Web Application ทุกระดับ และ ผู้ดูแลระบบทุกระดับ ที่กระทำการเปิดเผยข้อมูลอันปรากฏภายใน <br>
                Web Application หรือกระทำการอื่นใดอันเป็นการฝ่าฝืน <br>
                `พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒` ต้องระวางโทษหรือปรับตามมาตราที่กระทำผิด<br>
                <br>
            </label>
        </center>
       
       <center>
            <button type="button" class="btn btn-primary">ย้อนกลับ</button>
            <button type="button" class="btn btn-primary">ยกเลิก</button>
                       
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            ยืนยันข้อตกลง</button>
            <!-- <button type="button" class="btn btn-primary" onclick="showDialog();">
            ยืนยันข้อตกลง</button> -->
        </center>
    </fieldset>
    


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันน้ำหนักและส่วนสูง</h5>
        </button>
        </div>
        <div class="modal-body">

      <form>
          <div class="form-group col-md-12">
              <label for="weight">น้ำหนัก</label>
              <input type="weight" class="form-control" id="weight" placeholder="น้ำหนัก">
              <label for="weight">กิโลกรัม</label>              
          </div>

          <div class="form-group col-md-12">
              <label for="height">ส่วนสูง</label>
              <input type="height" class="form-control " id="height" placeholder="ส่วนสูง">
              <label for="height">เซนติเมตร</label>
          </div> 
      </form>
      
          
          <!-- <div class="modal-footer"> -->
          <center>
              <button type="button" class="btn btn-primary">ตกลง</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button> 
          </center>
          </div>
      
      </div> 
    </div>    
  </div>
</div>


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
            if ($('form').validator('check') < 1) {
                // alert('กรอกข้อมูลครบ');
                document.getElementById("consent").style.display = "block";
                document.getElementById("userRegister").style.display = "none";
                //submit
            }else{
                // alert('กรอกข้อมูลไม่ครบ');
            }
        // document.getElementById("consent").style.display = "block";
        // document.getElementById("userRegister").style.display = "none";
        }

        // $(function() {
        // $('form').validator({
        //     validHandlers: {
        //         '.customhandler':function(input) {
        //             //may do some formatting before validating
        //             input.val(input.val().toUpperCase());
        //             //return true if valid
        //             return input.val() === 'JQUERY' ? true : false;
        //             }
        //         }
        //     });

        // })

        function showDialog()
        {
            $("#exampleModalLong").modal("show");
        }

    </script>
  </body>
</html>

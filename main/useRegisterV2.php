<!doctype html>
<html lang="en">
<head>
    <title>userRegister</title>
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
    <form>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputnumId">เลขบัตรประจำตัวประชาชน</label>
                <input type="numId" class="form-control" id="inputnumId" placeholder="เลขบัตรประจำตัวประชาชน">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputfname">ชื่อ</label>
                <input type="fname" class="form-control" id="inputfname" placeholder="ชื่อ">
            </div>
        
        
            <div class="form-group col-md-6">
                <label for="inputlname">นามสกุล</label>
                <input type="lname" class="form-control" id="inputlname" placeholder="นามสกุล">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputphon">เบอร์โทรศัพท์</label>
                <input type="phon" class="form-control" id="inputphon" placeholder="เบอร์โทรศัพท์">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputaddress">ที่อยู่</label>
                <input type="address" class="form-control" id="inputaddress" placeholder="ที่อยู่">
            </div>
        
       
            <div class="form-group col-md-6">
                <label for="inputprovince">จังหวัด</label>
                <input type="province" class="form-control" id="inputprovince" placeholder="จังหวัด">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputdistrict">อำเภอ</label>
                <input type="district" class="form-control" id="inputdistrict" placeholder="อำเภอ">
            </div>
        
     
        
            <div class="form-group col-md-6">
                <label for="inputsubdistrict">ตำบล</label>
                <input type="subdistrict" class="form-control" id="inputsubdistrict" placeholder="ตำบล">
            </div>
        </div>
        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="agency">ชื่อหน่วยงาน</label>
                <select id="agency" class="form-control">
                <option selected>Choose...</option>
                <option>หน่วยงาน A</option>
                <option>หน่วยงาน B</option>
                </select>
            </div>
        </div>
        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="department">ชื่อแผนก</label>
                <select id="department" class="form-control">
                <option selected>Choose...</option>
                <option>แผนก A</option>
                <option>แผนก B</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputweight">น้ำหนัก</label>
                <input type="weight" class="form-control" id="inputweight" placeholder="น้ำหนัก">
            </div>
        
     
        
            <div class="form-group col-md-6">
                <label for="inputheight">ส่วนสูง</label>
                <input type="height" class="form-control" id="inputheight" placeholder="ส่วนสูง">
            </div>
        </div>
  
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputemail">Email</label>
                <input type="email" class="form-control" id="inputemail" placeholder="Email">
            </div>
        
     
        
            <div class="form-group col-md-12">
                <label for="inputPassword">Password</label>
                <input type="subPassword" class="form-control" id="inputPassword" placeholder="Password">
            </div>
        </div>
            <center>
                <button type="button" class="btn btn-primary">ยกเลิก</button>
                <button type="button" class="btn btn-primary" onclick="showConsent()">ถัดไป</button>
                
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
            <button type="back" class="btn btn-primary">ย้อนกลับ</button>
            <button type="cancel" class="btn btn-primary">ยกเลิก</button>
                       
        <!-- Button trigger modal -->
            <button type="confirm" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            ยืนยันข้อตกลง</button>
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
    <script>
        function showConsent() 
        {
        document.getElementById("consent").style.display = "block";
        document.getElementById("userRegister").style.display = "none";
        }
    </script>
  </body>
</html>
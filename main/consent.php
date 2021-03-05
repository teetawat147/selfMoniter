<?php
include("../include/connection.php");
// print_r($_SESSION);
if (!$_SESSION['fname']){
    header("Location: ../main/login.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>consent</title>
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
    <div class = "container">
      <center>
        <div class="container progressive" style="margin-left: 0px;">
          <ul class="progressbar">
            <li class="active">ลงทะเบียน</li>
            <li class="active">ข้อตกลง</li>
          </ul>
        </div>
      </center><br>
      <center><h5>ข้อตกลงการใช้งาน</h5></center><br>

      <center>
        <label>
          1.ข้อมูลภายใน Web Application นี้ และ ประชาชนหรือผู้ป่วยที่ปรากฎชื่อภายใน<br>
            Web Application ซึ่งถือว่าเป็นเจ้าของข้อมูล ได้รับความคุ้มครองตาม<br>
            `พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒`<br><br>
        </label>
      </center>
  
      <center>
        <label>
          2.ผู้ใช้งาน Web Application ทุกระดับ และ ผู้ดูแลระบบทุกระดับ ที่กระทำการเปิดเผยข้อมูลอันปรากฏภายใน <br>
          Web Application หรือกระทำการอื่นใดอันเป็นการฝ่าฝืน <br>
          `พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒` ต้องระวางโทษหรือปรับตามมาตราที่กระทำผิด<br><br>
        </label>
      </center>
       
      <center>
        <a class="btn btn-primary" href="../main/userRegister.php" role="button">ย้อนกลับ</a>
        <button type="cancel" class="btn btn-primary">ยกเลิก</button>
                       
        <!-- Button trigger modal -->
        <button type="confirm" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        ยืนยันข้อตกลง</button>
      </center>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันน้ำหนักและส่วนสูง</h5>
            </div>

            <div class="modal-body">
              <form class="form" action="consentUpdate.php" method="POST">
                <div class="form-group col-md-6">
                  <label for="personWeight">น้ำหนัก</label>
                  <input type="text" class="form-control" name="personWeight" id="personWeight" placeholder="น้ำหนัก" value="<?php echo $_SESSION['personWeight']; ?>">
                  <label for="personWeight">กิโลกรัม</label>              
                </div>

                <div class="form-group col-md-6">
                  <label for="personHeight">ส่วนสูง</label>
                  <input type="text" class="form-control" name="personHeight" id="personHeight" placeholder="ส่วนสูง" value="<?php echo $_SESSION['personHeight']; ?>">
                  <label for="personHeight">เซนติเมตร</label>
                </div>  

                <center>
                  <button type="submit" class="btn btn-primary">ตกลง</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button> 
                </center>
              </form>
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
  </body>
</html>
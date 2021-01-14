<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>consent</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">


    <style>
        /* .container {
            width: 100%;
        } */

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
    </style>
</head>

<body>
<div class="container progressive">
    <center>
      <ul class="progressbar">
        <li class="active">ลงทะเบียน</li>
        <li>ข้อตกลงการใช้งาน</li>
      </ul>
    </center>
    </div>

    <!-- <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins"> -->
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                
                    <center>
                    <h1 class="title">ข้อตกลงการใช้งาน</h1>
                    </center>
                    <form method="POST">
                        
                       
                                    <label class="label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    1.ข้อมูลภายใน Web Application นี้ และ
                                    ประชาชนหรือผู้ป่วยที่ปรากฏชื่อภายใน 
                                    Web Application ซึ่งถือว่าเป็นเจ้าของข้อมูล ได้รับความคุ้มครองตาม 
                                    'พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒' 
                                    </label>
                                    <br>
                                    
                                    <label class="label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    2.ผู้ใช้งาน Web Application ทุกระดับ และผู้ดูแลระบบทุกระดับ
                                    ที่กระทำการเปิดเผยข้อมูลอันปรากฎภายใน Web Application หรือกระทำการอื่นใด
                                    อันเป็นการฝ่าฝืน'พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ.๒๕๖๒'
                                    ต้องระวางโทษหรือปรับตามมาตราที่กระทำผิด
                                    
                                    <br>
                                    
                                    </label>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="back">ย้อนกลับ</button>
                            
                            <button class="btn btn--radius-2 btn--blue" type="cancel">ยกเลิก</button>
                            
                            <button class="btn btn--radius-2 btn--blue" type="OK">ยืนยันข้อตกลง</button>                             
                    </form>

                    <!-- <from method="post" action = "popupData.php"></form> -->
                    <body>
     <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body wrapper">
                
                    <center>
                    <h1 class="title">ยืนยันน้ำหนักส่วนสูง</h1>
                    </center>
                    
                    <center>
                    <form method="POST">
                      
                    <div class="col-2">
                                <div class="input-group weight">
                                    <label class="label content">น้ำหนัก</label>
                                    <input class="input--style-4" type="text" name="district">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ส่วนสูง</label>
                                    <input class="input--style-4" type="text" name="subDistrict">
                                </div>
                            </div>
                    </center>     
                        <div class="p-t-15">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <button class="btn btn--radius-2 btn--blue" type="cancel">ตกลง</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn--radius-2 btn--blue" type="next">ยกเลิก</button>                                                                              
                    </form>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
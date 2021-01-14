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
    <title>popupData</title>

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
        .weight
        {
            display: flex;
            justify-content: space-between;
        }

         .content
        {
            width: 50px;
        } 
    </style>
</head>

<body>
<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">ลงทะเบียน</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">เลขบัตรประจำตัวประชาชน</label>
                                    <input class="input--style-5" type="text" name="numId">
                                </div>
                            </div>
                        </div> 
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ชื่อ</label>
                                    <input class="input--style-5" type="text" name="firstName">
                                </div>
                            </div>
                       
                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">นามสกุล</label>
                                    <input class="input--style-5" type="text" name="lastName">
                                </div>
                            </div>
                        
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">เบอร์โทรศัพท์</label>
                                    <input class="input--style-5" type="text" name="phone">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ที่อยู่</label>
                                    <input class="input--style-5" type="text" name="address">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">จังหวัด</label>
                                    <input class="input--style-5" type="text" name="province">
                                </div>
                            </div> 
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">อำเภอ</label>
                                    <input class="input--style-5" type="text" name="district">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ตำบล</label>
                                    <input class="input--style-5" type="text" name="subDistrict">
                                </div>
                            </div>

                            <div class="input-group">
                            <label class="label">ชื่อหน่วยงาน</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="agency">
                                    <option disabled="disabled" selected="selected"> </option>
                                    <option>หน่วยงาน A</option>
                                    <option>หน่วยงาน B</option>
                                    <option>หน่วยงาน C</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                            </div> 

                            <div class="input-group">
                            <label class="label">ชื่อแผนก</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="department">
                                    <option disabled="disabled" selected="selected"> </option>
                                    <option>แผนก A</option>
                                    <option>แผนก B</option>
                                    <option>แผนก C</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                            </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">น้ำหนัก</label>
                                    <input class="input--style-4" type="email" name="weight">
                                </div>
                            </div>
                        
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ส่วนสูง</label>
                                    <input class="input--style-4" type="text" name="height">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-5" type="email" name="email">
                                </div>
                            </div>
                        </div>

                        
                        <div class="p-t-15">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <button class="btn btn--radius-2 btn--blue" type="cancel">ยกเลิก</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn--radius-2 btn--blue" type="next">ถัดไป</button>   
                            
                            
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                
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
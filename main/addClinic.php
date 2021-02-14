<?php
    include("../include/connection.php");

    if(!$_SESSION['fname']) {
        header("location: ../main/login.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>ข้อมูลสถานพยาบาล</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
     <style>
        body {
            margin: 5px;
            padding: 5px;
        }

        button {
            width: 8ch;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>ข้อมูลสถานพยาบาล</h3>

        <form action="addClinicInsert.php" method="POST">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="clinicName">ชื่อคลินิก</label>
                    <input type="text" class="form-control" id="clinicName" name="clinicName" required data-error-msg="กรุณากรอกชื่อคลินิก" placeholder="กรอกชื่อคลินิก">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ownerFname">ชื่อเจ้าของกิจการ</label>
                    <input type="text" class="form-control" id="ownerFname" name="ownerFname" required data-error-msg="กรุณากรอกชื่อเจ้าของกิจการ" placeholder="กรอกชื่อเจ้าของกิจการ">
                </div>

                <div class="form-group col-md-6">
                    <label for="ownerLname">นามสกุล</label>
                    <input type="text" class="form-control" id="ownerLname" name="ownerLname" required data-error-msg="กรุณากรอกนามสกุลเจ้าของกิจการ" placeholder="กรอกนามสกุลเจ้าของกิจการ">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cid">เลขบัตรประจำตัว</label>
                    <input type="text" class="form-control" id="cid" name="cid" required data-error-msg="กรุณากรอกเลขบัตรประจำตัว" placeholder="กรอกเลขบัตรประจำตัว">
                </div>

                <div class="form-group col-md-6">
                    <label for="address">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" name="address" required data-error-msg="กรุณากรอกที่อยู่" placeholder="กรอกที่อยู่">
                </div>
            </div>
              
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="provinceCode">จังหวัด</label>
                    <select name='provinceCode' id='provinceCode' class='form-control' required data-error-msg="กรุณากรอกชื่อจังหวัด" placeholder="กรอกชื่อจังหวัด">
                        <option selected disabled>เลือกจังหวัด...</option>
                        <?php 
                        $sql ="select * from changwat order by changwat_name";
                        $result = $conn->prepare($sql);
                        $result->execute();
                        while($row = $result->fetch()) {
                            ?>
                            <option value="<?php echo $row['changwat_code'];?>"><?php echo $row['changwat_name'];?></option>
                            <?php   
                        }
                        ?>
                    </select>
                </div>

                <div id="div-districtCode" class="form-group col-md-6">
                    <label for="districtCode">อำเภอ</label>
                    <select name='districtCode' id='districtCode' class='form-control' required data-error-msg="กรุณากรอกชื่ออำเภอ" placeholder="กรอกชื่ออำเภอ">
                        <option selected disabled>เลือกอำเภอ</option>
                    </select>              
                </div>
            </div>

            <div class="form-row">
                <div id="div-subdistrictCode" class="form-group col-md-6">
                    <label for="subdistrictCode">ตำบล</label>
                    <select name='subdistrictCode' id='subdistrictCode' class='form-control' required data-error-msg="กรุณากรอกชื่อตำบล" placeholder="กรอกชื่อตำบล">
                        <option selected disabled>เลือกตำบล</option>
                    </select>              
                
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required data-error-msg="กรุณากรอกที่อยู่อีเมล์" placeholder="กรอกที่อยู่อีเมล์">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="phone">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="phone" name="phone" required data-error-msg="กรุณากรอกหมายเลขเบอร์โทรศัพท์" placeholder="กรอกหมายเลขเบอร์โทรศัพท์">
                </div>
            </div>

            <center>
                <button type="submit" class="btn btn-primary">ตกลง</button>
                <button type="button" class="btn btn-secondary" onclick='location.href="../main/index.php"'>ยกเลิก</button>
            </center>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>

    <script>
        $(function(){
            $("#provinceCode").change(function(){
                let provinceCode = $(this).val();
                // alert(provinceCode);
                $.ajax({
                    method: "POST",
                    url: "getAmpur.php",
                    data: { provinceCode: provinceCode}
                }).done(function( msg ) {
                    $("#div-districtCode").html(msg);
                    let tambonmsg= '<label for="subdistrictCode">ตำบล</label>';
                        tambonmsg+='<select name="subdistrictCode" id="subdistrictCode" class="form-control" required data-error-msg="กรุณากรอกชื่อตำบล">';
                        tambonmsg+='<option selected disabled>เลือกอำเภอ</option>';
                        tambonmsg+='</select>';            
                    $("#div-subdistrictCode").html(tambonmsg);                   
                });
            })
            $("#div-districtCode").on("change","#districtCode",function(){              
                let districtCode = $(this).val();
                let provinceCode = $("#provinceCode").val();
                $.ajax({
                    method: "POST",
                    url: "getTambon.php",
                    data: { provinceCode: provinceCode, districtCode:districtCode }
                }).done(function( msg ) {
                    $("#div-subdistrictCode").html(msg);
                    
                });
            })
        });
    </script>   

  </body>
</html>

<?php
include("../include/connection.php");

$sql ="select * from person WHERE personId = '".$_GET['personId']."' ";
$result = $conn->prepare($sql);
$result->execute();
$rowEdit = $result->fetch();

?>
<!doctype html>
<html lang="en">
<head>
    <title>editPersonUpdate</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


    
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
    <?php
        include "./header.php";
        ?>

    <fieldset id="personUpdate" style="display:block;">
        <div class = "container">
            <center><h3>แก้ไขข้อมูล</h3></center><br>
            <form action="editSavePersonUpdate.php" method="POST">
                <input type="hidden" name="lineId" id="lineId" value="<?php echo (isset($_GET['lineId']))?$_GET['lineId']:"";?>" >
        
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cid">เลขบัตรประจำตัวประชาชน</label>
                            <input name="cid" id="cid" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน" value="<?php echo $rowEdit['cid']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">ชื่อ</label>
                            <input name="fname" id="fname" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อ" placeholder="ชื่อ" value="<?php echo $rowEdit['fname']; ?>">
                        </div>
                    

                    
                        <div class="form-group col-md-6">
                            <label for="lname">นามสกุล</label>
                            <input name="lname" id="lname" class="form-control" min="3"  type="text" data-error-msg="กรุณากรอกนามสกุล" placeholder="นามสกุล" value="<?php echo $rowEdit['lname']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="birthdate">วันเกิด</label>
                            <input name="birthdate" id="birthdate" class="form-control" min="3" required type="date" data-error-msg="กรุณากรอกวันเกิด" placeholder="วันเกิด" value="<?php echo $rowEdit['birthdate']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sexId">เพศ</label>
                            <select name='sexId' id='sexId' class='form-control' required data-error-msg="กรุณาเลือกเพศ" >
                                <?php 
                                $sql ="select * from sex";
                                $result = $conn->prepare($sql);
                                $result->execute();
                                while($row = $result->fetch()) {
                                    ?>
                                    <option value="<?php echo $row['sexId'];?>" <?php echo ($rowEdit['sexId']==$row['sexId'])?"selected":"";?>><?php echo $row['sexName'];?></option>
                                    <?php   
                                }
                                ?>
                            </select>
                        </div>
                            
                        <div class="form-group col-md-6">
                            <label for="phone">เบอร์โทรศัพท์</label>
                            <input name="phone" id="phone" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเบอร์โทรศัพท์" placeholder="เบอร์โทรศัพท์" value="<?php echo $rowEdit['phone']; ?>">
                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">ที่อยู่</label>
                            <input type="address" class="form-control" name="address" id="address" placeholder="ที่อยู่" value="<?php echo $rowEdit['address']; ?>">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="provinceCode">จังหวัด</label>
                            <select name='provinceCode' id='provinceCode' class='form-control' required data-error-msg="กรุณาเลือกชื่อจังหวัด" >
                                <option selected disabled>Choose...</option>
                                <?php 
                                $sql ="select * from changwat order by changwat_name";
                                $result = $conn->prepare($sql);
                                $result->execute();
                                while($row = $result->fetch()) { 
                                    ?>
                                    <option value="<?php echo $row['changwat_code'];?>" <?php echo ($rowEdit['provinceCode']==$row['changwat_code'])?"selected":"";?>><?php echo $row['changwat_name'];?></option>
                                    <?php   
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div id="div-districtCode" class="form-group col-md-6">
                            <label for="districtCode">อำเภอ</label>
                            <select name='districtCode' id='districtCode' class='form-control' required data-error-msg="กรุณาเลือกชื่ออำเภอ" >
                                <option selected disabled>Choose...</option>
                            </select>              
                        </div>
                    
                        <div id="div-subdistrictCode" class="form-group col-md-6">
                            <label for="subdistrictCode">ตำบล</label>
                            <select name='subdistrictCode' id='subdistrictCode' class='form-control' required data-error-msg="กรุณาเลือกชื่อตำบล" >
                                <option selected disabled>Choose...</option>
                            </select>              
                        </div>
                    </div>

                    <div class="form-row">   
                        <div  class="form-group col-md-12">
                            <label for="officeId">ชื่อหน่วยงาน</label>
                            <select name='officeId' id='officeId' class='form-control' required data-error-msg="กรุณาเลือกชื่อหน่วยงาน" >
                                <?php 
                                $sql ="select * from office";
                                $result = $conn->prepare($sql);
                                $result->execute();
                                while($row = $result->fetch()) {
                                    ?>
                                    <option value="<?php echo $row['office_id'];?>" <?php echo ($rowEdit['officeId']==$row['office_id'])?"selected":"";?>><?php echo $row['office_name'];?></option>
                                    <?php
                                }
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">   
                        <div  class="form-group col-md-12">
                            <label for="departmentId">ชื่อแผนก</label>
                            <select name='departmentId' id='departmentId' class='form-control' required data-error-msg="กรุณาเลือกชื่อแผนก" >
                                <?php 
                                $sql ="select * from department where officeId = '".$rowEdit['officeId']."' ";
                                $result = $conn->prepare($sql);
                                $result->execute();
                                while($row = $result->fetch()) {
                                    ?>
                                    <option value="<?php echo $row['departmentId'];?>" <?php echo ($rowEdit['departmentId']==$row['departmentId'])?"selected":"";?>><?php echo $row['departmentName'];?></option>
                                    <?php   
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="personWeight">น้ำหนัก</label>
                            <input name="personWeight" id="personWeight" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกน้ำหนัก" placeholder="น้ำหนัก" value="<?php echo $rowEdit['personWeight']; ?>">
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label for="personHeight">ส่วนสูง</label>
                            <input name="personHeight" id="personHeight" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกส่วนสูง" placeholder="ส่วนสูง" value="<?php echo $rowEdit['personHeight']; ?>">
                        </div>
                    </div>
  
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input name="email" id="email" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอก Email" groupName="Email" value="<?php echo $rowEdit['email']; ?>">
                        </div>  
                    </div>
                    
                    <div class="form-row">   
                    <div  class="form-group col-md-12">
                        <label for="groupId">สิทธิ์การใช้งาน</label>
                        <select name='groupId' id='groupId' class='form-control' required data-error-msg="กรุณาเลือกสิทธิ์การใช้งาน" >
                            <?php 
                            $sql ="select * from `group`";
                            $result = $conn->prepare($sql);
                            $result->execute();
                            while($row = $result->fetch()) {
                                ?>
                                <option value="<?php echo $row['groupId'];?>" <?php echo ($rowEdit['groupId']==$row['groupId'])?"selected":"";?>><?php echo $row['groupName'];?></option>
                                <?php   
                            }
                            ?>
                        </select>
                    </div>
                </div>    

            <center>
                <input type="hidden" name="personId" id="personId" value="<?php echo $rowEdit['personId']; ?>">
                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                <a href="../main/personGet.php" class="btn btn-primary" role="button" aria-pressed="true">ยกเลิก</a>

            </center> 
    </fieldset>          
    </form>
</div>
                  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>


    <script>
        function getAmpur(provinceCode, districtCode){
            $.ajax({
                method: "POST",
                url: "getAmpur.php",
                data: { provinceCode: provinceCode ,districtCode: districtCode }
            }).done(function( msg ) {
                $("#div-districtCode").html(msg);
                let tambonmsg= '<label for="subdistrictCode">ตำบล</label>';
                    tambonmsg+='<select name="subdistrictCode" id="subdistrictCode" class="form-control" required data-error-msg="กรุณากรอกชื่อตำบล">';
                    tambonmsg+='<option selected disabled>Choose...</option>';
                    tambonmsg+='</select>';            
                $("#div-subdistrictCode").html(tambonmsg);                   
            });
        }

        function getTambon(provinceCode,districtCode,subdistrictCode){
            $.ajax({
                    method: "POST",
                    url: "getTambon.php",
                    data: { provinceCode: provinceCode, districtCode:districtCode , subdistrictCode: subdistrictCode }
            }).done(function( msg ) {
                    $("#div-subdistrictCode").html(msg);
            });

        }
        $(function(){

            $("#provinceCode").val("<?php echo $rowEdit['provinceCode'];?>");
            getAmpur($("#provinceCode").val(),"<?php echo $rowEdit['districtCode'];?>");

            $("#districtCode").val("<?php echo $rowEdit['districtCode'];?>");
            getTambon($("#provinceCode").val(),"<?php echo $rowEdit['districtCode'];?>","<?php echo $rowEdit['subdistrictCode'];?>");

            $("#provinceCode").change(function(){
                let provinceCode = $(this).val();
                // alert(provinceCode);
                getAmpur(provinceCode);
            })
            $("#div-districtCode").on("change","#districtCode",function(){              
                let districtCode = $(this).val();
                let provinceCode = $("#provinceCode").val();
                getTambon(provinceCode,districtCode);
            })
        });

        $(function(){
            $("#officeId").change(function() {               
                let officeId = $(this).val();                 
                $.ajax({
                    method: "POST",
                    url: "getDepartment.php",
                    data: { officeId: officeId}
                }).done(function(msg) {
                    // alert(msg);
                    $("#departmentId").html(msg);
                });
            })
        });
    </script>
  </body>
</html>

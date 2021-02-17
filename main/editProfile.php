<?php
include("../include/connection.php");
// print_r($_SESSION);

if (!$_SESSION['personId']){
    header("Location: ../main/login.php");
}

$sql ="select * from person WHERE personId = '".$_SESSION['personId']."' ";
$result = $conn->prepare($sql);
$result->execute();
$rowPerson = $result->fetch();
?>
<!doctype html>
<html lang="en">
<head>
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
<body>
    <div class = "container">
        <center><h3>แก้ไขข้อมูลส่วนตัว</h3></center>
        <form action="editprofileUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cid">เลขบัตรประจำตัวประชาชน</label>
                    <input name="cid" id="cid" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกเลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน" value="<?php echo $rowPerson['cid']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">ชื่อ</label>
                    <input name="fname" id="fname" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อ" placeholder="ชื่อ" value="<?php echo $rowPerson['fname']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="lname">นามสกุล</label>
                    <input name="lname" id="lname" class="form-control" min="3"  type="text" data-error-msg="กรุณากรอกนามสกุล" placeholder="นามสกุล" value="<?php echo $rowPerson['lname']; ?>">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="phone">เบอร์โทรศัพท์</label>
                    <input type="phone" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์" value="<?php echo $rowPerson['phone']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">ที่อยู่</label>
                    <input type="address" class="form-control" name="address" id="address" placeholder="ที่อยู่" value="<?php echo $rowPerson['address']; ?>">
                </div>
            
                <div class="form-group col-md-6">
                    <label for="provinceCode">จังหวัด</label>
                    <select name="provinceCode" id="provinceCode" class="form-control" required data-error-msg="กรุณาเลือกช่ือจังหวัด">
                        <option selected disabled>Choose...</option>
                        <?php 
                            $sql = "SELECT * FROM changwat ORDER BY changwat_name";
                            $result = $conn -> prepare($sql);
                            $result -> execute();
                            while ($rowChangwat = $result -> fetch()) {
                        ?>
                            <option value="<?php echo $rowChangwat['changwat_code']; ?>" <?php echo $rowPerson['provinceCode'] == $rowChangwat['changwat_code']?"selected":""; ?>><?php echo $rowChangwat['changwat_name']; ?></option>
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
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $rowPerson['email']; ?>">
                </div>

                <div class="text-center col-12" style="display: inline-block;" >
                    <button type="submit" class="btn btn-primary" >ตกลง</button>
                    <button type="cancel" class="btn btn-secondary" >ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>
    
    <script>
        function showConsent() {
            document.getElementById("consent").style.display = "block";
            document.getElementById("userRegister").style.display = "none";
        }

        function getAmpur(provinceCode, districtCode) {
            $.ajax({
                method: "POST",
                url: "getAmpur.php",
                data: { provinceCode: provinceCode, districtCode: districtCode }
            }).done(function(msg) {
                $("#div-districtCode").html(msg);
                let tambonmsg = '<label for="subdistrictCode">ตำบล</label>';
                    tambonmsg += '<select name="subdistrictCode" id="subdistrictCode" class="form-control" require data-error-msg="กรุณาเลือกชื่อตำบล">';
                    tambonmsg += '<option selected disabled>Choose...</option>';
                    tambonmsg += '</select>';
                $("#div-subdistrictCode").html(tambonmsg);
            });
        }

        function getTambon(provinceCode, districtCode, subdistrictCode) {
            $.ajax({
                method: "POST",
                url: "getTambon.php",
                data: { provinceCode: provinceCode, districtCode: districtCode, subdistrictCode: subdistrictCode }
            }).done(function(msg) {
                $('#div-subdistrictCode').html(msg);
            });
        }

        $(function() {
            $('#provinceCode').val("<?php echo $rowPerson['provinceCode']; ?>");
            getAmpur($("#provinceCode").val(), "<?php echo $rowPerson['districtCode']; ?>");

            $('#districtCode').val("<?php echo $rowPerson['districtCode']; ?>");
            getTambon($("#provinceCode").val(), "<?php echo $rowPerson['districtCode']; ?>","<?php echo $rowPerson['subdistrictCode']; ?>");

            $('#provinceCode').change(function() {
                let provinceCode = $(this).val();
                getAmpur(provinceCode);
            })

            $("#div-districtCode").on("change", "#districtCode", function() {
                let districtCode = $(this).val();
                let provinceCode = $("#provinceCode").val();
                getTambon(provinceCode, districtCode);
            })
        });
    </script>

</body>
</html>
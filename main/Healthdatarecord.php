<?php
include("../include/connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

    <title>บันทึกข้อมูลสุขภาพ</title>
  </head>
  
  <body>
        <div class = "container">
          <h3>บันทึกข้อมูลสุขภาพ</h3>


    <form action="HealthdatarecordInsert.php" method="POST">
        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="smokeId">คุณเป็นโรคเบาหวานใช่หรือไม่</label>
                <!-- <select id="smokeId" class="form-control" required>
                <option selected></option>
                <option>ใช่</option>
                <option>ไม่ใช่</option>
                </select>                -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diabetesId" id="diabetesId" value="1" required data-error-msg="กรุณาเลือกข้อมูล">
                    <label class="form-check-label" for="inlineRadio1">ใช่</label>

                <!-- <div class="form-check form-check-inline"> -->
                    <input style ="margin-left: 30px;" class="form-check-input" type="radio" name="diabetesId" id="inlineRadio2" value="2" required data-error-msg="กรุณาเลือกข้อมูล">
                    <label class="form-check-label" for="inlineRadio2">ไม่ใช่</label>
                </div>
            </div>             
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="smokeId">คุณเป็นโรคความดันโลหิตใช่หรือไม่</label>
                <!-- <select id="smokeId" class="form-control" required>
                <option selected></option>
                <option>ใช่</option>
                <option>ไม่ใช่</option>
                </select> -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bloodId" id="bloodId" value="1" required data-error-msg="กรุณาเลือกข้อมูล">
                <label class="form-check-label" for="inlineRadio3">ใช่</label>
            
            <!-- <div class="form-check form-check-inline"> -->
                <input style ="margin-left: 30px;" class="form-check-input" type="radio" name="bloodId" id="bloodId" value="2" required data-error-msg="กรุณาเลือกข้อมูล">
                <label class="form-check-label" for="inlineRadio4">ไม่ใช่</label>
                </div>
           </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="healthHeight">ส่วนสูง(เซ็นติเมตร)</label>
                <input name="healthHeight" id="healthHeight" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        
            <div class="form-group col-md-6">
                <label for="healthWeight">น้ำหนัก(กิโลกรัม)</label>
                <input name ="healthWeight" id="healthWeight" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="waist">รอบเอว(เซ็นติเมตร)</label>
                <input name="waist" id="waist" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-xs-6 col-6">
                <label for="bpUpper">ความดันโลหิต(ค่าบน)</label>
                <input name="bpUpper" id="bpUpper" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>

            <div class="form-group col-xs-6 col-6">
                <label for="bpLower">ความดันโลหิต(ค่าล่าง)</label>
                <input name="bpLower" id="bpLower" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="bloodSugar">น้ำตาลในเลือด</label>
                <input name="bloodSugar" id="bloodSugar" type="text" class="form-control"  required data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="smokeId">สูบบุหรี่</label>
                <select name="smokeId" id="smokeId" class="form-control" required>
                <option selected></option>
                <?php 
                    $sql ="select * from smoke";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['smokeId'];?>"><?php echo $row['smokeName'];?></option>
                        <?php   
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="alcoholId">ดื่มสุรา</label>
                <select name="alcoholId" id="alcoholId" class="form-control" required>
                <option selected></option>
                <?php 
                    $sql ="select * from alcohol";
                    $result = $conn->prepare($sql);
                    $result->execute();
                    while($row = $result->fetch()) {
                        ?>
                         <option value="<?php echo $row['alcoholId']; ?>"><?php echo $row['alcoholName']; ?></option>
                        <?php   
                    }
                    ?>
                </select>
            </div>
        </div>
  
            <center>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <button type="cancel" class="btn btn-primary">ยกเลิก</button>
            </center>
    </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../js/bootstrap-validate.js"></script>
    <script>
        $(function() {
        console.log($('form'));
        $('form').validator({
            validHandlers: {
                '.customhandler':function(input) {
                    //may do some formatting before validating
                    input.val(input.val().toUpperCase());
                    //return true if valid
                    return input.val() === 'JQUERY' ? true : false;
                }
            }
        });

        $('form').submit(function(e) {

            if ($('form').validator('check') < 1) {
                // alert('Hurray, your information will be saved!');
            }else{
                e.preventDefault();
                return false;
            }
        })
    })
    </script>

  </body>
</html>
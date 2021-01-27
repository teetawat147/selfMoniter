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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>เข้าสู่ระบบ</title>
    <style>
        .has-error .help-block{
            color: red;
        }
    </style>

  </head>


<body>
    <div class = "container">
        <center>
          <h3>เข้าสู่ระบบ</h3>
        </center>
    <br>
<form method="POST" action="loginCheck.php">

    <div class="row justify-content-center" >
        <div class="col-8 col-md-4">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" class="form-control"  required data-error-msg="กรุณากรอก Username!">
                </div>
        
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <input name ="password" id="password" type="text" class="form-control"  required data-error-msg="กรุณากรอก Password!">
                </div>
            </div>

            <div class="text-center col-12" style="display: inline-block;" >
                <button type="submit" class="btn btn-primary" >ตกลง</button>
                <button type="cancel" class="btn btn-primary" >ยกเลิก</button>
            </div>
            <br>
            <center>
                <a href="../main/userRegister.php">สมัครเข้าใช้งาน</a>
                <label for="password">ลืมรหัสผ่าน</label>
            </center>
        </div>  
        
    </div> 

            
            
</form>

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
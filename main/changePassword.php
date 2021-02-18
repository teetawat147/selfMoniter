<?php 
    include("../include/connection.php");

    $sql = "SELECT personId, password FROM person WHERE personId = ".$_SESSION['personId'];
    $result = $conn -> prepare($sql);
    $result -> execute();
    $rows = $result -> fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>แก้ไขรหัสผ่าน</title>
  </head>
  <body>
    <div class="container">
        <h3 class="mt-3">แก้ไขรหัสผ่าน</h3>
        <form action="changePasswordUpdate.php" method="POST">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="oldPassword">รหัสผ่านเดิม</label>
                    <input type="password" name="oldPassword" class="form-control" id="oldPassword">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="newPassword">รหัสผ่านใหม่</label>
                    <input type="password" name="newPassword" id="newPassword" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="confirmPassword">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                </div>
            </div>

            <center>
                <input type="hidden" name="personId" id="personId" value="<?php echo $rows['personId']; ?>">
                <input type="hidden" name="password" id="password" value="<?php echo $rows['password']; ?>">
                <button type="submit" class="btn btn-success">ตกลง</button>
                <button type="button" class="btn btn-secondary">ยกเลิก</button>
            </center>
            
        </form>
    </div>






    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
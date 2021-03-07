<?php
    include '../include/connection.php';

    $sql ="SELECT * FROM department WHERE departmentId = '".$_GET['departmentId']."' ";
    $result = $conn->prepare($sql);
    $result -> execute();
    $rowEdit = $result->fetch();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>แก้ไขแผนกงาน</title>
  </head>
  <body>

    <?php
        include '../main/header.php';
    ?>

    <div class="container">
        <h3 class="text-center">แก้ไขแผนกงาน</h3><br>

        <form action="departmentSaveUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="officeId">ชื่อหน่วยงาน</label>
                    <select name="officeId" id="officeId" class="form-control" type="text" required data-error-msg="กรุณากรอกชื่อหน่วยงาน">
                        <option selected disabled>Choose...</option>
                        <?php 
                            $sqlOffice = "SELECT * FROM office";
                            $result = $conn -> prepare($sqlOffice);
                            $result -> execute();
                            while ($rowsOffice = $result -> fetch()) {
                            ?>
                            <option value="<?php echo $rowsOffice['office_id'];?>" <?php echo ($rowEdit['officeId']==$rowsOffice['office_id'])?"selected":"";?>><?php echo $rowsOffice['office_name'];?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="departmentName">ชื่อแผนกงาน</label>
                    <input name="departmentName" id="departmentName" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อแผนกงาน" value="<?php echo $rowEdit['departmentName']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="totalPersonDept">จำนวนเจ้าหน้าที่ในแผนกงาน</label>
                    <input name="totalPersonDept" id="totalPersonDept" class="form-control" type="text" required data-error-msg="กรุณากรอกจำนวนเจ้าหน้าที่ในแผนกงาน" value="<?php echo $rowEdit['totalPersonDept']; ?>">
                </div>
            </div>

            <center>
                <input type="hidden" name="departmentId" id="departmentId" value="<?php echo $rowEdit['departmentId']; ?>">
                <button class="btn btn-success" type="submit">ตกลง</button>
                <a href="../main/departmentGet.php" class="btn btn-secondary" role="button" aria-pressed="true">ยกเลิก</a>
            </center>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/tableToCards.js"></script>

    <script>
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
<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายละเอียดของความดัน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
</head>

    <?php
        $sql = "select * from `bloodPressure` WHERE bloodPressureId=".$_GET['bloodPressureId'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsbloodPressure = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
<?php
      include "./header.php";
  ?>
    
    <div class="container mt-3">
        <h3>แก้ไขระดับ ความดัน</h3>
        <form action="ajaxBpUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdName">รายการ</label>
                    <input type="text" class="form-control" name="cvdName" id="cvdName" value="<?php echo htmlentities($rowsbloodPressure['bloodPressureName']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude">สรุป</label>
                    <textarea name="conclude" id="conclude" cols="80" rows="10"><?php echo htmlentities($rowsbloodPressure['conclude']); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice">คำแนะนำ</label>
                    <textarea name="advice" id="advice" cols="80" rows="10"><?php echo htmlentities($rowsbloodPressure['advice']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sbp">ความดันค่าล่าง</label>
                    <input type="text" class="form-control" name="sbp" id="sbp" value="<?php echo htmlentities($rowsbloodPressure['sbp']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="dbp">ความดันค่าบน</label>
                    <input type="text" class="form-control" name="dbp" id="dbp" value="<?php echo htmlentities($rowsbloodPressure['dbp']); ?>">
                </div>
            </div>

            <input type="hidden" name="bloodPressureId" id="bloodPressureId" value="<?php echo htmlentities($rowsbloodPressure['bloodPressureId']); ?>">
            <center><button class="btn btn-warning mr-3" type="reset">ยกเลิก</button>
            <button class="btn btn-success" type="submit">บันทึก</button></center>
        </form>
    </div>
    <!-- <script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    <!-- </script> -->
    <script>
            function createCkeditor(element) {
                ClassicEditor
                .create( document.getElementById(element) )
                .catch( error => {
                    console.error( error );
                } );
            }

            //createCkeditor("cvdName");
             createCkeditor("conclude");
             createCkeditor("advice");
            // createCkeditor("cvdMin");
            // createCkeditor("cvdMax");
    </script>


</body>
</html>

<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายละเอียดของ BMI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
</head>

    <?php
        $sql = "select * from `bmi` WHERE id=".$_GET['id'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsBmi = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
<?php
      include "./header.php";
  ?>
    
    <div class="container">
        <h3>แก้ไขระดับ BMI</h3>
        <form action="ajaxBmiUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nameBmi">รายการ</label>
                    <input type="text" class="form-control" name="nameBmi" id="nameBmi" value="<?php echo htmlentities($rowsBmi['nameBmi']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="riskBmi">รายการ</label>
                    <input type="text" class="form-control" name="riskBmi" id="riskBmi" value="<?php echo htmlentities($rowsBmi['riskBmi']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude">สรุป</label>
                    <textarea name="conclude" id="conclude" cols="80" rows="10"><?php echo htmlentities($rowsBmi['conclude']); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice">คำแนะนำ</label>
                    <textarea name="advice" id="advice" cols="80" rows="10"><?php echo htmlentities($rowsBmi['advice']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex1min">ค่าต่ำสุด(ผู้ชาย)</label>
                    <input type="text" class="form-control" name="sex1min" id="sex1min" value="<?php echo htmlentities($rowsBmi['sex1min']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex1max">ค่าสูงสุด(ผู้ชาย)</label>
                    <input type="text" class="form-control" name="sex1max" id="sex1max" value="<?php echo htmlentities($rowsBmi['sex1max']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex2min">ค่าต่ำสุด(ผู้หญฺิง)</label>
                    <input type="text" class="form-control" name="sex2min" id="sex2min" value="<?php echo htmlentities($rowsBmi['sex2min']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex2max">ค่าสูงสุด(ผู้หญฺิง)</label>
                    <input type="text" class="form-control" name="sex2max" id="sex2max" value="<?php echo htmlentities($rowsBmi['sex2max']); ?>">
                </div>
            </div>

            <input type="hidden" name="id" id="id" value="<?php echo htmlentities($rowsBmi['id']); ?>">
            <button class="btn btn-warning" type="reset">ยกเลิก</button>
            <button class="btn btn-success" type="submit">บันทึก</button>
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

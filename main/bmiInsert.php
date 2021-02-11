<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลรายละเอียดของ BMI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>    
<body>
<?php
      include "./header.php";
?>
    <div class="container mt-3">
        <h3>เพิ่มข้อมูลระดับ BMI</h3>
        <form action="ajaxBmiInsert.php" method="POST">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nameBmi">ระดับ</label>
                    <input id="nameBmi" class="form-control" name="nameBmi" type="text">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="riskBmi">ความเสี่ยง</label>
                    <input id="riskBmi" class="form-control" name="riskBmi" type="text">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex1min">ค่าต่ำสุด(ผู้ชาย)</label>
                    <input id="sex1min" name="sex1min"  type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex1max">ค่าสูงสุด(ผู้ชาย)</label>
                    <input id="sex1max" name="sex1max"  type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex2min">ค่าต่ำสุด(ผู้หญิง)</label>
                    <input id="riskBmi" class="form-control" name="riskBmi" class="ckeditor" type="text">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="sex2max">ค่าสูงสุด(ผู้หญิง)</label>
                    <input id="sex2max" class="form-control" name="sex2max" class="ckeditor" type="text">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude">สรุป</label>
                    <textarea name="conclude" id="conclude" class="ckeditor" cols="80" rows="10"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice">คำแนะนำ</label>
                    <textarea name="advice" id="advice" class="ckeditor" cols="80" rows="10"></textarea>
                </div>
            </div>

            <!-- <input type="hidden" name="waistId" id="waistId"> -->
            <center><button class="btn btn-warning mr-3" type="reset">ยกเลิก</button>
            <button class="btn btn-success" type="submit">บันทึก</button></center>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>

    <script>
        function createCkeditor(element) {
            ClassicEditor
            .create( document.getElementById(element) )
            .catch( error => {
                console.error( error );
            } );
        }

        createCkeditor("conclude");
        createCkeditor("advice");
    </script>


</body>
</html>
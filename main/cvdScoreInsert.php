<?php
    include '../include/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลรายละเอียดของ CVD Score</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    <?php
        include "./header.php";
    ?>

    <div class="container mt-3">
        <h3>เพิ่มข้อมูลระดับ CVD risk</h3>
        <form action="ajaxCvdScoreInsert.php" method="post">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdName">รายการ</label>
                    <input type="text" name="cvdName" id="cvdName" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude">สรุป</label>
                    <textarea class="form-control" name="conclude" id="conclude" cols="80" rows="10" class="ckeditor"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice">คำแนะนำ</label>
                    <textarea name="advice" id="advice" cols="80" rows="10" class="form-control" class="ckeditor"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMin">CVD ค่าต่ำที่สุด</label>
                    <input type="text" name="cvdMin" id="cvdMin" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMax">CVD มากที่สุด</label>
                    <input type="text" name="cvdMax" id="cvdMax" class="form-control">
                </div>
            </div>

            <center>
                 <button class="btn btn-warning mr-3" type="reset">ยกเลิก</button>
                 <button class="btn btn-success" type="submit">บันทึก</button>
            </center>

        </form>
    </div>

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
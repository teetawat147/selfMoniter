<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายละเอียดของรอบเอว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .container {
            margin-top: 20px;
            padding: 5px;
            text-align: center;
            display: block;
        }
    </style>
</head>

    <?php
        $sql="select * from `waist` WHERE waist=".$_GET['waistId'];
        $obj=$connect->prepare($sql);
        $obj->execute();
        $rows=$obj->fetchAll(PDO::FETCH_ASSOC);
    ?>
    
<body>
    <div class="container">
        <form action="waistUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="waistList">รายการ</label><br>
                    <textarea name="waistList" id="waistList" cols="80" rows="10" value="<?php echo $rowsWaist['WaistName']; ?>">กรอกข้อความที่ต้องการจะแก้ไข.....</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="waistConclude">สรุป</label><br>
                    <textarea name="waistConclude" id="waistConclude" cols="80" rows="10" value="">กรอกข้อความที่ต้องการจะแก้ไข.....</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="waistDetail">รายละเอียด</label><br>
                    <textarea name="waistDetail" id="waistDetail" cols="80" rows="10" value="">กรอกข้อความที่ต้องการจะแก้ไข.....</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="waistAdvice">คำแนะนำ</label><br>
                    <textarea name="waistAdvice" id="waistAdvice" cols="80" rows="10" value="">กรอกข้อความที่ต้องการจะแก้ไข.....</textarea>
                </div>
            </div>
        </form>
    </div>
    <script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    </script>

</body>
</html>

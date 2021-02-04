<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายละเอียดของการสูบบุหรี่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .container {
            margin-top: 20px;
            padding: 5px;
            text-align: center;
        }
        
        .form-group, label {
            margin: 15px 0;
        }
    </style>
</head>

    <?php
        $sql = "select * from `smoke` WHERE smokeId=".$_GET['smokeId'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsSmoke = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
    <div class="container">
        <form action="ajaxSmokeUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="smokeName"><b>รายการ</b></label><br>
                    <textarea name="smokeName" id="smokeName" cols="80" rows="10"><?php echo htmlentities($rowsSmoke['smokeName']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="map"><b>Map</b></label><br>
                    <textarea name="map" id="map" cols="80" rows="10"><?php echo htmlentities($rowsSmoke['map']); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude"><b>สรุป</b></label><br>
                    <textarea name="conclude" id="conclude" cols="80" rows="10"><?php echo htmlentities($rowsSmoke['conclude']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice"><b>คำแนะนำ</b></label><br>
                    <textarea name="advice" id="advice" cols="80" rows="10"><?php echo htmlentities($rowsSmoke['advice']); ?></textarea>
                </div>
            </div>
            <input type="hidden" name="smokeId" id="smokeId" value="<?php echo htmlentities($rowsSmoke['smokeId']); ?>">
            <button type="submit">บันทึก</button>
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

            createCkeditor("smokeName");
            createCkeditor("conclude");
            createCkeditor("advice");
    </script>


</body>
</html>

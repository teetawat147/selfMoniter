<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายละเอียดของการสูบบุหรี่</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

    <?php
        $sql = "select * from `smoke` WHERE smokeId=".$_GET['smokeId'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsSmoke = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
<?php
    include "./header.php";
?>
    <div class="container mt-3">
        <h3>แก้ไข ระดับการสูบบุหรี่</h3>
        <form action="ajaxSmokeUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="smokeName">รายการ</label>
                    <input name="smokeName" id="smokeName" type="text" class="form-control" value="<?php echo htmlspecialchars_decode($rowsSmoke['smokeName']); ?>">
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
            <center>
                <button class="btn btn-warning mr-3" style="text-align: center;"  type="reset">ยกเลิก</button>
                <button class="btn btn-success " style="text-align: center;" type="submit">บันทึก</button>
            </center>
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

            //createCkeditor("smokeName");
            createCkeditor("conclude");
            createCkeditor("advice");
            createCkeditor("map");
    </script>


</body>
</html>

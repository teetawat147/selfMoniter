<?php
    include('../include/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขระดับ CVD risk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
</head>

    <?php
        $sql = "select * from `cvdScore` WHERE cvdScoreId=".$_GET['cvdScoreId'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsCvdScore = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
<?php
      include "./header.php";
  ?>
    
    <div class="container mt-3">
        <h3>แก้ไขระดับ CVD risk</h3>
        <form action="ajaxCvdScoreUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdName">รายการ</label>
                    <input type="text" class="form-control" name="cvdName" id="cvdName" value="<?php echo htmlentities($rowsCvdScore['cvdName']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude">สรุป</label>
                    <textarea name="conclude" id="conclude" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['conclude']); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice">คำแนะนำ</label>
                    <textarea name="advice" id="advice" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['advice']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMin">CVD ค่าต่ำที่สุด</label>
                    <input type="text" class="form-control" name="cvdMin" id="cvdMin" value="<?php echo htmlentities($rowsCvdScore['cvdMin']); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMax">CVD ค่ามากที่สุด</label>
                    <input type="text" class="form-control" name="cvdMax" id="cvdMax" value="<?php echo htmlentities($rowsCvdScore['cvdMax']); ?>">
                </div>
            </div>

            <input type="hidden" name="cvdScoreId" id="cvdScoreId" value="<?php echo htmlentities($rowsCvdScore['cvdScoreId']); ?>">
            <center>
                <button class="btn btn-warning mr-3" type="reset">ยกเลิก</button>
                <button class="btn btn-success" type="submit">บันทึก</button>
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

            //createCkeditor("cvdName");
             createCkeditor("conclude");
             createCkeditor("advice");
            // createCkeditor("cvdMin");
            // createCkeditor("cvdMax");
    </script>


</body>
</html>

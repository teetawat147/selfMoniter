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
        $sql = "select * from `cvdScore` WHERE cvdScoreId=".$_GET['cvdScoreId'];
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rowsCvdScore = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    
<body>
    <div class="container">
        <form action="ajaxCvdScoreUpdate.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdName"><b>รายการ</b></label><br>
                    <textarea name="cvdName" id="cvdName" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['cvdName']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="conclude"><b>สรุป</b></label><br>
                    <textarea name="conclude" id="conclude" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['conclude']); ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="advice"><b>คำแนะนำ</b></label><br>
                    <textarea name="advice" id="advice" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['advice']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMin"><b>CVD ค่าต่ำที่สุด</b></label><br>
                    <textarea name="cvdMin" id="cvdMin" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['cvdMin']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="cvdMax"><b>CVD ค่ามากที่สุด</b></label><br>
                    <textarea name="cvdMax" id="cvdMax" cols="80" rows="10"><?php echo htmlentities($rowsCvdScore['cvdMax']); ?></textarea>
                </div>
            </div>

            <input type="hidden" name="cvdScoreId" id="cvdScoreId" value="<?php echo htmlentities($rowsCvdScore['cvdScoreId']); ?>">
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

            createCkeditor("cvdName");
            // createCkeditor("conclude");
            // createCkeditor("advice");
            // createCkeditor("cvdMin");
            // createCkeditor("cvdMax");
    </script>


</body>
</html>

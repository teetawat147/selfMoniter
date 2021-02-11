<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM bmi";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsBmi = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
  
    <title>ค่า BMI</title>

    <style>

    tbody tr td:nth-child(1),
    tbody tr td:nth-child(6),
    tbody tr td:nth-child(7),
    tbody tr td:nth-child(8),
    tbody tr td:nth-child(9) {
      text-align: center;
    }

    button,
    center a {
      margin-top: 5px;
      width: 12ch;
    }

    center div {
      width: 120px;
      height: 180px;
    }

    #btn-insert {
      margin-bottom: 15px;
    }
    </style>
  </head>
  <body>
    <?php
      include "./header.php";
    ?>

    <div class="container-fluid mt-2">
      <h3>ระดับ BMI</h3>
        <table class="table" id="myTable" style="width: 100%;">
          <thead>
          <tr>
              <th style="height: 70px; text-align: center; vertical-align: top;">ลำดับ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ระดับ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ความเสี่ยง</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">สรุป</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">คำแนะนำ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ค่าต่ำสุด(ผู้ชาย)</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ค่าสูงสุด(ผู้ชาย)</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ค่าต่ำสุด(ผู้หญิง)</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">ค่าสูงสุด(ผู้หญิง)</th>
              <th data-card-footer></th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($rowsBmi as $key => $rowBmi) {
            ?>

            <tr>
                <td><?php echo html_entity_decode($rowBmi['id']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['nameBmi']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['riskBmi']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['conclude']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['advice']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['sex1min']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['sex1max']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['sex2min']); ?></td>
                <td><?php echo html_entity_decode($rowBmi['sex2max']); ?></td>
                <td>
                <center>
                  <a href="../main/bmiUpdate.php?id=<?php echo html_entity_decode($rowBmi['id']); ?>" class="btn btn-warning">แก้ไขข้อมูล</a>
                  <button id="delete-btn" class="btn btn-danger" onclick="document.getElementById('confirm-delete').style.display='block'">ลบข้อมูล</button>
                </center>
              </td>
            </tr>
            <?php 
              }
            ?>
          </tbody>
        </table>

        <!-- ปุ่มเพิ่มข้อมูล (Insert data) -->
        <center><a href="../main/bmiInsert.php?id=<?php echo html_entity_decode($rowBmi['id']); ?>" class="btn btn-primary">เพื่มข้อมูล</a></center>

        <div id="confirm-delete" class="modal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="../main/bmiGet.php">
              <center>
                <span onclick="document.getElementById('confirm-delete').style.display='none'" class="close" title="Close Modal"><i id="btn-close" class="fas fa-window-close"></i></span>
                <div class="container mt-3 mb-3">
                  <h1 style="font-size: 20px; font-weight: 900;">ลบข้อมูล"<?php echo $rowBmi['nameBmi']; ?>"</h1>
                  <p>คุณแน่ใจหรือไม่ว่าต้องการจะลบข้อมูล "<?php echo $rowBmi['nameBmi']; ?>"</p>
                
                  <div class="clearfix">
                    <a class="btn btn-warning" type="button" onclick="document.getElementById('confirm-delete').style.display='none'" class="cancel-btn">ยกเลิก</a>
                    <a href="../main/bmiDelete.php?id=<?php echo $rowBmi['id']; ?>" class="btn btn-primary" type="button" onclick="document.getElementById('confirm-delete').style.display='none'" class="delete-btn">ยืนยัน</a>
                  </div>
                </div>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
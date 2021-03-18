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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
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
      margin-top: 7px;
      width: 12ch;
    }

    center div {
      width: 120px;
      height: 180px;
    }

    .img-add-data {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
    }

    .btn-edit,
    .btn-delete {
        width: 7ch;
        margin-right: 10px;
        
    }


    .btn-dismiss,
    .btn-confirm-delete {
      width: 80px;
      text-align: center;
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
                  <center class="button">
                    <a href="../main/bmiUpdate.php?id=<?php echo html_entity_decode($rowBmi['id']); ?>" class="btn btn-warning btn-edit"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-danger btn-delete" data-href="../main/bmiDelete.php?id=<?php echo $rowBmi['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash-alt"></i></button>
                  </center>
                </td>
              </tr>
            <?php 
              }
            ?>
        </tbody>
      </table>
      <hr>

        <!-- ปุ่มเพิ่มข้อมูล (Insert data) -->
      <center><a href="../main/bmiInsert.php?id=<?php echo html_entity_decode($rowsBmi['id']); ?>" class="mb-3"><img src="../images/icon-addData.svg" alt="" class="img-add-data"></a></center>

      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-header">
              <h4 class="modal-title w-100 text-center">ยืนยันการลบ</h4>
              <button type="button" id="close-modal" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-window-close"></i></button>
            </div>
        
            <div class="modal-body text-center">
              <p>คุณต้องการจะดำเนินการลบข้อมูลหรือไม่</p>
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
              <button type="button" class="btn btn-secondary btn-dismiss mb-2" data-dismiss="modal">ยกเลิก</button>
              <a class="btn btn-success btn-confirm-delete">ยืนยัน</a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script>
      $('#confirm-delete').on('show.bs.modal', function(event) {
            $(this).find('.btn-confirm-delete').attr('href', $(event.relatedTarget).data('href'));
      });
    </script>

  </body>
</html>
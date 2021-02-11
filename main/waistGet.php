<?php
    include '../include/connection.php';

    $sql = "SELECT * FROM waist";
    $result = $conn->prepare($sql);
    $result->execute();
    $rowsWaist = $result->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="../js/tableToCards.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <title>รอบเอว</title>

    <style>
      thead tr th:nth-child(5),
      thead tr th:nth-child(6) {
        width: 9ch;
        margin: 0 auto;
      }

      center a,
      center button {
        margin-top: 5px;
        width: 12ch;
      }

      #close-modal {
        margin: -30px -30px 0 0;
      }

      @media screen and (max-width: 768px) {
          .table {
              margin-top: 50px;
          }
      }
    </style>
  </head>
  <body>
  <?php
      include "./header.php";
  ?>
    <div class="container-fluid mt-2">
      <h3>ระดับรอบเอว</h3>
      <table class="table" id="myTable" style="width: 100%;">
        <thead>
          <tr>
            <th style="height: 70px; vertical-align: top; text-align: center;">ลำดับ</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">รายการ</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">สรุป</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">รายละเอียด</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">เกณฑ์ผู้ชาย</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">เกณฑ์ผู้หญิง</th>
            <th style="height: 70px; vertical-align: top; text-align: center;">คำแนะนำ</th>
            <th data-card-footer></th>
          </tr>
        </thead>
        <tbody>
          <?php
              foreach ($rowsWaist as $key => $rowWaist) {
              ?>

          <tr>
            <td style="text-align: center;"><?php echo html_entity_decode($rowWaist['waistId']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistName']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistConclude']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistDetail']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['sex1max']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['sex2max']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistAdvice']); ?></td>

            <td>
              <center>
                <a href="../main/waistUpdate.php?waistId=<?php echo html_entity_decode($rowWaist['waistId']); ?>" class="btn btn-warning">แก้ไขข้อมูล</a>
                <button class="btn btn-danger" data-href="../main/waistDelete.php?waistId=<?php echo $rowWaist['waistId']; ?>" data-toggle="modal" data-target="#confirm-delete">ลบข้อมูล</button>
              </center>
            </td>
          </tr>
          <?php
              }
          ?>
        </tbody>
      </table>


      <!-- ปุ่มเพิ่มข้อมูล (Insert data) -->
      <center><a href="../main/waistInsert.php?waistId=<?php echo html_entity_decode($rowWaist['waistId']); ?>" class="btn btn-primary mb-2">เพิ่มข้อมูล</a></center>


    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
              <div class="modal-header">
                <h4 class="modal-title w-100 text-center">ยืนยันการลบ</h4>
                <button type="button" id="close-modal" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-window-close"></i></button>
              </div>
          
              <div class="modal-body text-center">
                  <p>คุณต้องการจะดำเนินการลบหรือไม่</p>
                  <p class="debug-url"></p>
              </div>
              
              <div class="modal-footer d-flex justify-content-center">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <a class="btn btn-success btn-confirm-delete">ยืนยัน</a>
              </div>
            </div>
        </div>
    </div>

    <script>
      // let modal = document.getElementById('confirm-delete');

      // // When the user clicks anywhere outside of the modal, close it
      // window.onclick = function(event) {
      //   if (event.target == modal) {
      //     modal.style.display = "none";
      //   }
      // }

      $('#confirm-delete').on('show.bs.modal', function(event) {
            $(this).find('.btn-confirm-delete').attr('href', $(event.relatedTarget).data('href'));
            // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-confirm-delete').attr('href') + '</strong>');
        });
    </script>
  </body>
</html>
<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM waist";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsWaist = $result -> fetchAll(PDO::FETCH_ASSOC);
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
  
    <title>รอบเอว</title>

    <style>

      thead tr th:nth-child(5),
      thead tr th:nth-child(6) {
        width: 9ch;
        margin: 0 auto;
      }

      #delete-btn {
        margin-top: 5px;
        width: 120px;
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
                  <a href="../main/waistUpdate.php?waistId=<?php echo html_entity_decode($rowWaist['waistId']); ?>" class="btn btn-warning">แก้ไขข้อความ</a>
                  <button id="delete-btn" class="btn btn-danger" onclick="document.getElementById('confirm-delete').style.display='block'">ลบ</button>
                </center>
            </td>
          </tr>
          <?php 
            }
          ?>
        </tbody>
      </table>

      <div id="confirm-delete" class="modal">
        <span onclick="document.getElementById('confirm-delete').style.display='none'" class="close" title="Close Modal">×</span>
        <form class="modal-content" action="../main/waistDelete.php">
          <center>
            <div class="container mt-3 mb-3 w-25">
              <h1>ลบข้อมูล <?php echo $rowsWaist['waistName']; ?></h1>
              <p>คุณแน่ใจหรือไม่ว่าต้องการจะลบข้อมูล <?php echo $rowsWaist['waistName']; ?></p>
            
              <div class="clearfix">
                <button class="btn btn-warning" type="button" onclick="document.getElementById('confirm-delete').style.display='none'" class="cancelbtn">ยกเลิก</button>
                <button class="btn btn-primary" type="button" onclick="document.getElementById('confirm-delete').style.display='none'" class="deletebtn">ยืนยัน</button>
              </div>
            </div>
          </center>
        </form>
    </div>

    <script>
      let modal = document.getElementById('confirm-delete');
      let bodyElem = document.getElementsByTagName("body");

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
          bodyElem.innerHtml = "";
        }
      }
    </script>
  </body>
</html>
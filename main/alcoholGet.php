<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM alcohol";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsAlcohol = $result -> fetchAll(PDO::FETCH_ASSOC);
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
    <script src="../js/tableToCards.js"></script>
  
    <title>สูบบุหรี่</title>

    <style>

      thead tr th {
        width: 9ch;
        text-align: center;
      }

      tbody tr td:nth-child(1) {
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
      <h3>ระดับ แอลกอฮอล์</h3>
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>สรุป</th>
            <th>คำแนะนำ</th>
            <th data-card-footer></th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rowsAlcohol as $key => $rowAlcohol) {
          ?>

          <tr>
              <td><?php echo html_entity_decode($rowAlcohol['alcoholId']); ?></td>
              <td><?php echo html_entity_decode($rowAlcohol['alcoholName']); ?></td>
              <td><?php echo html_entity_decode($rowAlcohol['conclude']); ?></td>
              <td><?php echo html_entity_decode($rowAlcohol['advice']); ?></td>
              <td>
              <center>
                <a href="../main/AlcoholUpdate.php?alcoholId=<?php echo html_entity_decode($rowAlcohol['alcoholId']); ?>" class="btn btn-warning btn-edit"><i class="fas fa-edit"></i></a>
                <button class="btn btn-danger btn-delete" data-href="../main/alcoholDelete.php?alcoholId=<?php echo html_entity_decode($rowAlcohol['alcoholId']); ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash-alt"></i></button>
              </center>
            </td>
          </tr>
          <?php 
            }
          ?>
        </tbody>
      </table>
      <hr>

      <center><a href="../main/alcoholInsert.php?alcoholId<?php echo html_entity_decode($rowAlcohol['alcoholId']); ?>" class="mb-3"><img src="../images/icon-addData.svg" alt="" class="img-add-data"></a></center>

      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title w-100 text-center">ยินยันการลบ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-window-close"></i></button>
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
      $("#confirm-delete").on("show.bs.modal", function(event) {
        $(this).find(".btn-confirm-delete").attr("href", $(event.relatedTarget).data("href"));
      })
    </script>

  </body>
</html>
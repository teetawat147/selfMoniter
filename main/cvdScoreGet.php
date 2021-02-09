<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM cvdScore";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsCvdScore = $result -> fetchAll(PDO::FETCH_ASSOC);
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
  
    <title>ระดับ CVD risk</title>

    <style>

      thead tr th {
        width: 9ch;
        text-align: center;
      }

      tbody tr td:nth-child(1),
      tbody tr td:nth-child(2),
      tbody tr td:nth-child(5),
      tbody tr td:nth-child(6) {
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
      <h3>ระดับ CVD risk</h3>
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th style="height: 70px; text-align: center; vertical-align: top;">ลำดับ</th>
            <th style="height: 70px; text-align: center; vertical-align: top;">รายการ</th>
            <th style="height: 70px; text-align: center; vertical-align: top;">สรุป</th>
            <th style="height: 70px; text-align: center; vertical-align: top;">คำแนะนำ</th>
            <th style="height: 70px; text-align: center; vertical-align: top;">CVD ค่าต่ำที่สุด</th>
            <th style="height: 70px; text-align: center; vertical-align: top;">CVD ค่ามากที่สุด</th>
            <th data-card-footer></th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rowsCvdScore as $key => $rowCvdScore) {
          ?>

          <tr>
              <td><?php echo html_entity_decode($rowCvdScore['cvdScoreId']); ?></td>
              <td><?php echo html_entity_decode($rowCvdScore['cvdName']); ?></td>
              <td><?php echo html_entity_decode($rowCvdScore['conclude']); ?></td>
              <td><?php echo html_entity_decode($rowCvdScore['advice']); ?></td>
              <td><?php echo html_entity_decode($rowCvdScore['cvdMin']); ?></td>
              <td><?php echo html_entity_decode($rowCvdScore['cvdMax']); ?></td>
              <td>
              <center><a href="../main/cvdScoreUpdate.php?cvdScoreId=<?php echo html_entity_decode($rowCvdScore['cvdScoreId']); ?>" class="btn btn-warning">แก้ไขข้อความ</a></center>
            </td>
          </tr>
          <?php 
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
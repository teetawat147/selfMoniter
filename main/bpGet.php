<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM bloodPressure";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsBloodPressure = $result -> fetchAll(PDO::FETCH_ASSOC);
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
  
    <title>ระดับความดัน</title>

    <style>

      thead tr th {
        width: 9ch;
        text-align: center;
      }

      /* tbody tr td:nth-child(1),
      tbody tr td:nth-child(3) {
          text-align: center;
      } */

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
    <div class="container-fluid">
      <h3>ระดับ ความดัน</h3>
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>สรุป</th>
            <th>คำแนะนำ</th>
            <th>ความดันค่าล่าง</th>
            <th>ความดันค่าบน</th>
            <th data-card-footer></th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rowsBloodPressure as $key => $rowBloodPressure) {
          ?>

          <tr>
              <td><?php echo html_entity_decode($rowBloodPressure['bloodPressureId']); ?></td>
              <td><?php echo html_entity_decode($rowBloodPressure['bloodPressureName']); ?></td>
              <td><?php echo html_entity_decode($rowBloodPressure['conclude']); ?></td>
              <td><?php echo html_entity_decode($rowBloodPressure['advice']); ?></td>
              <td><?php echo html_entity_decode($rowBloodPressure['sbp']); ?></td>
              <td><?php echo html_entity_decode($rowBloodPressure['dbp']); ?></td>
              <td>
              <center><a href="../main/bpUpdate.php?bloodPressureId=<?php echo html_entity_decode($rowBloodPressure['bloodPressureId']); ?>" class="btn btn-warning">แก้ไขข้อความ</a></center>
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
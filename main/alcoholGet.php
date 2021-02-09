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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
  
    <title>สูบบุหรี่</title>

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
              <center><a href="../main/AlcoholUpdate.php?alcoholId=<?php echo html_entity_decode($rowAlcohol['alcoholId']); ?>" class="btn btn-warning">แก้ไขข้อความ</a></center>
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
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
    
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/content/tables/">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>รอบเอว</title>

    <style>
        @media screen and (max-width: 768px) {
            .table {
                margin-top: 50px;
            }
        }
    </style>
  </head>
  <body>

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>รายการ</th>
          <th>สรุป</th>
          <th>รายละเอียด</th>
          <th>คำแนะนำ</th>
        </tr>
      </thead>
      <tbody>
        <?php
            foreach ($rowsWaist as $key => $rowWaist) {
        ?>
        <div>
            <tr>
            <td><?php echo html_entity_decode($rowWaist['waistId']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistName']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistConclude']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistDetail']); ?></td>
            <td><?php echo html_entity_decode($rowWaist['waistAdvice']); ?></td>
            <td>
            <a href="../main/waistUpdate.php?waistId=<?php echo html_entity_decode($rowWaist['waistId']); ?>" class="btn btn-warning">แก้ไขข้อความ</a>
            </td>
        </div>
        <?php 
            }
        ?>
      </tbody>
</table>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>
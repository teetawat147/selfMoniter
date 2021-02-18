<?php
  include('../include/connection.php');

  $sql = "SELECT o.office_name, a.ampur_name, o.office_type
            FROM office o
            LEFT JOIN ampur47 a ON o.ampur_code = a.ampur_code";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsOffice = $result -> fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    
  
    <title>officeGet</title>

    <style>

    /* tbody tr td:nth-child(2),
    tbody tr td:nth-child(6),
    tbody tr td:nth-child(7),
    tbody tr td:nth-child(8),
    tbody tr td:nth-child(2) {
      text-align: center;
    } */

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

    </style>
  </head>
  <body>
    <?php
      include "./header.php";
    ?>

    <div class="container-fluid mt-2">
      <br>
      <center><h3>Office Admin Health</h3></center>
      <br>
      <center><a href="../main/officeGetInsert.php?id=<?php echo html_entity_decode($rowBmi['id']); ?>" class="mb-3"><img src="../images/icon-addData.svg" alt="" class="img-add-data"></a></center>
      
      <table class="table" id="myTable" style="width: 100%;" data-toggle="table" data-search="true">
        <thead>
          <tr>
              <th style="height: 70px; text-align: center; vertical-align: top;">รูปภาพ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">หน่วยงาน</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">อำเภอ</th>
              <th data-card-footer></th>
            </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rowsOffice as $key => $rowOffice) {
          ?>
              <tr>
                <td><img class="mr-3" src="../images/<?php echo $rowOffice['office_type'];?>.png" style="width: 150px;" ></td>
                <td><?php echo $rowOffice['office_name']; ?></td>
                <td><?php echo $rowOffice['ampur_name']; ?></td>
                <td>
                  <center class="button">
                  <a href="../main/officeGetUpdate.php?office_id=<?php echo $rowsOffice['office_id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                  </center>
                </td>
              </tr>
            <?php 
              }
            ?>
        </tbody>
      </table>
      <hr>
    <script>
    
    </script>

  </body>
</html>
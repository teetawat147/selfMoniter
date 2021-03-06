<?php
    include '../include/connection.php';

    if(!$_SESSION['fname']) {
      header("location: ../main/login.php");
    }

    $sqlDept = "SELECT o.office_id, o.office_name, d.departmentId, d.departmentName
                FROM `office` o
                LEFT JOIN department d ON o.office_id = d.officeId
                ORDER BY o.office_id, d.departmentName";

    $result = $conn->prepare($sqlDept);
    $result -> execute();
    $rowsDept = $result->fetchAll(PDO::FETCH_ASSOC);

    // print_r($rowsDept);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">


    <title>แสดงข้อมูลแผนกงาน</title>
    
    <style>
      table thead tr th {
        text-align: center;
      }
    </style>

  </head>
  <body>

    <?php
        include '../main/header.php';
    ?>

    <div class="container-fluid">
      <h3 class="text-center">แสดงข้อมูลแผนกงาน</h3><br>
      <center><a href="../main/departmentInsert.php?departmentId=<?php echo $rowsDept['departmentId']; ?>" class="btn btn-primary mb-3">เพิ่มแผนกงาน</a></center>

        <table id="myTable" class="table table-striped table-bordered" style="width: 100%;" data-toggle="table" data-search="true">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>หน่วยงาน</th>
              <th>แผนกงาน</th>
              <th data-card-footer></th>
            </tr>
          </thead>

          <tbody>
            <?php
                foreach ($rowsDept as $key => $rowDept) {
                ?>
              <tr>
                <td style="text-align: center;"><?php echo $rowDept['office_id']; ?></td>
                <td><?php echo $rowDept['office_name']; ?></td>
                <td><?php echo $rowDept['departmentName']; ?></td>
                <td>
                  <center>
                    <a href="../main/departmentUpdate.php?departmentId=<?php echo $rowDept['departmentId']; ?>" class="btn btn-warning btn-edit"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-danger btn-delete" data-href="../main/departmentDelete.php?departmentId=<?php echo $rowDept['departmentId']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash-alt"></i></button>
                  </center>
                </td>
              </tr>
            <?php
                }
                ?>
          </tbody>
        </table>

        <!-- Modal -->
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
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <a class="btn btn-success btn-confirm-delete">ยืนยัน</a>
              </div>
            </div>
          </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script>
      $('#confirm-delete').on('show.bs.modal', function(event) {
            $(this).find('.btn-confirm-delete').attr('href', $(event.relatedTarget).data('href'));
      });
    </script>

  </body>
</html>
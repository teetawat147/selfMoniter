<?php
  include('../include/connection.php');
  if (!($_SESSION['groupId']=="1" or $_SESSION['groupId']=="2" or $_SESSION['groupId']=="3" )){
    header("Location: ../main/");
  }

  $where="";
  switch ($_SESSION['groupId']) {
    case "1":
      $where="";
      break;
    case "2":
      $where=" where districtCode='".$_SESSION['districtCode']."' ";
      break;
    case "3":
      $where=" where officeId='".$_SESSION['officeId']."' ";
      break;
  
    default:
      # code...
      break;
  }
  $sql = "SELECT CONCAT(p.fname, ' ', p.lname) AS name, o.office_name, p.personId, g.groupName
            FROM person p 
            LEFT JOIN office o ON p.officeId = o.office_id
            left join `group` g on p.groupId = g.groupId 
            ".$where."";
  // echo $sql;
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);
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
    
  
    <title>Admin Health</title>

    <style>

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
      <center><h3>Admin Health</h3></center>
      <table class="table" id="myTable" style="width: 100%;" data-toggle="table" data-search="true">
        <thead>
          <tr>
              <th style="height: 70px; text-align: center; vertical-align: top;">รูปภาพ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">รายชื่อ</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">หน่วยงาน</th>
              <th style="height: 70px; text-align: center; vertical-align: top;">สิทธิ์การใช้งาน</th>               
              <th data-card-footer></th>
            </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rowsPerson as $key => $rowPerson) {
          ?>
              <tr>
                <td><?php echo $rowPerson['personId']; ?></td>
                <td><?php echo $rowPerson['name']; ?></td>
                <td><?php echo $rowPerson['office_name']; ?></td>
                <td><?php echo $rowPerson['groupName']; ?></td>
                <td>
                  <center class="button">
                    <a href="../main/editPersonUpdate.php?personId=<?php echo $rowPerson['personId']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                  </center>
                </td>
              </tr>
            <?php 
              }
            ?>
        </tbody>
      </table>
      <hr>

          </div>
        </div>
      </div>

    </div>

 
  

  </body>
</html>
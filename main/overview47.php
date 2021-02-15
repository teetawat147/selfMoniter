<?php 
    include('../include/connection.php');

    $sql = "SELECT COUNT(ampur_name) AS countPerson, a.ampur_name AS ampurName
            FROM person p
            LEFT JOIN ampur47 a ON p.districtCode = a.ampur_code
            GROUP BY ampur_name DESC";

    $result = $conn -> prepare($sql);
    $result -> execute();
    $rows = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>ภาพรวมจังหวัดสกลนคร</title>

    <style>
    .header {
      position: absolute;
      width: 222px;
      height: 35px;
      left: 150px;
      top: 44px;

      background: #FFB800;
      color: #FFB800;
    }

    .wrapper-content {
      border: 2px solid #000000;
      margin-top: 25px;
      padding: 18px 25px;
    }

    .progress-bar {
      background: #F1F1F1;
      color: #000000;
    }

    .chart-bar {
      background-color: #54FB50;
    }

    @media only screen and (max-width: 768px) {
      .header {
        position: absolute;
        width: 222px;
        height: 35px;
        left: 45px;
        top: 44px;

        background: #FFB800;
        color: #FFB800;
      }
    }

    </style>

  </head>
  <body>
    <div class="container">
      <h3>ภาพรวมจังหวัดสกลนคร</h3>
      <div class="header">.</div>
      <div class="wrapper-content">
        <?php
          foreach ($rows as $key => $row) {
            // totalPerson = จำนวนทั้งหมดของแต่ละอำเภอ, countPerson = จำนวนคนที่ลงทะเบียน ณ ปัจจุบันของแต่ละอำเภอ
            // $percent = $row['countPerson']/100*$row['totalPerson'];
            echo $row['ampurName'];
        ?>
          <div class="progress-bar" style="width: <?php echo $totalPerson ?>%; ">
            <div class="w3-container d-flex align-items-center chart-bar" style="width:<?php echo $row['countPerson']; ?>%; height:30px;">
            </div>
          </div><br>
        <?php
          }
        ?>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  </body>
</html>
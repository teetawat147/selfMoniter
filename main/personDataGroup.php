<?php 
  include('../include/connection.php');

  $sqlPerson = "SELECT d.departmentName, p.departmentId
                FROM person p
                LEFT JOIN department d ON p.departmentId = d.departmentId
                WHERE d.officeId = ".$_SESSION['officeId'];
  
  $result = $conn -> prepare($sqlPerson);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ร้อยละของบุคลากรระดับอำเภอ</title>

    <style>

      .header {
        position: absolute;
        width: 300px;
        height: 35px;
        left: 150px;
        top: 110px;

        background: #FFB800;
        color: #FFB800;
        font-size: 1px;
      }

      .wrapper-content {
        border: 2px solid #000000;
        margin-top: 25px;
        padding: 40px 25px 25px 25px;
      }

      .progress-bar {
        position: relative;
        background: #FFFFFF;
        color: #000000;
        z-index: -1;
      }

      .chart-bar {
        background-color: #54FB50;
      }

      .chart-bar p {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-left: 110%;
        margin-top: 15px;
      }

      @media only screen and (max-width: 768px) {
        .header {
          position: absolute;
          width: 100%;
          height: 35px;
          left: 80px;
          top: 110px;

          background: #FFB800;
          color: #FFB800;
        }

        .wrapper-content {
          border: 2px solid #000000;
          margin-top: 25px;
          margin-right: 250px;
          padding: 40px 25px 25px 25px;
          width: 100%;
        }
      }

      @media only screen and (max-width: 1024px) {
        h3 {
          font-size: 20px;
        }

        .header {
          position: absolute;
          width: 222px;
          height: 35px;
          left: 80px;
          top: 110px;

          background: #FFB800;
          color: #FFB800;
        }

        .wrapper-content {
          border: 2px solid #000000;
          margin-top: 25px;
          margin-right: 250px;
          padding: 40px 25px 25px 25px;
          width: 100%:
        }
      }

    </style>

</head>
<body>
  <?php 
    include('../main/header.php');
  ?>
    <div class="container mb-4 mt-3">
      <h3>ภาพรวมจังหวัดสกลนคร</h3>
      <div class="header">.</div>
        <div class="wrapper-content">
          <?php
            foreach ($rowsPerson as $key => $rowPerson) {
              $percent = round($rowPerson['countPerson']/$rowPerson['totalPerson']*100, 2);
              ?>
              <?php echo $rowPerson['ampur_name']; ?>
              <div class="progress-bar" style="width: <?php echo ($rowPerson['totalPerson']/10); ?>%">
              <div class="d-flex align-items-center chart-bar" style="width: <?php echo $percent/10; ?>%; height:30px;">
                  <p><?php echo $percent; ?>%</p>
                </div>
              </div><br>
          <?php
            }
          ?>
        </div>
      </div>
    </div>

    <?php 
      $sql = "SELECT SUM(count_person) AS totalPerson47 FROM office";
      $result = $conn -> prepare($sql);
      $result -> execute();
      $rowsOffice = $result -> fetch(PDO::FETCH_ASSOC);
    ?>

    <center><p>จำนวนการลงทะเบียนของบุคลากรในจังหวัดสกลนคร <?php echo $rowsOffice['totalPerson47']; ?> คน</p></center>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  </body>
</html>
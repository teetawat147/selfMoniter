<?php 
  include('../include/connection.php');

  $sqlAmpur = "SELECT a.ampur_name, SUM(o.count_person) AS totalPerson
                FROM ampur47 a
                LEFT JOIN office o ON a.ampur_code = o.ampur_code
                GROUP BY a.ampur_name DESC";

  $result = $conn -> prepare($sqlAmpur);
  $result -> execute();
  $rowsAmpur = $result -> fetchAll(PDO::FETCH_ASSOC);

  $sqlPerson = "SELECT a.ampur_name, COUNT(p.districtCode) AS countPerson
                FROM person p
                RIGHT JOIN ampur47 a ON p.districtCode = a.ampur_code
                GROUP BY a.ampur_name DESC";
  
  $stmt = $conn -> prepare($sqlPerson);
  $stmt -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ร้อยละของบุคลากร ระดับอำเภอ</title>

    <style>

      .header {
        position: absolute;
        width: 300px;
        height: 35px;
        left: 170px;
        top: 60px;

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

      @media only screen and (max-width: 360px) {
        h3 {
          font-size: 24px;
        }

        .header {
          position: absolute;
          width: 222px;
          height: 35px;
          left: 60px;
          top: 55px;

          background: #FFB800;
          color: #FFB800;
        }
      }

      @media only screen and (max-width: 414px) {
        .header {
          position: absolute;
          width: 222px;
          height: 35px;
          left: 50px;

          background: #FFB800;
          color: #FFB800;
        }
      }

      @media only screen and (max-width: 320px) {
        h3 {
          font-size: 20px;
        }
      }

      @media only screen and (max-width: 375px) {
        h3 {
          font-size: 20px;
        }

        .header {
          position: absolute;
          width: 222px;
          height: 35px;
          left: 50px;
          top: 50px;

          background: #FFB800;
          color: #FFB800;
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
          left: 120px;
          top: 48px;

          background: #FFB800;
          color: #FFB800;
        }

        .wrapper-content {
          border: 2px solid #000000;
          margin-top: 25px;
          margin-right: 250px;
          padding: 40px 25px 25px 25px;
        }
      }

    </style>

</head>
<body>

  <div class="container mb-4 mt-3">
    <h3>ภาพรวมจังหวัดสกลนคร</h3>
    <div class="header">.</div>
      <div class="wrapper-content">
        <?php
          foreach ($rowsAmpur as $key => $rowAmpur) {
            // foreach ($rowsPerson as $key => $rowPerson) {
                ?>
            <?php echo $rowAmpur['ampur_name']; ?>
            <div class="progress-bar" style="width: <?php echo $rowAmpur['totalPerson']; ?>%">
              <div class="d-flex align-items-center chart-bar" style="width: <?php echo $rowPerson['countPerson']; ?>%-50%; height:30px;">
                <p>50
                  <?php
                    // foreach ($rowsPerson as $key => $rowPerson) {
                      print_r($rowsPerson['countPerson']/$rowAmpur['totalPerson']*100);
                    ?>%</p>
              </div>
            </div><br>
        <?php
            // }
          }
        ?>
      </div>
    </div>
  </div>

    <?php 
      $sql = "SELECT SUM(count_person) AS totalPerson47 FROM office";
      $result = $conn -> prepare($sql);
      $result -> execute();
      $rows = $result -> fetch(PDO::FETCH_ASSOC);
    ?>

    <center><p>จำนวนการลงทะเบียนของบุคลากรในจังหวัดสกลนคร <?php echo $rows['totalPerson47']; ?> คน</p></center>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  </body>
</html>
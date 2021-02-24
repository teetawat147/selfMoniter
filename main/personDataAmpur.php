<?php 
  include('../include/connection.php');

  $sql ="";
  switch ($_SESSION['groupId']) {
    case '1':
      $sql = "SELECT o.office_name,
                COUNT(p.officeId) AS countPerson,
                IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL, ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) AS percent
              FROM office o
              LEFT JOIN ampur47 a ON o.ampur_code = a.ampur_code
              LEFT JOIN person p ON p.officeId = o.office_id
              WHERE a.ampur_code = '".$_SESSION['districtCode']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
      break;

    case '2':
      $sql = "SELECT o.office_name,
                COUNT(p.officeId) AS countPerson,
                IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL, ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) AS percent
              FROM office o
              LEFT JOIN ampur47 a ON o.ampur_code = a.ampur_code
              LEFT JOIN person p ON p.officeId = o.office_id
              WHERE a.ampur_code = '".$_SESSION['districtCode']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
      break;

    case "4":
      $sql = "SELECT o.office_name,
                COUNT(p.officeId) AS countPerson,
                IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL, ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) AS percent
              FROM office o
              LEFT JOIN ampur47 a ON o.ampur_code = a.ampur_code
              LEFT JOIN person p ON p.officeId = o.office_id
              WHERE a.ampur_code = '".$_SESSION['districtCode']."'
              AND p.groupId = '".$_SESSION['groupId']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
      break;

    default:
      # code...
      break;
  }

  $sqlPerson = $sql;

  $result = $conn -> prepare($sqlPerson);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);

  // print_r($rowsPerson);
  // echo "<br>session:";
  // print_r($rowsPerson);

  
  $sql = "SELECT a.ampur_name, SUM(o.count_person) AS totalPerson
          FROM ampur47 a
          LEFT JOIN office o ON a.ampur_code = o.ampur_code
          WHERE a.ampur_code =" .$_SESSION['districtCode'];

  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowAmpur = $result -> fetch();
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
        top: 130px;

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

      @media only screen and (max-width: 568px) {
        .header {
          position: absolute;
          width: 10px;
          height: 35px;
          left: 120px;
          top: 115px;

          background: #FFB800;
          color: #FFB800;
        }
      }

      @media only screen and (max-width: 768px) {
        .container .header {
          position: absolute;
          width: 200px;
          height: 35px;
          left: 80px;
          top: 105px;

          background: #FFB800;
          color: #FFB800;
        }

        .wrapper-content {
          border: 2px solid #000000;
          margin-top: 25px;
          margin-right: 250px;
          padding: 40px 25px 25px 25px;
          width: 100%;
          top: 120px;
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
          top: 115px;

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

  <?php 
    include('../main/header.php');
  ?>

    <div class="container mb-4 mt-3">
      <h3>ร้อยละของบุคลากร ระดับอำเภอ</h3>
      <div class="header">.</div>
        <div class="wrapper-content">
          <?php
            foreach ($rowsPerson as $key => $rowPerson) {
              ?>
              <?php echo $rowPerson['office_name']; ?>
              <div class="progress-bar" style="width: <?php echo $rowPerson['totalPerson']; ?>%">
                <div class="d-flex align-items-center chart-bar" style="width: <?php echo $rowPerson['percent'] +0.5; ?>%; height:30px;">
                  <p><?php echo $rowPerson['percent']; ?>%</p>
                </div>
              </div><br>
          <?php
            }
          ?>
        </div>
      </div>
    </div>

    <p class="text-center">จำนวนการลงทะเบียนของบุคลากรในอำเภอ<?php echo $rowAmpur['ampur_name']; echo " ".$rowAmpur['totalPerson']; ?> คน</p>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
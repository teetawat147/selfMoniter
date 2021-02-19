<?php 
    include('../include/connection.php');

    $sql = "SELECT o.office_name, COUNT(p.officeId) AS amountPerson, (COUNT(p.officeId)/o.count_person)*100 AS percent, o.count_person AS totalPerson
            FROM person p
            LEFT JOIN office o ON p.officeId = o.office_id
            WHERE p.districtCode = '".$_SESSION['districtCode']."'
            GROUP BY p.officeId
            ORDER BY amountPerson DESC";

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

    <title>ร้อยละของบุคลากร ระดับอำเภอ</title>

    <style>

      .header {
        position: absolute;
        width: 300px;
        height: 35px;
        left: 170px;
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
        position: relative;
        background: #FFFFFF;
        color: #000000;
        z-index: -1;
      }

      .chart-bar {
        background-color: #54FB50;
      }

      p {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-left: 110%;
        margin-top: 15px;
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

    <div class="container mb-4">
      <h3>ร้อยละของบุคลากร ระดับอำเภอ</h3>
      <div class="header">.</div>
      <div class="wrapper-content">
        <?php
          foreach ($rows as $key => $row) {
            ?>
            <?php echo $row['office_name']; ?>
          <div class="progress-bar" style="width: <?php echo $row['totalPerson']; ?>%">
            <div class="w3-container d-flex align-items-center chart-bar" style="width: <?php echo $row['percent']; ?>%; height:30px;">
              <p><?php echo round($row['percent']); ?>%</p>
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
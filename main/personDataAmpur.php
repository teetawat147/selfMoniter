<?php 
    include('../include/connection.php');

    $sqlPerson = "SELECT DISTINCT o.ampur_code,
                    a.ampur_name,
                    o.count_person AS totalPerson,
                    o.office_name,
                    COUNT(p.officeId) AS countPerson,
                    ROUND((COUNT(p.officeId)/o.count_person)*100, 2) AS percent
                  FROM office o
                  LEFT JOIN ampur47 a ON o.ampur_code = a.ampur_code
                  LEFT JOIN person p ON o.office_id = p.officeId
                  WHERE o.ampur_code = '".$_SESSION['districtCode']."'
                  GROUP BY p.officeId
                  ORDER BY o.ampur_code";

    $result = $conn -> prepare($sqlPerson)                  ;
    $result -> execute();
    $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);

    // echo "<br>session:";
    // print_r($rowsPerson);
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
          top: 60px;

          background: #FFB800;
          color: #FFB800;
        }
      }

    </style>

  </head>
  <body>

    <div class="container mb-4 mt-3">
      <h3>ร้อยละของบุคลากร ระดับอำเภอ</h3>
      <div class="header">.</div>
      <div class="wrapper-content">
        <?php
          foreach ($rowsPerson as $key => $rowPerson) {
            ?>
            <?php echo $rowPerson['office_name']; ?>
            <div class="progress-bar" style="width: <?php echo $rowPerson['totalPerson']; ?>%">
              <div class="d-flex align-items-center chart-bar" style="width: <?php echo $rowPerson['percent']; ?>%; height:30px;">
                <p><?php echo $rowPerson['percent']; ?>%</p>
              </div>
            </div><br>
        <?php
          }
        ?>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
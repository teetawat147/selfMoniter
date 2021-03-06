<?php 
  include('../include/connection.php');

  $sql ="";
  switch ($_SESSION['groupId']) {
    case '1':
      $sql = "SELECT o.office_name, SUM(o.count_person) AS totalPerson,
            (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
            (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
            FROM office o
            WHERE o.ampur_code = 1
            GROUP BY o.office_name
            ORDER BY o.office_id";
      break;

    case '2':
      $sql = "SELECT o.office_name, SUM(o.count_person) AS totalPerson,
            (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
            (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
            FROM office o
            WHERE o.ampur_code = 1
            GROUP BY o.office_name
            ORDER BY o.office_id";
      break;

    case "4":
      $sql = "SELECT o.office_name, SUM(o.count_person) AS totalPerson,
            (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
            (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
            FROM office o
            WHERE o.ampur_code = 1
            AND o.office_id = 1
            GROUP BY o.office_name
            ORDER BY o.office_id";
      break;

    default:
      break;
  }

  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);

  // print_r($rowsPerson);
  // echo "<br>session:";
  // print_r($rowsPerson);

  
  $sqlAmpur = "SELECT a.ampur_name, SUM(o.count_person) AS totalPerson
          FROM ampur47 a
          LEFT JOIN office o ON a.ampur_code = o.ampur_code
          WHERE a.ampur_code =" .$_SESSION['districtCode'];

  $result = $conn -> prepare($sqlAmpur);
  $result -> execute();
  $rowsAmpur = $result -> fetch(PDO::FETCH_ASSOC);

  $historyLabel = array();
  $historyData = array();
  
  foreach ($rowsPerson as $hKey => $historyValue) {
      array_push($historyLabel, "'".$historyValue['office_name']."'");
      array_push($historyData, $historyValue['percent']);
  }

  $strHistoryLabel = implode(", ", $historyLabel);
  $strHistoryData = implode(", ", $historyData);

//   echo "<br>str_history_label";
//   print_r($strHistoryLabel);
//   echo "<br>str_history_data";
//   print_r($strHistoryData);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <title>ร้อยละของบุคลากรระดับอำเภอ</title>

    <style>
        .header {
            position: relative;
            width: 300px;
            height: 35px;
            left: 170px;
            top: 42px;

            background: #FFB800;
            color: #FFB800;
            font-size: 1px;
        }

        .wrapper-content {
            border: 2px solid #000000;
            margin-top: 25px;
            padding: 40px 25px 25px 25px;
        }

        .content {
            margin-top: 20px;
        }

        @media only screen and (max-width: 768px) {
            .container .header {
                position: relative;
                width: 200px;
                height: 35px;
                left: 60px;
                top: 42px;

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
                position: relative;
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

    <main role="main">
        <div class="container mb-4 mt-3">
            <h3>ร้อยละของบุคลากรระดับอำเภอ</h3>
            <div class="content">
                <div class="header">.</div>
                <div class="wrapper-content">
                    <canvas id="personAmpurChart" width="100%" height="100%"></canvas>
                </div><br>
            </div>
        </div>

        <div class="content-footer">
            <p class="text-center">จำนวนการลงทะเบียนของบุคลากรในอำเภอ<?php echo $rowsAmpur['ampur_name'];
            echo " ".$rowsAmpur['totalPerson']; ?> คน</p>
        </div>

    </main>

    <!-- กราฟ -->
    <script>
        var ctx = document.getElementById("personAmpurChart").getContext('2d');

        var data = {
            labels: [<?php echo $strHistoryLabel; ?>],
            datasets: [{
                label: "ร้อยละของบุคลากรระดับอำเภอ",
                data: [<?php echo $strHistoryData; ?>],
                backgroundColor: "rgba(84, 251, 80, 1.0)"
            }]
        }

        var ctx = new Chart(ctx, {
            type: 'horizontalBar',
            data: data,
            options: {
                "hover": {
                    "animationDuration": 1
                },
                "animation": {
                    "onComplete": function() {
                        var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                        this.data.datasets.forEach(function(dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function(bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data + ' %', bar._model.x + 10, bar._model.y + 1);
                            });
                        });
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if(label) {
                                label += 'คิดเป็น %';
                            }
                            return label;
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            <?php
                                if(($_SESSION['groupId'] == '2') or ($_SESSION['groupId'] == '1')) {
                                ?>
                                    max: <?php echo $rowsAmpur['totalPerson']; ?>,
                            <?php
                                }
                                ?>
                            stepSize: 5
                        }
                    }]
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>
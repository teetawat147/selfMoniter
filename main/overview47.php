<?php 
  include('../include/connection.php');

  if (!($_SESSION['fname'])) {
    header("location: ../main/login.php");
  }

  switch ($_SESSION['groupId']) {
    case '1':
      $sql = "SELECT a.ampur_name,
                (SELECT COUNT(p.districtCode) FROM person p WHERE p.districtCode = a.ampur_code) AS countPerson, 
                (SELECT SUM(o.count_person) FROM office o WHERE o.ampur_code = a.ampur_code) AS totalPerson,
                ROUND((SELECT COUNT(p.districtCode) FROM person p WHERE p.districtCode = a.ampur_code)/(SELECT SUM(o.count_person) FROM office o WHERE o.ampur_code = a.ampur_code)*100, 2) AS percent
              FROM ampur47 a
              GROUP BY a.ampur_name DESC";
      break;
    
    default:
      break;
  }
  
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);
  
  $sqlTotal = "SELECT SUM(count_person) AS totalPerson FROM office";
  $stmt = $conn -> prepare($sqlTotal);
  $stmt -> execute();
  $rowTotal = $stmt -> fetch(PDO::FETCH_ASSOC);

  $historyLabel = array();
  $historyData = array();

  foreach ($rowsPerson as $hKey => $historyValue) {
    array_push($historyLabel, "'".$historyValue['ampur_name']."'");
    array_push($historyData, $historyValue['percent']);
  }

  $strHistoryLabel = implode(", ", $historyLabel);
  $strHistoryData = implode(", ", $historyData);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <title>ภาพรวมจังหวัดสกลนคร</title>

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
          <h3>ภาพรวมจังหวัดสกลนคร</h3>
          <div class="content">
            <div class="header">.</div>
              <div class="wrapper-content">
                <canvas id="personChangwatChart" width="100%" height="100%"></canvas>
              </div><br>
          </div>
          <div class="content-footer">
            <p class="text-center">จำนวนการลงทะเบียนของบุคลากรในจังหวัดสกลนคร <?php echo $rowTotal['totalPerson']; ?> คน</p>
          </div>
    </div>
  </main>

    <!-- กราฟ -->
    <script>

      var ctx = document.getElementById("personChangwatChart").getContext('2d');

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
                                ctx.fillText(data + ' %', bar._model.x + 10, bar._model.y);
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
<?php
  include('../include/connection.php');
  $sql = "SELECT * FROM count_ampur";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsOffice = $result -> fetchAll(PDO::FETCH_ASSOC);


//   print_r($rowsOffice);

//   print_r($rowsOffice);

$historyAmpur = array();
$historyAmpurLabel = array();

foreach ($rowsOffice as $hkey => $historyValue) {

    // echo "history Value";
    // print_r($historyValue);

    $historyPercent = round($historyValue['Percent'], 2);

  array_push($historyAmpur,$historyPercent);
  array_push($historyAmpurLabel,"'".$historyValue['ampur_name']."'");
}
$strHistoryAmpur=implode(", ",$historyAmpur);
$strHistoryLabel=implode(", ",$historyAmpurLabel);



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script scr="https://github.com/chmille4/Scribl/raw/master/lib/Scribl.svg.js"></script>


    <title>รายงานเจ้าหน้าที่ระดับอำเภอ</title>

    <style>

      /* canvas
      {
        background-image: url('../images/white.jpg');
      } */

      .content
      {
        margin-top: 20px;
      }
      .content-title p
      {
        padding: 10px 10px;
        border-radius: 8px 8px 0 0;
        background: #F6F6F6;
      }
      .content-body
      {
        margin-top: -20px;
        border: 2px solid #F6F6F6;
      }
      .content-body.pie-chart
      {
        display: flex;
        justify-content: center;
      }
      .content-body p
      {
        margin-top: 8px;
        padding: 0px 10px;
      }
      .content-body.risk p,
      .content-body.waist p,
      .content-body.high-pressure-normal p
      {
        line-height: 20px;
      }
      #p3,
      .content-title
      {
        text-align: center;
      }

      button:hover
      {
        background-color: #e5e5e5;
        color: #000;
        border: 1px solid #000;
        transform: scale(1.05);
        cursor: pointer;
      }
      @media screen and (max-width: 423px)
      {
        button
        {
          font-size: 10px;
        }
      }
    </style>
  </head>
  <body>
    <?php
      include "./header.php";
    ?>

    <div class="container">
      <br>
      <center><h3>รายงานเจ้าหน้าที่ระดับอำเภอ</h3></center>
      <br>
        <div class="content">
            <div class="dropdown d-flex justify-content-end mb-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-download"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a id="download-jpg" download="ChartImage.jpg" href="" class="btn btn-success float-right bg-flat-color-1" title="reportAdminChangwat">jpg</i></a>
                    <a id="download-png" download="ChartImage.png" href="" class="btn btn-success float-right bg-flat-color-1" title="reportAdminChangwat">png</a>
                    <a id="download-svg" download="ChartImage.svg" href="" class="btn btn-success float-right bg-flat-color-1" title="reportAdminChangwat">svg</a>
                    <button type="button" id="download-pdf" class="btn btn-success float-right bg-flat-color-1">pdf</button>
                </div>
            </div>


            <div class="content-title">
                <p>อำเภอ</p>
            <div class="content-body">
                <canvas id="chart_ampur"></canvas>
            </div>
        </div>

        <table class="table" id="myTable" style="width: 100%;" data-toggle="table" >
            <thead>
            <tr>
                <th style="height: 70px; text-align: center; vertical-align: top;">อำเภอ</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">จำนวนเจ้าหน้าที่ทั้งหมด</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">จำนวนเจ้าหน้าที่ลงบันทึกข้อมูล</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">ร้อยละ</th><br><br><br>
                <!-- <th data-card-footer></th> -->
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($rowsOffice as $key => $rowOffice) {
            ?>
                <tr>
                    <td><?php echo $rowOffice['ampur_name']; ?></td>
                    <td><?php echo $rowOffice['NEWCountPerson']; ?></td>
                    <td><?php echo $rowOffice['count_districtCode']; ?></td>
                    <td><?php echo round($rowOffice['Percent'], 2); ?></td>

                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
        <hr>
    </div>

    <script>

    var ctx = document.getElementById("chart_ampur").getContext('2d');

        var data = {
            labels: [<?php echo $strHistoryLabel; ?>],
            datasets: [{
                label: "ร้อยละของเจ้าหน้าที่ระดับอำเภอ",
                data: [<?php echo $strHistoryAmpur; ?>],
                backgroundColor: "#50B432"
            }]
        }

        var ctx = new Chart(ctx, {
            type: 'bar',
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
                                ctx.fillText(data + ' %', bar._model.x - 20, bar._model.y - 10);
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
                    yAxes: [{
                        ticks: {
                            stepSize: 20
                        },
                        gridLines: {
                            display: true,
                            drawOnChartArea: true,
                            drawBorder: true
                        }
                    }]
                },
                responsive: true
            }
        });

        exportImage("download-jpg", "chart_ampur", "image/jpg", "download-jpg");
        exportImage("download-png", "chart_ampur", "image/png", "download-png");


        function exportImage(btnId, chartId, imageTo, buttonId) {
            document.getElementById(btnId).addEventListener("click", function() {
                var url_base64jp = document.getElementById(chartId).toDataURL(imageTo);
                var a = document.getElementById(buttonId);
                a.href = url_base64jp;
            })
        }

        var backgroundColor = 'white';
        Chart.plugins.register({
            beforeDraw: function(c) {
                var ctx = c.chart.ctx;
                ctx.fillStyle = backgroundColor;
                ctx.fillRect(0, 0, c.chart.width, c.chart.height);
            }
        });

        document.getElementById('download-pdf').addEventListener("click", downloadPDF);

        function downloadPDF() {
            var canvas = document.getElementById('chart_ampur');
            var canvasImg = canvas.toDataURL("image/jpg", 1.0);

            var doc = new jsPDF('landscape');
            doc.setFontSize(20);
            doc.text(15, 15, "report changwat chart");
            doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
            doc.save('reportAdminChangwat.pdf');
        }
        

        var img = ctx.canvas.toDataURL("image/png");
        document.getElementById('download-png').href = img;

        var targetSVG = document.getElementById('download-svg');
        CanvasToSVG.convert(ctx.canvas, targetSVG);
        const downPngBtn = document.getElementById('download-png').href = targetSVG.firstChild.imageData;
        console.log(downPngBtn);

    </script>

    

  </body>
</html>
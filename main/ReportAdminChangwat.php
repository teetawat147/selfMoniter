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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <title>รายงานเจ้าหน้าที่ระดับอำเภอ</title>

    <style>

      .flex-content {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
      }

      .flex-content button {
        margin-left: 10px;
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

        <div class="content-title">
          <figure class="highcharts-figure">
            <div id="chart-ampur"></div>
          </figure>
        </div>

          <table id="myTable" class="table table-striped table-bordered" style="width: 100%;" data-toggle="table">
            <thead>
              <tr>
                <th style="height: 70px; text-align: center; vertical-align: top;">อำเภอ</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">จำนวนเจ้าหน้าที่ทั้งหมด</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">จำนวนเจ้าหน้าที่ลงบันทึกข้อมูล</th>
                <th style="height: 70px; text-align: center; vertical-align: top;">ร้อยละ</th>
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
    </div>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>

    <script>

    // var ctx = document.getElementById("chart_ampur").getContext('2d');

    //     var data = {
    //         labels: [<?php echo $strHistoryLabel; ?>],
    //         datasets: [{
    //             label: "ร้อยละของเจ้าหน้าที่ระดับอำเภอ",
    //             data: [<?php echo $strHistoryAmpur; ?>],
    //             backgroundColor: "#50B432"
    //         }]
    //     }

    //     var ctx = new Chart(ctx, {
    //         type: 'bar',
    //         data: data,
    //         options: {
    //             "hover": {
    //                 "animationDuration": 1
    //             },
    //             "animation": {
    //                 "onComplete": function() {
    //                     var chartInstance = this.chart,
    //                     ctx = chartInstance.ctx;

    //                     this.data.datasets.forEach(function(dataset, i) {
    //                         var meta = chartInstance.controller.getDatasetMeta(i);
    //                         meta.data.forEach(function(bar, index) {
    //                             var data = dataset.data[index];
    //                             ctx.fillText(data + ' %', bar._model.x - 20, bar._model.y - 10);
    //                         });
    //                     });
    //                 }
    //             },
    //             tooltips: {
    //                 callbacks: {
    //                     label: function(tooltipItem, data) {
    //                         var label = data.datasets[tooltipItem.datasetIndex].label || '';

    //                         if(label) {
    //                             label += 'คิดเป็น %';
    //                         }
    //                         return label;
    //                     }
    //                 }
    //             },
    //             scales: {
    //                 yAxes: [{
    //                     ticks: {
    //                         stepSize: 20
    //                     },
    //                     gridLines: {
    //                         display: true,
    //                         drawOnChartArea: true,
    //                         drawBorder: true
    //                     }
    //                 }]
    //             },
    //             responsive: false
    //         }
    //     });

    //     exportImage("download-jpg", "chart_ampur", "image/jpg", "download-jpg");
    //     exportImage("download-png", "chart_ampur", "image/png", "download-png");


    //     function exportImage(btnId, chartId, imageTo, buttonId) {
    //         document.getElementById(btnId).addEventListener("click", function() {
    //             var url_base64jp = document.getElementById(chartId).toDataURL(imageTo);
    //             var a = document.getElementById(buttonId);
    //             a.href = url_base64jp;
    //         })
    //     }

    //     var backgroundColor = 'white';
    //     Chart.plugins.register({
    //         beforeDraw: function(c) {
    //             var ctx = c.chart.ctx;
    //             ctx.fillStyle = backgroundColor;
    //             ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    //         }
    //     });

        // document.getElementById('download-pdf').addEventListener("click", downloadPDF);

        // function downloadPDF() {
        //     var canvas = document.getElementById('chart_ampur');
        //     var canvasImg = canvas.toDataURL("image/jpg", 1.0);

        //     var doc = new jsPDF('landscape');
        //     doc.setFontSize(20);
        //     doc.text(15, 15, "report changwat chart");
        //     doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
        //     doc.save('รายงานเจ้าหน้าที่ระดับอำเภอ.pdf');
        // }


        Highcharts.chart('chart-ampur', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'รายงานเจ้าหน้าที่ระดับอำเภอ'
          },
          xAxis: {
            categories: [
              <?php echo $strHistoryLabel; ?>
            ],
            crosshair: true
          },
          yAxis: {
            title: false,
            max: 100
          },
          tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
          },
          plotOptions: {
            column: {
              pointPadding: 0.2,
              borderWidth: 0
            }
          },
          series: [{
            name: "ร้อยละ",
            data: [<?php echo $strHistoryAmpur; ?>],
            color: '#50B432'
          }],
          legend: {
            enabled: false
          },
          credits: {
            enabled: false
          }
        });
        
        var data = {
          "sSearch": "ค้นหา :",
          "sUrl": "",
          "sLoadingRecords": "กำลังบันทึก",
          "buttons": {
            "copyTitle": 'คัดลอกข้อมูล'
          },
          "sInfo": "",
          "sInfoEmpty": ""
        };
        
        $(document).ready(function() {
          var table = $('#myTable').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            'info': true,
            "autoWidth": true,
            'language': data,
            dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
            buttons: {
              dom: {
                container: {
                  tag: 'div',
                  className: 'flex-content'
                },
                buttonLiner: {
                  tag: null
                }
              },
              buttons: [
                {
                  extend: 'copyHtml5',
                  text: '<i class="fa fa-clipboard"></i> Copy',
                  title: 'Text',
                  titleAttr: 'Copy',
                  className: 'btn btn-app export barras',
                  exportOptions: {
                    columns: [0, 1]
                  }
                },
                {
                  extend: 'pdfHtml5',
                  text: '<i class="fa fa-file-pdf-o"></i> PDF',
                  title: 'PDF',
                  titleAttr: 'PDF',
                  className: 'btn btn-app export pdf',
                  exportOptions: {
                    columns: [0, 1]
                  },
                  customize: function(doc) {
                    doc.styles.title = {
                      color: '#50B432',
                      fontSize: '30',
                      alignment: 'center'
                    }
                    doc.styles['td:nth-child(2)'] = {
                      width: '100px',
                      'max-width': '100px'
                    },
                    doc.styles.tableHeader = {
                      fillColor: '#50B432',
                      color: 'white',
                      alignment: 'center'
                    },
                    doc.content[1].margin = [100, 0, 100, 0]
                  }
                },
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa fa-file-excel-o"></i> Excel',
                  title: 'Excel',
                  titleAttr: 'Excel',
                  className: 'btn btn-app export excel',
                  exportOptions: {
                    columns: [0, 1]
                  },
                },
                {
                  extend: 'csvHtml5',
                  text: '<i class="fa fa-file-text-o"></i> CSV',
                  title: 'CSV',
                  titleAttr: 'CSV',
                  className: 'btn btn-app export csv',
                  exportOptions: {
                    columns: [0, 1]
                  }
                },
                {
                  extend: 'print',
                  text: '<i class="fa fa-print"></i> Print',
                  title: 'Print',
                  titleAttr: 'Print',
                  className: 'btn btn-app export print',
                  exportOptions: {
                    columns: [0, 1]
                  }
                }
              ]
            }
          });
        });

    </script>

  </body>
</html>
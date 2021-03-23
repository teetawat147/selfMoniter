<?php 
  include('../include/connection.php');

  if (!($_SESSION['fname'])) {
    header("location: ../main/login.php");
  } else if ($_SESSION['groupId'] == 1 && !($_GET["ampur_code"])) {
    header("location: ../main/reportAdminChangwat.php");
  }

  // $sql ="";
  switch ($_SESSION['groupId']) {
    case '1':
      $sql = "SELECT o.office_id, o.office_name, SUM(o.count_person) AS totalPerson,
              (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
              (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
              FROM office o
              WHERE o.ampur_code = '".$_GET['ampur_code']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
      break;

    case '2':
      $sql = "SELECT o.office_id, o.office_name, SUM(o.count_person) AS totalPerson,
              (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
              (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
              FROM office o
              WHERE o.ampur_code = '".$_SESSION['districtCode']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
      break;

    case "4":
      $sql = "SELECT o.office_id, o.office_name, SUM(o.count_person) AS totalPerson,
              (SELECT COUNT(p.officeId) FROM person p WHERE p.officeId = o.office_id) AS countPerson,
              (SELECT IF(ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2) IS NOT NULL ,ROUND(COUNT(p.officeId)/SUM(o.count_person)*100, 2), 0.00) FROM person p WHERE p.officeId = o.office_id) AS percent
              FROM office o
              WHERE o.office_id = '".$_SESSION['officeId']."'
              GROUP BY o.office_name
              ORDER BY o.office_id";
              break;

    default:
      break;
  }

  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsPerson = $result -> fetchAll(PDO::FETCH_ASSOC);

  $historyLabel = array();
  $historyData = array();
  
  foreach ($rowsPerson as $hKey => $historyValue) {
      array_push($historyLabel, "'".$historyValue['office_name']."'");
      array_push($historyData, $historyValue['percent']);
  }

  $strHistoryLabel = implode(", ", $historyLabel);
  $strHistoryData = implode(", ", $historyData);

  // // echo "<br><br>str_history_label";
  // print_r($strHistoryLabel);
//   echo "<br>str_history_data";
//   print_r($strHistoryData);
?>


<!doctype html>
<html lang="th">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    
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
      .button {
        position: relative;
        left: 763px;
        top: 96px;
        z-index: 1;
      }

      .flex-content {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
      }

      .flex-content button {
        margin-left: 10px;
      }
      
      @media only screen and (max-width: 1125px) {
        .button {
          position: relative;
          width: 85px;
          top: 96px;
          left: 580px;
        }
      }

      @media only screen and (max-width: 768px) {
        .flex-content {
          width: 75%;
        }

        .button {
          left: 77%;
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

        <div class="content-title">
          <figure class="highcharts-figure">
            <div id="chart-ampur"></div>
          </figure>
        </div>

        <button class="btn btn-secondary button" id="export"><i class="fa fa-file-word-o" aria-hidden="true"></i> Word</button>

        <div id="docx">
          <div class="word-section1">
            <table id="myTable" class="table table-striped table-bordered" style="width: 100%;" data-toggle="table" data-search="true">
              <thead>
                <tr>
                  <th class="text-center">อำเภอ</th>
                  <th class="text-center">จำนวนเจ้าหน้าที่ทั้งหมด</th>
                  <th class="text-center">จำนวนเจ้าหน้าที่ลงบันทึกข้อมูล</th>
                  <th class="text-center">ร้อยละ</th>
                  <th data-card-footer></th>
                </tr>
              </thead>
              <tbody>
              <?php
                  // print_r($rowsPerson);
                  foreach ($rowsPerson as $key => $rowPerson) {
                  ?>
                  <tr>
                      <td class="text-left"><?php echo $rowPerson['office_name']; ?></td>
                      <td><?php echo $rowPerson['totalPerson']; ?></td>
                      <td><?php echo $rowPerson['countPerson']; ?></td>
                      <td><?php echo $rowPerson['percent']; ?></td>
                      <td><a href="../main/reportAdminDept.php?office_id=<?php echo $rowPerson['office_id']; ?>" class="btn btn-info">เข้าถึง</a></td>
                  </tr>
                  <?php 
                  }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    
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

        Highcharts.chart('chart-ampur', {
          chart: {
            type: 'bar'
          },
          title: {
            text: 'รายงานเจ้าหน้าที่ระดับอำเภอ'
          },
          xAxis: {
            categories: [<?php echo $strHistoryLabel; ?>],
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
            data: [<?php echo $strHistoryData; ?>],
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
          // "sSearch": "ค้นหา :",
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
            "searching": false,
            "ordering": false,
            'info': true,
            "autoWidth": true,
            'language': data,
            dom: 'Bfrtip<"col-md-6 inline"i> <"col-md-6 inline"p>',
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
                    columns: ':visible'
                  }
                },
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa fa-file-excel-o"></i> Excel',
                  title: 'Excel',
                  titleAttr: 'Excel',
                  className: 'btn btn-app export excel',
                  exportOptions: {
                    columns: ':visible'
                  },
                },
                {
                  extend: 'print',
                  text: '<i class="fa fa-file-pdf-o"></i> PDF',
                  className: 'btn btn-app export print',
                  exportOptions: {
                    columns: ':visible'
                  }
                }
              ]
            }
          });
        });


        window.export.onclick = function() {
 
        if (!window.Blob) {
            alert('Your legacy browser does not support this action.');
            return;
        }

        var html, link, blob, url, css;
        
        // EU A4 use: size: 841.95pt 595.35pt; //แนวนอน
        // EU A4 use: size: 595.35pt 841.95pt ; //แนวตั้ง
        // US Letter use: size:11.0in 8.5in;
        
        css = (
          '<style>' +
          '@page word-section1{size: 595.35pt 841.95pt;mso-page-orientation: portrait;}' +
          'div.word-section1 {page: word-section1;}' +
          'table{border-collapse:collapse;}td{border:1px gray solid;width:5em;padding:2px;}'+
          '</style>'
        );
        
        html = window.docx.innerHTML;
        blob = new Blob(['\ufeff', css + html], {
          type: 'application/msword'
        });
        url = URL.createObjectURL(blob);
        link = document.createElement('A');
        link.href = url;
        // Set default file name. 
        // Word will append file extension - do not add an extension here.
        link.download = 'reportAdminAmpur';
        document.body.appendChild(link);
        if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, 'reportAdminAmpur.doc'); // IE10-11
            else link.click();  // other browsers
        document.body.removeChild(link);
      };

    </script>

  </body>
</html>
<?php
  include('../include/connection.php');

  $sql = "SELECT * FROM count_ampur";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rowsOffice = $result -> fetchAll(PDO::FETCH_ASSOC);

$historyAmpur= array();
$historyAmpurLabel= array();

foreach ($rowsOffice as $hkey => $historyValue) {
  array_push($historyAmpur,$historyValue['percent']);
  array_push($historyAmpurLabel,$historyValue['ampur_name']);
}
$strHistoryAmpur=implode(", ",$historyAmpur);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  
    <title>ReportAdminChangwat</title>

    <style>

    button,
    center a {
      margin-top: 7px;
      width: 12ch;
    }

    center div {
      width: 120px;
      height: 180px;
    }

    .img-add-data {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
    }

    .btn-edit,
    .btn-delete {
      width: 7ch;
      margin-right: 10px;
    }

    .title-main
      {
        position: flex;
        margin-top: 20px;
        padding: 5px;
        background-color: #D3D3D3;
        border-radius: 8px;
        text-align: center;
      }

      .title-main p,
      canvas
      {
        margin-top: 5px;
      }

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

      button
      {
        margin: 20px 30px;
        padding: 2px 25px;
        font-size: 14px;
        background: #C4C4C4;
        height: 30px;
        border: 0px;
        border-radius: 4px;
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

    <div class="container-fluid mt-2">
      <br>
      <center><h3>Report Admin Changwat</h3></center>
      <br>
      
    <div class="content">
      <div class="content-title">
        <p>อำเภอ</p>
      </div>
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
                <td><?php echo $rowOffice['Percent']; ?></td>
               
              </tr>
            <?php 
              }
            ?>
        </tbody>
      </table>
      <hr>

    <script>
    
    let chart_ampurElem = document.getElementById('chart_ampur').getContext('2d');
    let chart_ampur = new Chart(chart_ampurElem,{
      type:"bar",
      data:{
        labels:[
          <?php echo $historyAmpurLabel; ?>
        ],

       datasets:[
          {
            label:"Risk",
            data:[
              <?php echo $strHistoryAmpur; ?>
                ],
            fill:false,
            backgroundColor:[
              "rgba(255, 99, 132, 0.2)",
              "rgba(255, 159, 64, 0.2)",
              "rgba(255, 205, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(201, 203, 207, 0.2)"],
            borderColor:[
              "rgb(255, 99, 132)",
              "rgb(255, 159, 64)",
              "rgb(255, 205, 86)",
              "rgb(75, 192, 192)",
              "rgb(54, 162, 235)",
              "rgb(153, 102, 255)",
              "rgb(201, 203, 207)"],
            borderWidth:5
          }
        ]
      },
      options:{
        legend:{display:false},
        annotation: {
    annotations: [{
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: '26',
        borderColor: 'tomato',
        borderWidth: 1
    }],
    drawTime: "afterDraw" // (default)
},
        scales:{
                yAxes:[{
                    ticks:{
                    beginAtZero:true,
                    max: <?php echo $maxCountAll+(10*$maxCountAll/100); ?>,
                    min: 0,
                    stepSize: <?php echo ceil($maxCountAll/10); ?>
                    }
                }],

                
                }
            }
            });
    </script>

  </body>
</html>
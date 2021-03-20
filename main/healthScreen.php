<?php
  include('../include/connection.php');
  include('../include/function.php');
if (!$_SESSION['fname']){
  header("Location: ../main/login.php");
}
  if (!(isset($_GET['helpRecordId']))){
    $sql="select * from health_data_record h where h.personId=".$_SESSION['personId']." order by helpRecordId desc limit 1";
    $result = $conn -> prepare($sql);
    $result -> execute();
    $myRecords = $result -> fetchAll(PDO::FETCH_ASSOC);
    $helpRecordId=$myRecords[0]['helpRecordId'];
  }else{
    $helpRecordId=$_GET['helpRecordId'];    
  }

  $sql = "SELECT h.*,p.birthdate,
    b.*,
    h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) as bmi,
    p.sexId,
    (1-power(0.978296,exp(((0.079*(YEAR(curdate())-YEAR(p.birthdate)-(DATE_FORMAT(curdate(), '%m%d') < DATE_FORMAT(p.birthdate, '%m%d'))))+(0.128*p.sexId)+(0.019350987*h.bpUpper)+(0.58454*h.diabetesId)+(3.512566*((h.waist)/h.healthHeight))+(0.459*h.smokeId))-7.720484)))*100 as cvd_score
  FROM health_data_record h 
  left join person p on h.personId=p.personId
  LEFT JOIN bmi b ON h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) >= IF(p.sexId = 1,b.sex1min,b.sex2min)
    AND h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) < IF(p.sexId = 1,b.sex1max,b.sex2max)
  WHERE h.helpRecordId = '".$helpRecordId."'
  order by h.inputDatetime";

// echo "<br>sql=".$sql;
  $result = $conn -> prepare($sql);
  $result -> execute();
  $rows = $result -> fetchAll(PDO::FETCH_ASSOC);
  $now_row=$rows[0];
// echo "<br>now_row=";
// print_r($now_row);

  $sqlBmi = "SELECT p.personId,
    p.sexId,
    h.healthWeight,
    h.healthHeight,
    h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) AS bmi,
    b.nameBmi, 
    h.waist,
    h.bpUpper,
    h.bpLower,
    h.bloodsugar,
    b.conclude, 
    b.advice,
    h.inputDatetime, 
    h.lastUpdate,
    (1-power(0.978296,exp(((0.079*(YEAR(curdate())-YEAR(p.birthdate)-(DATE_FORMAT(curdate(), '%m%d') < DATE_FORMAT(p.birthdate, '%m%d'))))+(0.128*p.sexId)+(0.019350987*h.bpUpper)+(0.58454*h.diabetesId)+(3.512566*((h.waist)/h.healthHeight))+(0.459*h.smokeId))-7.720484)))*100 as cvd_score
  FROM health_data_record h
    LEFT JOIN person p ON h.personId = p.personId
    LEFT JOIN bmi b ON h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) >= IF(p.sexId = 1,b.sex1min,b.sex2min)
    AND h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) < IF(p.sexId = 1,b.sex1max,b.sex2max)
  WHERE h.personId='".$_SESSION['personId']."'
  ORDER BY h.inputDatetime";
// echo "<br>sqlBmi=".$sqlBmi;
  $resultBmi = $conn -> prepare($sqlBmi);
  $resultBmi -> execute();
  $history_rows = $resultBmi -> fetchAll(PDO::FETCH_ASSOC);
// echo "<br>history_rows=<br>";
// print_r($history_rows);

$sql="select * from bmi where id=2";
$result = $conn -> prepare($sql);
$result -> execute();
$rowNormalBmi = $result -> fetch(PDO::FETCH_ASSOC);

// echo "<br>rowNormalBmi=";
// print_r($rowNormalBmi);

$sql = "
SELECT
	CEILING(((
		1 - power(
			0.978296,
			exp(
				(
					(
						0.079 * (
							YEAR (curdate()) - YEAR (p.birthdate) - (
								DATE_FORMAT(curdate(), '%m%d') < DATE_FORMAT(p.birthdate, '%m%d')
							)
						)
					) + (0.128 * p.sexId) + (0.019350987 * h.bpUpper) + (0.58454 * h.diabetesId) + (
						3.512566 * ((h.waist) / h.healthHeight)
					) + (0.459 * h.smokeId)
				) - 7.720484
			)
		)
	) * 100)/10) AS cvd_level,
count(*) as countAll
FROM
	health_data_record h
LEFT JOIN person p ON h.personId = p.personId
LEFT JOIN bmi b ON h.healthWeight / (
	(h.healthHeight / 100) * (h.healthHeight / 100)
) >=
IF (
	p.sexId = 1,
	b.sex1min,
	b.sex2min
)
AND h.healthWeight / (
	(h.healthHeight / 100) * (h.healthHeight / 100)
) <
IF (
	p.sexId = 1,
	b.sex1max,
	b.sex2max
)
WHERE
h.helpRecordId in (select max(helpRecordId) AS max_helpRecordId from health_data_record group by personId) and
p.personId
GROUP BY 
cvd_level";
$result = $conn -> prepare($sql);
$result -> execute();
$rows_cvd_level = $result -> fetchAll(PDO::FETCH_ASSOC);
// echo "cvd level<br>";
// print_r($rows_cvd_level);


$maxCountAll=0;
$cvd_level_label=array();
$cvd_level_data=array();
for ($i=1; $i <=10 ; $i++) { 
  $key = arraySearch2D($rows_cvd_level,'cvd_level',$i);
  if($key>0){
    array_push($cvd_level_label,"'".$rows_cvd_level[$key-1]['cvd_level']."'");
    array_push($cvd_level_data,$rows_cvd_level[$key-1]['countAll']);
    $maxCountAll=($maxCountAll<$rows_cvd_level[$key-1]['countAll'])?$rows_cvd_level[$key-1]['countAll']:$maxCountAll;
  }else{
    array_push($cvd_level_label,"'".$i."'");
    array_push($cvd_level_data,0);
  }
}
$str_cvd_level_label=implode(", ",$cvd_level_label);
$str_cvd_level_data=implode(", ",$cvd_level_data);


$history_label=array();
$history_bmi_data=array();
$history_waist_data=array();
$history_weight_data=array();
$history_bpUpper_data=array();
$history_bpLower_data=array();
$history_bloodsugar_data=array();
$history_cvd_score_data=array();
foreach ($history_rows as $hkey => $hvalue) {
  array_push($history_label,"'".$hvalue['inputDatetime']."'");
  array_push($history_bmi_data,$hvalue['bmi']);
  array_push($history_waist_data,$hvalue['waist']);
  array_push($history_bpUpper_data,$hvalue['bpUpper']);
  array_push($history_bpLower_data,$hvalue['bpLower']);
  array_push($history_bloodsugar_data,$hvalue['bloodsugar']);
  array_push($history_weight_data,$hvalue['healthWeight']);
  array_push($history_cvd_score_data,$hvalue['cvd_score']);
}
$str_history_label=implode(", ",$history_label);
$str_history_bmi_data=implode(", ",$history_bmi_data);
$str_history_waist_data=implode(", ",$history_waist_data);
$str_history_bpUpper_data=implode(", ",$history_bpUpper_data);
$str_history_bpLower_data=implode(", ",$history_bpLower_data);
$str_history_bloodsugar_data=implode(", ",$history_bloodsugar_data);
$str_history_weight_data=implode(", ",$history_weight_data);
$str_history_cvd_score_data=implode(", ",$history_cvd_score_data);

// echo "<br>str_history_label";
// print_r($str_history_label);
// echo "<br>str_history_bmi_data";
// print_r($str_history_bmi_data);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ผลการคัดกรองด้วยตนเอง</title>
    <style>
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

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  </head>
  <body>

  <?php
    include("../main/header.php");   
  ?>

<main role="main">
  <div class="container">
    <div class="title-main">
      <p>ผลการคัดกรองด้วยตนเอง <br> (<?php echo thaiShortDate($now_row['inputDatetime']); ?>)</p>
    </div>
    <div class="content">
      <div class="content-title">
        <p> <?php echo $now_row['nameBmi']; ?> </p>
      </div>
      <div class="content-body">
        <p id="p1"> <?php echo $now_row['conclude']; ?></p>
        <p id="p2"><b>คำแนะนำเบื้องต้น</b> <br> <?php echo html_entity_decode($now_row['advice']); ?></p>
        <?php
          $minWeight = round($rowNormalBmi['sex'.$now_row['sexId'].'min']*(($now_row['healthHeight']/100)*($now_row['healthHeight']/100)),2);
          $maxWeight = round($rowNormalBmi['sex'.$now_row['sexId'].'max']*(($now_row['healthHeight']/100)*($now_row['healthHeight']/100)),2);
        ?>
        <p id="p3">
          คุณมีน้ำหนักอยู่ในช่วงที่ดีแล้ว ขอให้รักษาน้ำหนักอยู่ระหว่าง <?php echo $minWeight; ?> กก. ถึง <?php echo $maxWeight; ?> กก. ต่อไปนะคะ
        </p>
      </div>
    </div>


    <div class="content">
      <div class="content-title">
        <p class="text-bmi">BMI</p>
      </div>
      <div class="content-body">
        <canvas id="chart-bmi"></canvas>
      </div>
    </div>




    <div class="content">
      <div class="content-title">
        <p>น้ำหนัก</p>
      </div>
      <div class="content-body">
        <canvas id="chart-weight"></canvas>
      </div>
    </div>

<?php 
  $sql = "SELECT * FROM cvdScore WHERE ".$now_row['cvd_score']." >= cvdMin and ".$now_row['cvd_score']." <= cvdMax";
  $result = $conn -> prepare($sql);
  $result -> execute();
  $cvdScore = $result -> fetch(PDO::FETCH_ASSOC);
  // print_r($cvdScore);
?>

    <div class="content">
      <div class="content-title">
        <p>ความเสี่ยงต่อโรคหัวใจใน 10 ปี = <?php echo $cvdScore['cvdName']; ?> </p>
      </div>
      <div class="content-body risk">
        <p class="advice"><?php echo $cvdScore['conclude']; ?> <br>
        <b>คำแนะนำ</b></br></p>
        <p><?php echo html_entity_decode($cvdScore['advice']); ?></p>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <p class="text-cvd">CVD risk</p>
      </div>
      <div class="content-body">
        <canvas id="chart-cvd"></canvas>
      </div>
    </div>

    <?php
      $sql="select * from waist";
      $result = $conn -> prepare($sql);
      $result -> execute();
      $rowsWaist = $result -> fetchAll(PDO::FETCH_ASSOC);
      $thisWaistKey=0;
      foreach ($rowsWaist as $key => $value) {
        $ex1='$ex3='.$now_row['waist'].$value['sex'.$now_row['sexId'].'max'].";";
        eval($ex1);
        if ($ex3){
          $thisWaistKey=$key;
          break;
        }
      }
    ?>

    <div class="content">
      <div class="content-title">
        <p><b>รอบเอวของคุณอยู่ในเกณฑ์ <?php echo $rowsWaist[$thisWaistKey]['waistName']; ?>
        </b><br>(<?php echo $rowsWaist[$thisWaistKey]['waistDetail']; ?>)</p>
      </div>
      <div class="content-body waist">
        <p class="advice"><?php echo html_entity_decode($rowsWaist[$thisWaistKey]['waistAdvice']); ?></p>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <p>รอบเอว</p>
      </div>
      <div class="content-body">
        <canvas id="chart-waist"></canvas>
      </div>
    </div>

    <?php
      $sql = "select * from bloodPressure where ".$now_row['bpUpper']." >=sbp or ".$now_row['bpLower']." >=dbp order by sbp desc limit 1";
      $result = $conn -> prepare($sql);
      $result -> execute();
      $rowBloodPressure = $result -> fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="content">
      <div class="content-title">
        <p><?php echo $rowBloodPressure['bloodPressureName']; ?></p>
      </div>
      <div class="content-body high-pressure-normal">
        <p class="advice"><?php echo $rowBloodPressure['conclude']; ?></p>
        <p><?php echo html_entity_decode($rowBloodPressure['advice']); ?></p>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <p>ความดันโลหิต</p>
      </div>
      <div class="content-body">
        <canvas id="chart-bp"></canvas>
      </div>
    </div>

    <?php
      $sql = "SELECT * FROM `bloodSugar` WHERE ".$now_row['bloodSugar']." >= fbs ORDER BY fbs DESC LIMIT 1";
      $result = $conn -> prepare($sql);
      $result -> execute();
      $rowBloodSugar = $result -> fetch(PDO::FETCH_ASSOC);
      // print_r($rowBloodSugar);
    ?>

    <div class="content">
      <div class="content-title">
        <p><b><?php echo $rowBloodSugar['bloodSugarName']; ?></b>
        <br>(<?php echo $rowBloodSugar['bloodSugarDetail']; ?>)</p>
      </div>
      <div class="content-body waist">
        <p class="advice"><?php echo $rowBloodSugar['conclude']; ?><br><b>คำแนะนำ</b></p>
        <p><?php echo html_entity_decode($rowBloodSugar['advice']); ?></p>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <p>น้ำตาลในเลือด</p>
      </div>
      <div class="content-body">
        <canvas id="chart-blood-sugar"></canvas>
      </div>
    </div>

    <?php
      $sqlSmoke = "SELECT * FROM smoke WHERE ".$now_row['smokeId']." = smokeId";
      $result = $conn -> prepare($sqlSmoke);
      $result -> execute();
      $rowSmoke = $result -> fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="content">
      <div class="content-title">
        <p><?php echo $rowSmoke['smokeName']; ?></p>
      </div>
      <div class="content-body waist">
        <p class="advice"><?php echo $rowSmoke['conclude']; ?></p>
        <p><?php echo html_entity_decode($rowSmoke['advice']); ?></p>
      </div>
    </div>

    <?php
      $sqlAlcohol = "SELECT * FROM alcohol WHERE ".$now_row['alcoholId']." = alcoholId";
      $result = $conn -> prepare($sqlAlcohol);
      $result -> execute();
      $rowAlcohol = $result -> fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="content">
      <div class="content-title">
        <p><?php echo $rowAlcohol['alcoholName']; ?></p>
      </div>
      <div class="content-body waist">
      <p class="advice"><?php echo $rowAlcohol['conclude']; ?></p>
        <p><?php echo html_entity_decode($rowAlcohol['advice']); ?></p>
      </div>
    </div>

    <div class="content">
      <div class="content-title">
        <p>chart-risk</p>
      </div>
      <div class="content-body">
        <canvas id="chart-risk"></canvas>
      </div>
    </div>
    

  </div>

  <div class="button d-flex justify-content-center">
    <button type="button" onclick="window.location.href='../main/historyHealth.php'">ดูประวัติการบันทึกสุขภาพ</button>
    <button type="button" onclick="window.location.href='../main/index.php'">ปิด</button>
  
  </div>
</div>

  <script>


    let chartBmiElem = document.getElementById('chart-bmi').getContext('2d');
    let chartBmi = new Chart(chartBmiElem,{
      type:"line",
      data:{
        labels:[
          <?php echo $str_history_label; ?>
        ],
        datasets:[
          {
            label:"BMI",
            data:[
              <?php echo $str_history_bmi_data; ?>
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
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true,
              max: 40,
              min: 0,
              stepSize: 5
            }
          }]
        }
      }
    });


    let chartWeightElem = document.getElementById('chart-weight').getContext('2d');
    let chartWeight = new Chart(chartWeightElem, {
        type: "line",
        data: {
            labels: [
              <?php echo $str_history_label; ?>
            ],
            datasets: [{
                label: 'น้ำหนัก',
                data: [
                  <?php echo $str_history_weight_data; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          legend:{
            display:false
          },
          scales:{
            yAxes:[{
              ticks:{
                beginAtZero:true,
                max: 200,
                min: 0,
                stepSize: 5
              }
            }]
          }
        }
    });

    let chartCvdElem = document.getElementById('chart-cvd').getContext('2d');
    let chartCvd = new Chart(chartCvdElem,{
      type:"line",
      data:{
        labels:[
          <?php echo $str_history_label; ?>
        ],
        datasets:[
          {
            label:"ค่า CVD",
            data:[
              <?php echo $str_history_cvd_score_data; ?>
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
            borderWidth:8,
          }
        ]
      },
      options:{
        legend:{display:false},
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true,
              max: 100,
              min: 0,
              stepSize: 5
            }
          }]
        }
      }
    });


    let chartWaistElem = document.getElementById('chart-waist').getContext('2d');
    let chartWaist = new Chart(chartWaistElem,{
      type:"line",
      data:{
        labels:[
          <?php echo $str_history_label; ?>
        ],
        datasets:[
          {
            label:"Waist",
            data:[
              <?php echo $str_history_waist_data; ?>
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
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true,
              max: 150,
              min: 0,
              stepSize: 10
            }
          }]
        }
      }
    });


    let chartBpElem = document.getElementById('chart-bp').getContext('2d');
    let chartBp = new Chart(chartBpElem,{
      type:"line",
      data:{
        labels:[
          <?php echo $str_history_label; ?>
        ],
        datasets: [{
            label: "bpUpper",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(225,0,0,0.4)",
            borderColor: "red", // The main line color
            borderCapStyle: 'square',
            borderDash: [], // try [5, 15] for instance
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "black",
            pointBackgroundColor: "white",
            pointBorderWidth: 1,
            pointHoverRadius: 8,
            pointHoverBackgroundColor: "yellow",
            pointHoverBorderColor: "brown",
            pointHoverBorderWidth: 2,
            pointRadius: 4,
            pointHitRadius: 10,
            // notice the gap in the data and the spanGaps: true
            data: [<?php echo $str_history_bpUpper_data; ?>],
            spanGaps: true,
          }, {
            label: "bpLower",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(167,105,0,0.4)",
            borderColor: "blue",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "white",
            pointBackgroundColor: "black",
            pointBorderWidth: 1,
            pointHoverRadius: 8,
            pointHoverBackgroundColor: "brown",
            pointHoverBorderColor: "yellow",
            pointHoverBorderWidth: 2,
            pointRadius: 4,
            pointHitRadius: 10,
            // notice the gap in the data and the spanGaps: false
            data: [<?php echo $str_history_bpLower_data; ?>],
            spanGaps: false,
          }
        ]
      },
      options:{
        legend:{display:false},
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true,
              max: 220,
              min: 0,
              stepSize: 10
            }
          }]
        }
      }
    });


    let chartBloodsugarElem = document.getElementById('chart-blood-sugar').getContext('2d');
    let chartBloodsugar = new Chart(chartBloodsugarElem,{
      type:"line",
      data:{
        labels:[
          <?php echo $str_history_label; ?>
        ],
        datasets:[
          {
            label:"Bloodsugar",
            data:[
              <?php echo $str_history_bloodsugar_data; ?>
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
        scales:{
          yAxes:[{
            ticks:{
              beginAtZero:true,
              max: 150,
              min: 0,
              stepSize: 10
            }
          }]
        }
      }
    });


    let chartRiskElem = document.getElementById('chart-risk').getContext('2d');
        let chartRisk = new Chart(chartRiskElem,{
          type:"bar",
          data:{
            labels:[
              <?php echo $str_cvd_level_label; ?>
            ],

           datasets:[
              {
                label:"Risk",
                data:[
                  <?php echo $str_cvd_level_data; ?>
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
            legend:{ display: false },
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
                  beginAtZero: true,
                  max: <?php echo $maxCountAll+(10*$maxCountAll/100); ?>,
                  min: 0,
                  stepSize: <?php echo $maxCountAll/10; ?>
                }
              }],
            }
          }
        });

  </script>
  </body>
</html>


<?php 
function arraySearch2D($array,$findKey,$findValue){
  $_return=0;
  foreach ($array as $key => $value) {
    if ($value[$findKey]==$findValue){
      $_return=$key+1;
      break;
    }
  }
  return $_return;
}


?>
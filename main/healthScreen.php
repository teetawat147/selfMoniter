<?php
  include('../include/connection.php');
  include('../include/function.php');
if (!$_SESSION['fname']){
  header("Location: ../main/login.php");
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
  WHERE h.helpRecordId = '".$_GET['helpRecordId']."' 
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
    h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) AS bmi,b.nameBmi, 
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
  where h.personId=".$_SESSION['personId']."
  ORDER BY h.inputDatetime";
// echo "<br>sqlBmi=".$sqlBmi;
  $resultBmi = $conn -> prepare($sqlBmi);
  $resultBmi -> execute();
  $history_rows = $resultBmi -> fetchAll(PDO::FETCH_ASSOC);
// echo "<br>history_rows=";
// print_r($history_rows);

$sql="select * from bmi where id=2";
$result = $conn -> prepare($sql);
$result -> execute();
$rowNormalBmi = $result -> fetch(PDO::FETCH_ASSOC);

// echo "<br>rowNormalBmi=";
// print_r($rowNormalBmi);

$sql="
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
h.helpRecordId in (select max(helpRecordId)as max_helpRecordId from health_data_record group by personId) and
p.personId
GROUP BY 
cvd_level";
$result = $conn -> prepare($sql);
$result -> execute();
$rows_cvd_level = $result -> fetchAll(PDO::FETCH_ASSOC);
// print_r($rows_cvd_level);


$maxCountAll=0;
$cvd_level_label=array();
$cvd_level_data=array();
for ($i=1; $i <=10 ; $i++) { 
  $key = arraySearch2D($rows_cvd_level,'cvd_level',$i);
  if($key>0){
    array_push($cvd_level_label,"'".$rows_cvd_level[$key-1]['cvd_level']."'");
    array_push($cvd_level_data,$rows_cvd_level[$key-1]['countAll']);
    $maxCountAll=($maxCountAll<$rows_cvd_level[$key-1]['countAll'])?$rows_cvd_level[$key]['countAll']:$maxCountAll;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

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
        line-height: 16px;
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

  <main role="main" style="margin-top:90px;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
            <p id="p2"><b>คำแนะนำเบื้องต้น</b> <br> <?php echo $now_row['advice'] ?></p>
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

        <div class="content">
          <div class="content-title">
            <p>ความเสี่ยงต่อโรคหัวใจใน 10 ปี = เสี่ยงต่ำ</p>
          </div>
          <div class="content-body risk">
            <p class="advice"><b>เยี่ยมมาก!!</b> ความเสี่ยงต่อโรคหัวใจของคุณอยู่ในระดับต่ำที่สุด <br><b>คำแนะนำ</b></br></p>
            <p>1. บริโภคอาหารรลดหวาน มัน เค็ม เพิ่มผักและผลไม้</p>
            <p>2. ออกกำลังกาย การเคลื่อนไหวร่างกาย ระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที ต่อวัน สัปดาห์ละ 5 วัน ในการเคลื่อนไหวในชีวิตประจำวัน เวลาว่าง และการทำงาน</p>
            <p>3. น้ำหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 - 22.9 กก./ม หรือใกล้เคียง รอบเอว ผู้หญิงไม้เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.</p>
            <p>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบและไม่สูดคมควันบุหรี่</p>
            <p>5. หยุดดื่่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนำให้ลดการดื่มลง (ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน ผู้หญิง น้อยกว่าเท่ากับ 1 หน่วยมาตรฐาน)</p>
            <p>6. ความคุมความดันโลหิตน้อยกว่า 140/90 มม.ปรอท</p>
            <p>7. ติดตามทุก 6 เดือน</p>
            <p>8. ติดตามประเมินซ้ำภายใน 1 ปี</p>
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


        <div class="content">
          <div class="content-title">
            <p><b>รอบเอวของคุณอยู่ในเกณฑ์
            <?php 
              echo ($now_row['waist']<=80)?" ปกติ":" เกินค่าปกติ";
            ?>
            </b> <br>(ชายไม่เกิน 90 ซม., หญิงไม่เกิน 80 ซม.)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!!</b> รอบเอวของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. การรับประทานอาหารที่ดีต่อสุขภาพและออกกำลังกายอย่างสม่ำเสมอ</p>
            <p>2. วัดรอบเอวด้วยตนเองทุก 2 - 3 เดือน</p>
            <p>3. ปรับเปลี่ยนพฤติกรรม 3อ.2ส</p>
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

        <div class="content">
          <div class="content-title">
            <p>ความดันโลหิตปกติ</p>
          </div>
          <div class="content-body high-pressure-normal">
            <p class="advice"><b>เยี่ยมมาก!!</b> ความดันโลหิตของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. ควบคุมอาหาร</p>
            <p>2. ออกกำลังกาย</p>
            <p>3. วัดความดันโลหิตอย่างสม่ำเสมอ</p>
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

        <div class="content">
          <div class="content-title">
            <p><b>น้ำตาลในเลือดปกติ</b> <br>(มีน้ำตาลในเลือดน้อยกว่า 100 มก.ดล.)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!!</b> น้ำตาลในเลือดของคุณอยู่ในเกณฑ์ปกติ <br><b>คำแนะนำ</b></p>
            <p>1. ควบคุมอาหาร ออกกำลังกายอย่างสม่ำเสมอ</p>
            <p>2. ควบคุมน้ำหนักตัวให้อยู่ในเกณฑ์ที่เหมาะสม</p>
            <p>3. ควรประเมินความเสี่ยงซ้ำทุก 1-2 ปี</p>
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

        <div class="content">
          <div class="content-title">
            <p>ไม่สูบบุหรี่</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>เยี่ยมมาก!! ดูแลตนเองให้ห่างจากพิษภัยของบุหรี่ต่อไปนะ..</b></p>
          </div>
        </div>

        <div class="content">
          <div class="content-title">
            <p>ดื่มสุราบางโอกาส (1-2ครั้ง/สัปดาห์)</p>
          </div>
          <div class="content-body waist">
            <p class="advice"><b>คำแนะนำ</b></p>
            <p>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดน อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน</p>
            <p>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก</p>
            <p>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์</p>
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
                label:"BMI",
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
                borderWidth:1
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
                  stepSize: <?php echo $maxCountAll/10; ?>
                }
              }],

              
            }
          }
        });




        
        
       


      function chartTestBar() {
        let options = {
          series: [{
          name: 'BMI',
          data: [31, 40, 28, 51, 42, 109, 100]
          // data: [<?php echo $str_history_bmi_data; ?>]
        }],
          chart: {
          height: 400,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ['ม.ค.','มี.ค.','พ.ค.','ก.ค.','ก.ย.','พ.ค.']
        },
        yaxis: {
          tickAmount: 7,
          min: 0,
          max: 140
        }
      };

        let chart = new ApexCharts(document.getElementById('chart-line-test'), options);
        chart.render();
      }

      function chartTestLine(typeChart, nameChart, categories, tickAmount, minValue, maxValue) {
        let options = {
          chart: {
            type: typeChart
          },
          series: [{
            name: nameChart,
            data: [5, 10, 2, 15, 12, 10]
          }],
          xaxis: {
            categories: categories
          }, 
          yaxis: {
            tickAmount: tickAmount,
            min: minValue,
            max: maxValue
          },
          // colors: ['#008FFB']
        }

        let chart = new ApexCharts(document.getElementById('chart-bar-test'), options);
        chart.render();
      }

      function chartTestPie() {
        let options = {
          series: [100, 55, 13, 43, 22], // data
          chart: {
            width: 500,
            type: 'pie',
        },
        labels: ['BMI1', 'BMI2', 'BMI3', 'BMI4', 'BMI5'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        let chart = new ApexCharts(document.getElementById('chart-pie-test'), options);
        chart.render();
      }


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
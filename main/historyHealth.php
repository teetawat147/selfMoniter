<?php
  include('../include/connection.php');
  include('../include/function.php');
if (!$_SESSION['fname']){
  header("Location: ../main/login.php");
}
  if (!(isset($_GET['helpRecordId']))){
    $sql="select * from health_data_record h where h.personId=".$_SESSION['personId']."ORDER BY helpRecordId DESC LIMIT 1";
    $result = $conn -> prepare($sql);
    $result -> execute();
    $myRecords = $result -> fetchAll(PDO::FETCH_ASSOC);
    $helpRecordId=$myRecords[0]['helpRecordId'];
  }else{
    $helpRecordId=$_GET['helpRecordId'];
  }


  $sql = "SELECT p.personId,
                p.sexId,
                h.*,
                h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) AS bmi,
                b.*, 
                d.diabetesName,
                s.smokeName,
                a.alcoholName,
                bd.bloodName,
            (1-power(0.978296,exp(((0.079*(YEAR(curdate())-YEAR(p.birthdate)-(DATE_FORMAT(curdate(), '%m%d') < DATE_FORMAT(p.birthdate, '%m%d'))))+(0.128*p.sexId)+(0.019350987*h.bpUpper)+(0.58454*h.diabetesId)+(3.512566*((h.waist)/h.healthHeight))+(0.459*h.smokeId))-7.720484)))*100 as cvd_score
        FROM health_data_record h
        LEFT JOIN person p ON h.personId=p.personId
        LEFT JOIN diabetes d ON h.diabetesId=d.diabetesId
        LEFT JOIN smoke s ON h.smokeId=s.smokeId
        LEFT JOIN blood bd ON h.bloodId=bd.bloodId
        LEFT JOIN alcohol a ON h.alcoholId=a.alcoholId
        LEFT JOIN bmi b ON h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) >= IF(p.sexId = 1,b.sex1min,b.sex2min)
        AND h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) < IF(p.sexId = 1,b.sex1max,b.sex2max)
        WHERE h.personId='".$_SESSION['personId']."'
        ORDER BY h.inputDatetime";

        $result = $conn -> prepare($sql);
        $result -> execute();
        $rows = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ผลการคัดกรองด้วยตนเอง</title>
    
    <style>

        thead tr th {
            position: sticky;
            top: 0;
            background: whitesmoke !important;
            z-index: 5;
        }

        button:hover {
            background-color: #e5e5e5;
            color: #000;
            border: 1px solid #000;
            transform: scale(1.05);
        }

        thead tr th:nth-child(1) {
                position: sticky;
                left: 0;
                background: #fff;
                z-index: 6;
                text-align: center;
            }

            tbody tr th:nth-child(1) {
                position: sticky;
                left: 0;
                background: #fff;
                z-index: 3;
            }

        @media only screen and (max-width: 768px) {
            .table {
                width: 120%;
            }

            thead tr th {
                position: sticky;
                top: 0;
                background: whitesmoke;
                z-index: 5;
            }

            thead tr th:nth-child(1) {
                position: sticky;
                left: 0;
                background: #fff;
                z-index: 6;
                text-align: center;
            }

            tbody tr th:nth-child(1) {
                position: sticky;
                left: 0;
                background: #fff;
                z-index: 3;
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

    <div class="container" style="margin-top: 30px;">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="title-month" scope="col">หัวข้อ/เดือน</th>
                        <?php
                            foreach ($rows as $key => $row) {
                            ?>
                                <th scope="col"><?php echo dateThai($row['inputDatetime']); ?></th>
                            <?php
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">โรคเบาหวาน</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                                
                        ?>
                            <td><?php echo $row['diabetesName']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">โรคความดัน</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['bloodName']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">ส่วนสูง</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['healthHeight']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">น้ำหนัก</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['healthWeight']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">รอบเอว</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['waist']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">ความดันโลหิต (ค่าบน) </th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['bpUpper']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">ความดันโลหิต (ความดันค่าล่าง)</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['bpLower']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">น้ำตาลในเลือด</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['bloodSugar']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">BMI</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['nameBmi']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>

                    <tr>
                        <th scope="row">สูบบุหรี่</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['smokeName']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>
                    
                    <tr>
                        <th scope="row">ดื่มสุรา</th>
                        <?php
                        // print_r($rows);
                            foreach($rows as $key => $row) {
                        ?>
                            <td><?php echo $row['alcoholName']; ?></td>
                        <?php
                            }
                        ?>
                    </tr>
                </tbody>

                <!-- cvd_score -->
                
            </table>
        </div>
        
        <div class="text-center">
                <button type="button" class="btn btn-secondary" onclick="history.go(-1);">ปิด</button>
        </div>
    </div>
  </body>
</html>
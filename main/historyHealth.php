<?php
  include('../include/connection.php');
  include('../include/function.php');
if (!$_SESSION['fname']){
  header("Location: ../main/login.php");
}
  if (!(isset($_GET['helpRecordId']))){
    // $sql="select * from health_data_record h where h.personId=".$_SESSION['personId']."ORDER BY helpRecordId DESC LIMIT 1";
    $sql="select * from health_data_record h where h.personId='".$_SESSION['personId']."'";
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
         LEFT JOIN cvdScore c ON (1-power(0.978296,exp(((0.079*(YEAR(curdate())-YEAR(p.birthdate)-(DATE_FORMAT(curdate(), '%m%d') < DATE_FORMAT(p.birthdate, '%m%d'))))+(0.128*p.sexId)+(0.019350987*h.bpUpper)+(0.58454*h.diabetesId)+(3.512566*((h.waist)/h.healthHeight))+(0.459*h.smokeId))-7.720484)))*100
         LEFT JOIN bmi b ON h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) >= IF(p.sexId = 1,b.sex1min,b.sex2min)
         AND h.healthWeight/((h.healthHeight/100)*(h.healthHeight/100)) < IF(p.sexId = 1,b.sex1max,b.sex2max)
         WHERE h.personId=1
         ORDER BY h.inputDatetime";

        $result = $conn -> prepare($sql);
        $result -> execute();
        $rows = $result -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการบันทึกสุขภาพ</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

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

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <?php
      include "./header.php";
  ?>

<div class="container" style="margin-top: 30px;">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="title-month" scope="col">หัวข้อ/เดือน</th>
                    <th scope="col">ม.ค.</th>
                    <th scope="col">ก.พ.</th>
                    <th scope="col">มี.ค.</th>
                    <th scope="col">เม.ย.</th>
                    <th scope="col">พ.ค.</th>
                    <th scope="col">มิ.ย.</th>
                    <th scope="col">ก.ค.</th>
                    <th scope="col">ส.ค.</th>
                    <th scope="col">ก.ย.</th>
                    <th scope="col">ต.ค.</th>
                    <th scope="col">พ.ย.</th>
                    <th scope="col">ธ.ค.</th>
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
            <button type="button" class="btn btn-secondary">ปิด</button>
    </div>
</div>

</body>
</html>
<?php
    include('../include/connection.php');
    
    try {
        $sql = "SELECT * FROM health_data_record";
        $result = $conn -> prepare($sql);
        $result -> execute();
        $rows = $result -> fetchAll(PDO:: FETCH_ASSOC);
    }
    catch(PDOException $e) {
        die("Could not connect to database $db_name : " .$e -> getMessage());
    }
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
                <?php
                // print_r($rows);
                    foreach($rows as $key => $row) {
                ?>
                <tr>
                    <th scope="row">โรคเบาหวาน</th>
                    <td><?php echo $row['diabetesId'] ?></td>
                </tr>
                <tr>
                    <th scope="row">โรคความดัน</th>
                    <td><?php echo $row['bloodId'] ?></td>
                </tr>
                <tr>
                    <th scope="row">ส่วนสูง</th>
                    <td><?php echo $row['healthHeight'] ?></td>
                </tr>
                <tr>
                    <th scope="row">น้ำหนัก</th>
                    <td><?php echo $row['healthWeight'] ?></td>
                </tr>
                <tr>
                    <th scope="row">รอบเอว</th>
                    <td><?php echo $row['waist'] ?></td>
                </tr>
                <tr>
                    <th scope="row">ความดันโลหิต (ค่าบน) </th>
                    <td><?php echo $row['bpUpper'] ?></td>
                </tr>
                <tr>
                    <th scope="row">ความดันโลหิต (ความดันค่าล่าง)</th>
                    <td><?php echo $row['bpLower'] ?></td>
                </tr>
                <tr>
                    <th scope="row">น้ำตาลในเลือด</th>
                    <td><?php echo $row['bloodSugar'] ?></td>
                </tr>
                <tr>
                    <th scope="row">สูบบุหรี่</th>
                    <td><?php echo $row['smokeId'] ?></td>
                </tr>
                <tr>
                    <th scope="row">ดื่มสุรา</th>
                    <td><?php echo $row['alcoholId'] ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="text-center">
            <button type="button" class="btn btn-secondary">ปิด</button>
    </div>
</div>

</body>
</html>
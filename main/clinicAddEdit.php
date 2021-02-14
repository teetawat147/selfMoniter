<?php 
    include('../include/connection.php');

    if($_SESSION['fname']) {
        header("location: ../main/login.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>บริการข้อมูลงานสถานพยาบาล</title>

    <style>

      .title {
        width: 45ch;
        height: 40px;
        text-align: center;
        border-radius: 20px;
        background-color: rgb(255,153,0);
      }

      span {
        padding: 0 10px;
        height: 40px;
        background-color: #FF9FE4;
        width: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        word-wrap: break-word;
        font-weight: 600;
      }

      @media screen and (max-width: 600px) {
        .wrapper-content {
          font-size: 16px;
        }
        
        .title {
          width: 30ch;
          height: 30px;
          text-align: center;
          border-radius: 20px;
          background-color: rgb(255,153,0);
        }

        h3 {
          font-size: 18px;
        }
      }

    </style>

  </head>
  <body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <?php 
      include("../main/header.php");
    ?>

    <div class="container mt-3 border border-dark wrapper-content">
      <center>
        <div class="title m-3">
          <h3>บริการข้อมูลงานสถานพยาบาล</h3>
        </div>
      </center>

      <div class="form-row d-flex justify-content-center wrapper-search">
        <input type="text" class="form-control col-md-11 mr-4 w-50" id="input-search" name="input-search">
        <input type="button" class="btn btn-secondary" id="btn-search" value="ค้นหา">
      </div>

      <div class="form-row mt-3 d-flex justify-content-center">
        <span class="mb-3">กฏหมายกรมสนับสนุนบริการสุขภาพ</span>
      </div>

      <center><button type="button" class="btn btn-warning mt-5 mb-3">ย้อนกลับ</button></center>
    </div>

  </body>
</html>
<?php 
    include('../include/connection.php');

    if(!$_SESSION['fname']) {
        header('location: ../main/login.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ยืนยันจำนวนเจ้าหน้าที่</title>

    <style>
    </style>
    
  </head>
  <body>
  <!-- <button class="btn btn-danger" data-href="../main/waistDelete.php?waistId=<?php echo $rowWaist['waistId']; ?>" data-toggle="modal" data-target="#confirm-delete"> -->
  <button data-toggle="modal" data-target="#confirm-number-emp">Modal</button>
    <div class="container">
        <div class="modal fade" id="confirm-number-emp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                    <h4 class="modal-title w-100 text-center">ยืนยันจำนวนเจ้าหน้าที่</h4>
                    <button type="button" id="close-modal" class="close" data-dismiss="modal" aria-label="close"><i class="fas fa-window-close"></i></button>
                    </div>
                
                    <div class="modal-body text-center">
                        <form class="form-insertPerson" action="popupPersonInsert.php" method="POST">
                            <div class="div-count_person">
                                <label for="count_person">จำนวนเจ้าหน้าที่ในสถานบริการ &nbsp</label>
                                <input type="number" id="count_person" name="count_person">&nbsp&nbsp คน
                            </div>
                        </form>
                    </div>
                    
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success btn-confirm-count_person">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#confirm-number-emp').on('show.bs.modal', function(event) {
            $(this).find('.btn-confirm-count_person').attr('href', $(event.relatedTarget).data('href'));
        });
    </script>










    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
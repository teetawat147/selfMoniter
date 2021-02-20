<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<?php 
    include('../include/connection.php');

    if (md5($_POST['oldPassword']) != $_POST['password']) {
        ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
                        <button type="button" class="close" aria-label="Close" onclick="history.go(-1);">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        รหัสผ่าน!!!ของท่านไม่ถูกต้อง
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.go(-1);">ปิด</button>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }
    else if ($_POST['confirmPassword'] != $_POST['newPassword']) {
    ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
                    <button type="button" class="close" aria-label="Close" onclick="history.go(-1);">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    รหัสผ่าน!!!ของท่านไม่ตรงกัน
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="history.go(-1);">ปิด</button>
                </div>
                </div>
            </div>
        </div>
    <?php
    }
    else {

        $sql = "UPDATE person SET password = MD5('".$_POST['newPassword']."') WHERE personId = ".$_SESSION['personId'];
        $result = $conn -> prepare($sql);
        $result -> execute();

        if ($result) {
        ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
                        <button type="button" class="close" aria-label="Close" onclick="history.go(-1);">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        แก้ไขรหัสผ่านสำเร็จ
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="history.go(-2);">ตกลง</button>
                    </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    
?>


<script type="text/javascript">
    $('#exampleModal').modal({
        show: true
    })
</script>
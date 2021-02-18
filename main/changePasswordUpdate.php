<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php 
    include('../include/connection.php');

    if (md5($_POST['oldPassword']) != $_POST['password']) {
        ?>
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center bg-danger text-white mt-5 rounded" style="height: 300px; width: 500px; margin-left: 425px;">
                <div class="toast w-50" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">แจ้งเตือน</strong>
                    </div>
                    <div class="toast-body">
                        รหัสผ่าน!!!ของท่านไม่ถูกต้อง
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function(){
                    history.go(-1);
                },3000);
            </script>
        <?php
    }
    else if ($_POST['confirmPassword'] != $_POST['newPassword']) {
    ?>
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center bg-danger text-white mt-5 rounded" style="height: 300px; width: 500px; margin-left: 425px;">
                <div class="toast w-50" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">แจ้งเตือน</strong>
                    </div>
                    <div class="toast-body">
                        รหัสผ่าน!!!ของท่านไม่ตรงกัน
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function(){
                    history.go(-1);
                },3000);
            </script>
    <?php
    }
    else {

        $sql = "UPDATE person SET password = MD5('".$_POST['newPassword']."') WHERE personId = ".$_SESSION['personId'];
        $result = $conn -> prepare($sql);
        $result -> execute();

        if ($result) {
        ?>
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center bg-danger text-white mt-5 rounded" style="height: 300px; width: 500px; margin-left: 425px;">
                <div class="toast w-50" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">แจ้งเตือน</strong>
                    </div>
                    <div class="toast-body">
                        แก้ไขรหัสผ่านสำเร็จ
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function(){
                    history.go(-2);
                },1500);
            </script>
        <?php
        }
    }
    
?>
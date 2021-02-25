<?php
include("../include/connection.php");

$sql ="select * from office WHERE office_id = '".$_GET['office_id']."' ";
$result = $conn->prepare($sql);
$result->execute();
$rowEdit = $result->fetch();
// echo "rowEdit<br>";
// print_r($rowEdit);
?>
<!doctype html>
<html lang="en">
<head>
    <title>แก้ไขข้อมูลหน่วยงาน</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <!-- <script src="../js/tableToCards.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script> -->

</head>
<body>
    <?php
        include "./header.php";
    ?>

<fieldset id="personUpdate" style="display:block;">
        <div class = "container">
            <center><h3>แก้ไขข้อมูลหน่วยงาน</h3></center><br>
            <form action="officeGetUpdateSave.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="office_name">ชื่อหน่วยงาน</label>
                        <input name="office_name" id="office_name" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกชื่อหน่วยงาน" placeholder="ชื่อหน่วยงาน" value="<?php echo $rowEdit['office_name']; ?>">
                    </div>  
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="office_code">รหัสหน่วยงาน</label>
                        <input name="office_code" id="office_code" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอกรหัสหน่วยงาน" placeholder="รหัสหน่วยงาน" value="<?php echo $rowEdit['office_code']; ?>">
                    </div>  
                
                    <div  class="form-group col-md-6">
                        <label for="office_type">ประเภทหน่วยงาน</label>
                        <select name='office_type' id='office_type' class='form-control' required data-error-msg="กรุณาเลือกประเภทหน่วยงาน" >
                            <?php 
                            $sql ="select * from office_type";
                            $result = $conn->prepare($sql);
                            $result->execute();
                            while($row = $result->fetch()) {
                                ?>
                                <option value="<?php echo $row['hostypecode'];?>"><?php echo $row['hostypename'];?></option>
                                <?php   
                            }
                            ?>
                        </select>
                    </div>
                </div>

                    <div class="form-row">
                        <div   div class="form-group col-md-6">
                            <label for="provinceCode">จังหวัด</label>
                            <select name='provinceCode' id='provinceCode' class='form-control' required data-error-msg="กรุณาเลือกชื่อจังหวัด" >
                                <option selected disabled>Choose...</option>
                                <?php
                                    $sql ="select * from changwat order by changwat_name";
                                    $result = $conn->prepare($sql);
                                    $result->execute();
                                    while($row = $result->fetch()) { 
                                        ?>
                                        <option value="<?php echo $row['changwat_code'];?>" <?php echo ($rowEdit['changwat_code']==$row['changwat_code'])?"selected":"";?>><?php echo $row['changwat_name'];?></option>
                                        <?php   
                                    }
                                ?>
                            </select>
                        </div>

                        <div id="div-districtCode" class="form-group col-md-6">
                            <label for="districtCode">อำเภอ</label>
                            <select name='districtCode' id='districtCode' class='form-control' required data-error-msg="กรุณาเลือกชื่ออำเภอ" >
                                <option selected disabled>Choose...</option>
                            </select>              
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="count_person">จำนวนเจ้าหน้าที่</label>
                            <input name="count_person" id="count_person" class="form-control" min="3" required type="text" data-error-msg="กรุณากรอก จำนวนพนักงาน" groupName="count_person" value="<?php echo $rowEdit['count_person']; ?>">
                        </div>
                    </div>    

                    <center>
                        <input type="hidden" name="office_id" id="office_id" value="<?php echo $rowEdit['office_id']; ?>">
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                        <button type="button" class="btn btn-primary">ยกเลิก</button>
                    </center>
            </form>
        </div>
    </fieldset>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src ="https://www.jquery-az.com/boots/js/validate-bootstrap/validate-bootstrap.jquery.min.js" ></script>

    <script>
        function getAmpur(provinceCode, districtCode) {
            $.ajax({
                    method: "POST",
                    url: "getAmpur.php",
                    data: { provinceCode: provinceCode ,districtCode: districtCode }
                }).done(function(msg) {
                    $("#div-districtCode").html(msg);
                    let tambonmsg= '<label for="subdistrictCode">ตำบล</label>';
                        tambonmsg+='<select name="subdistrictCode" id="subdistrictCode" class="form-control" required data-error-msg="กรุณากรอกชื่อตำบล">';
                        tambonmsg+='<option selected disabled>Choose...</option>';
                        tambonmsg+='</select>';            
                    $("#div-subdistrictCode").html(tambonmsg);                   
                });
        }

        $(function(){

            $("#provinceCode").val("<?php echo $rowEdit['changwat_code'];?>");
            getAmpur($("#provinceCode").val(),"<?php echo $rowEdit['ampur_code'];?>");

            $("#provinceCode").change(function() {
                let provinceCode = $(this).val();
                // alert(provinceCode);
                getAmpur(provinceCode);
            })
        });
    </script>
  </body>
</html>

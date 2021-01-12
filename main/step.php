<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="../css/sty.css">

<body>

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <!-- <h2 style="text-align: center;">Self-Moniter</h2> -->
                <form id="msform">
                    <!-- progressbar -->
                    
                    <ul id="progressbar">
                        <li class="active">ลงทะเบียน</li>
                        <li >ข้อตกลงการใช้งาน</li>
                    </ul>

                    
                    <!-- <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>  -->
                    
                    <br> <!-- fieldsets -->

                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">ลงทะเบียน</h2>
                                </div>
                            </div> 
                            
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">เลขบัตรประจำตัวประชาชน</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="เลขบัตรประจำตัวประชาชน">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ชื่อ</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="ชื่อ">
                            </div>
        
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">นามสกุล</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="นามสกุล">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">เบอร์โทรศัพท์</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="เบอร์โทรศัพท์">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ที่อยู่</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="ที่อยู่">
                            </div>
        
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">จังหวัด</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="จังหวัด">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">อำเภอ</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="อำเภอ">
                            </div>
        
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">ตำบล</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="ตำบล">
                            </div>
                        </div>

                        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="department">ชื่อแผนก</label>
                <select id="department" class="form-control">
                <option selected>Choose...</option>
                <option>แผนก A</option>
                <option>แผนก B</option>
                </select>
            </div>
        </div>

                        <div class="form-row">   
                            <div class="form-group col-md-12">
                                <label for="inputState">ชื่อแผนก</label>
                                <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>แผนก A</option>
                                <option>แผนก B</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">น้ำหนัก</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="น้ำหนัก">
                            </div>
        
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">ส่วนสูง</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="ส่วนสูง">
                            </div>
                        </div>

                     <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>

                    <fieldset>
                        <div class="form-card">
                         <center>
                            <h1 class="title">ข้อตกลงการใช้งาน</h1>
                         </center>
                         <form method="POST">
                           <label class="label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    1.ข้อมูลภายใน Web Application นี้ และ
                                    ประชาชนหรือผู้ป่วยที่ปรากฏชื่อภายใน 
                                    Web Application ซึ่งถือว่าเป็นเจ้าของข้อมูล ได้รับความคุ้มครองตาม 
                                    'พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. ๒๕๖๒' 
                                    </label>
                                    <br>
                                    
                                    <label class="label">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    2.ผู้ใช้งาน Web Application ทุกระดับ และผู้ดูแลระบบทุกระดับ
                                    ที่กระทำการเปิดเผยข้อมูลอันปรากฎภายใน Web Application หรือกระทำการอื่นใด
                                    อันเป็นการฝ่าฝืน'พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ.๒๕๖๒'
                                    ต้องระวางโทษหรือปรับตามมาตราที่กระทำผิด
                                    
                                    <br>
                                    
                            </label>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" /> 
                    </fieldset>  
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
</script>
<?php
if (!isset($_SESSION)) {
  session_start();
}
//print_r($_POST);

//print_r($_SESSION);
$a_params = explode("&", $_POST['params']);
foreach ($a_params as $k => $v) {
    $a_v = explode("=", $v);
    $_POST[$a_v[0]] = $a_v[1];
}
if ($_POST['line_id']){
	$_SESSION['line_id']=(isset($_POST['line_id']))?$_POST['line_id']:$_GET['line_id'];
}
require_once '../cnn/pdo_cnn.php';
require_once '../include/func.php';
//print_r($cnn);

?>
<style type="text/css">
.online-block{
	display: none;
}
.footer {
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	background-color: grey;
	color: white;
	text-align: center;
}
.bmiSuggestion { text-align: center; }
.resultGradeDetail { display: none; margin-bottom: 10px;  }

.table-scroll {
	position:relative;
	max-width:600px;
	margin:auto;
	overflow:hidden;
	border:1px solid #000;
}
.table-wrap {
	width:100%;
	overflow:auto;
}
.table-scroll table {
	width:100%;
	margin:auto;
	border-collapse:separate;
	border-spacing:0;
}
.table-scroll th, .table-scroll td {
	padding:5px 10px;
	border:1px solid #000;
	background:#fff;
	white-space:nowrap;
	vertical-align:top;
}
.table-scroll thead, .table-scroll tfoot {
	background:#f9f9f9;
}
.clone {
	position:absolute;
	top:0;
	left:0;
	pointer-events:none;
}
.clone th, .clone td {
	visibility:hidden
}
.clone td, .clone th {
	border-color:transparent
}
.clone tbody th {
	visibility:visible;
	color:red;
}
.clone .fixed-side {
	border:1px solid #000;
	background:#eee;
	visibility:visible;
}
.clone thead, .clone tfoot{background:transparent;}
</style>

<div class="container">
<form>
	<div class="navbar-header">
	<h3><?php echo $cnn['hos_name_th']; ?></h3>
	</div>
	<input type="hidden" id="line_id" value="<?php echo $_SESSION['line_id']; ?>">

	<div id="hackerBlock" class="online-block">
		<h4 align="center">
		</br></br>
		ไม่สามารถใช้งานได้</br> 
		ต้องใช้งานผ่านระบบ</br> 
		MOPH Connect</br> 
		เท่านั้นค่ะ</h4>
	</div>

	<div id="loadingBlock" class="progress online-block">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		</div>
	</div>

	<div id="cidBlock" class="online-block">
		<h4>ลงทะเบียนเข้าใช้งานระบบนัดออนไลน์</h4>
		<div id="inputCid" class="form-group">
			<div class="form-group">
				<label for="cid">เลขบัตรประชาชน</label>
				<input type="text" class="form-control" id="cid" aria-describedby="cidHelp" placeholder="ป้อนเลขบัตรประชาชน">
			</div>
			<div class="form-group row">
				<div class="col-xs-4">
					<label for="birthday_date">วันที่เกิด</label>
				    <select class="form-control" id="birthday_date">
				    	<?php 
				    	for ($i=1; $i<=31 ; $i++) {
				    		?>
				    		<option value="<?php echo substr("00".$i,-2); ?>"><?php echo $i; ?></option>
				    		<?php
				    	} ?>
				    </select>
				</div>
				<div class="col-xs-4"> 
					<label for="birthday_month">เดือนเกิด</label>
				    <select class="form-control" id="birthday_month">
				    	<?php 
				    	$a_month=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				    	for ($i=1; $i<=12 ; $i++) {
				    		?>
				    		<option value="<?php echo substr("00".$i,-2); ?>"><?php echo $a_month[$i-1]; ?></option>
				    		<?php
				    	} ?>
				    </select>
				</div>
				<div class="col-xs-4"> 
					<label for="birthday_year">ปีเกิด</label>
				    <select class="form-control" id="birthday_year">
				    	<?php 
				    	for ($i=(date("Y")*1); $i>=(date("Y")-120) ; $i--) {
				    		?>
				    		<option value="<?php echo substr("0000".$i,-4); ?>"><?php echo $i+543; ?></option>
				    		<?php
				    	} ?>
				    </select>
				</div>
			</div>

		 	<div id="showWrongLimit" class="alert alert-danger online-alert" role="alert">
				<label for="hn">คุณได้ตรวจเลขบัตรประชาชนเกินจำนวนกำหนด โปรดติดต่อห้องบัตร <?php echo getOfficeName($cnn['pcucode']); ?> ค่ะ</label>
			</div>

		 	<div id="showCidRegisterDup" class="alert alert-danger online-alert" role="alert">
				<label>ระบบตรวจสอบพบว่ามีการลงทะเบียนด้วยเลขบัตรประชาชนนี้แล้ว โปรดติดต่อห้องบัตรคลินิก <?php echo getOfficeName($cnn['pcucode']); ?> ด้วยตัวเองก่อนค่ะ</label>
			</div>			

	   		<button type="button" id="cidCheck" class="btn btn-primary online-alert btn-lg btn-block" style="font-size: 20px;">ตรวจสอบเลขบัตรประชาชน</button>
		</div>

	 	<div id="showDetail" class="form-group">
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					Line ID
				</div>
				<div id="conData_line_id" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					เลขบัตรประชาชน
				</div>
				<div id="conData_cid" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					HN
				</div>
				<div id="conData_hn" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					ชื่อ
				</div>
				<div id="conData_name" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					วันเดือนปีเกิด
				</div>
				<div id="conData_birthdate" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<small id="cidHelp" class="form-text text-muted" style="color: red;">** ข้อมูลนี้ใช้สำหรับลงทะเบียนผู้ขอใช้งานระบบนัดออนไลน์ของ <?php echo getOfficeName($cnn['pcucode']); ?> เท่านั้น</small>
	   			<button type="button" id="cidRegisterBtn" class="btn btn-primary btn-lg btn-block" style="font-size: 20px;">ลงทะเบียน</button>


		</div>

	 	<div id="showNoDetail" class="alert alert-danger" role="alert">
			<label>ไม่พบข้อมูลที่ต้องการลงทะเบียน โปรดติดต่อห้องบัตร <?php echo getOfficeName($cnn['pcucode']); ?> ด้วยตัวเองก่อนค่ะ</label>

		</div>

	 	<div id="showDupDetail" class="alert alert-danger" role="alert">
			<label>พบข้อมูลซ้ำซ้อน โปรดติดต่อห้องบัตรคลินิก <?php echo getOfficeName($cnn['pcucode']); ?> ด้วยตัวเองก่อนค่ะ</label>
		</div>
	</div>


	<div id="selfScreenHistoryBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous backToserviceSelectBlock"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<h4>ประวัติผลการกรองสุขภาพด้วยตนเอง</h4>
		<div id="bmi_list" width=100% style="text-align: left; padding-left: 10px;">
			<table width="100%" class="bmi_table" style="border-bottom: solid 1px grey;">
			</table>
<!-- 			<div id="chart" style="width: auto; height: 300px; margin: 0 auto; margin-top: 0px;"></div>
 -->			
 			<div class="table-scroll" id="table-scroll">
 				<div id="tableHistory" class="table-wrap"></div>
			</div>
		</div>
	</div>



	<div id="resultBMI18Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">น้ำหนักน้อยเกินไป</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
คุณมีน้ำหนักน้อยเกินไป  ต้องลองสำรวจหาความผิดปกติของร่างกาย  ระบบย่อยอาหารและการรับประทานอาหารเพื่อหาสาเหตุที่ทำให้เราเบื่ออาหาร ทานไม่ได้  การปล่อยให้ร่างกายผอมมากจะทำให้ได้รับสารอาหารไม่เพียงพอมีผลเสียต่อสุขภาพคุณ
<br><b>คำแนะนำเบื้องต้น</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. รับประทานอาหารที่มีคุณภาพและมีปริมาณเพียงพอ  ให้ครบ  5  หมู่ เน้นอาหารจำพวก เนื้อ นม ไข่ ผัก  ผลไม้
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. ออกกำลังกายให้เหมาะสมตามวัย ( สัปดาห์ละ 3  ครั้งๆละ  30  นาที )
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. พักผ่อนให้เพียงพออย่าหักโหมงานมากเกินไป
<br><br>***ถ้าไม่ดีขึ้นอาจมีปัญหาสุขภาพอื่นๆควรตรวจร่างกายให้ละเอียดเพื่อหาสาเหตุที่แท้จริงต่อไป***
				<div class="bmiSuggestion">
					<h4>คุณควรควบคุมน้ำหนัก<br>ให้อยู่ระหว่าง <span class="good_min_bmi"></span> ถึง <span class="good_max_bmi"></span> กก. </h4>
				</div>
			</div>
		</div>
	</div>


	<div id="resultBMI25Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">น้ำหนักปกติ</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
				<!-- <center><img width=50% src="../img/good_job.png"></center> -->
<br><b>เยี่ยมมาก!!</b> คุณมีรูปร่างสมส่วน น้ำหนักปกติ  อาหารที่รับประทานอยู่เหมาะสมดี
<br><b>คำแนะนำเบื้องต้น</b>
<br>พยายามดูแลสุขภาพและควบคุมน้ำหนักของคุณไว้ในระดับนี้ต่อไปเรื่อยๆ    ด้วยการรับประทานอาหารที่มีประโยชน์  ออกกำลังกายสม่ำเสมอ และพักผ่อนให้เพียงพอ ถ้าอายุน้อยกว่า  35  ปี   คุณควรตรวจ วัดความดันโลหิตทุก  1  ปี      ถ้าอายุมากกว่า  35 ปี   ควรเพิ่มการตรวจหาระดับน้ำตาลในเลือดเพื่อค้นหาโรคเบาหวานอย่างน้อยปีละ  1   ครั้ง  หากสูบบุหรี่หรือดื่มสุราเป็นประจำ  ควรเลิกให้ได้เพื่อสุขภาพของตัวคุณเอง แต่ถ้าคุณเป็นผู้หญิง  คุณควรเพิ่มการตรวจมะเร็งเต้านม  มะเร็งปากมดลูกด้วยนะ โดยเริ่มตั้งแต่อายุ  30   ปี  ขึ้นไป
				<div class="bmiSuggestion">
					<h4>คุณมีนำ้หนักอยู่ในช่วงที่ดีแล้ว <br>ขอให้รักษาน้ำหนักอยู่ระหว่าง <span class="good_min_bmi"></span> ถึง <span class="good_max_bmi"></span> กก. ต่อไปนะคะ</h4>
				</div>
			</div>
		</div>
	</div>


	<div id="resultBMI30Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">น้ำหนักตัวเกิน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
น้ำหนักตัวเกิน…..( ก็เริ่มอ้วนนั่นแหละ) คุณมี ความเสี่ยง  ต่อการเกิดโรคหัวใจและหลอดเลือด  ความดันโลหิตสูง  เบาหวาน  โรคข้อ   และกระดูกและโรคอื่นๆ
<br><b>คำแนะนำ</b>
<br>คุณต้องเริ่มควบคุมน้ำหนักด้วยการควบคุมอาหารประเภทแป้ง  น้ำตาล  ไขมัน   งดการกินจุบกินจิบ  กินอาหารดึกเกินไปและออกกำลังกายอย่างน้อยสัปดาห์ละ  3   ครั้งๆ ละ    ไม่ต่ำกว่า  30  นาที    และปฏิบัติตัวเพื่อลดพุง  ดังนี้
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3  งด</b>  คือ  งดขนมหวาน ของมันและแอลกอฮอล์
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3  ลด</b>  คือ  ลดแป้ง น้ำตาลและเครื่องดื่มรสหวาน
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3  เพิ่ม</b> คือ เพิ่มผัก  ปลา ธัญพืช
     ปฏิบัติตัวง่ายๆแค่นี้รูปร่างของคุณจะกลัมาแข็งแรง  สมส่วน  อย่าปล่อยให้น้ำหนักเพิ่มขึ้นเรื่อยๆเพราะอาจทำให้ล้มป่วยได้  ขอเป็นกำลังใจให้การลดน้ำหนักประสบความสำเร็จด้วยนะ
คนไทยไร้พุง
				<div class="bmiSuggestion">
					<h4>คุณควรควบคุมน้ำหนัก<br>ให้อยู่ระหว่าง <span class="good_min_bmi"></span> ถึง <span class="good_max_bmi"></span> กก. </h4>
				</div>
			</div>
		</div>
	</div>


	<div id="resultBMI40Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">อ้วน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
คุณมีน้ำหนักสูงกว่ามาตรฐาน    สะสมไขมันส่วนเกินมากกว่าปกติ  มีความเสี่ยงสูงต่อการเกิดโรคหัวใจและหลอดเลือด  เบาหวาน ความดันโลหิตสูง  ข้อเสื่อม  โรคเก๊กท์  อัมพฤก
<br><b>คำแนะนำ</b>
<br>คุณต้องเริ่มลดน้ำหนักอย่างจริงจัง  ควรหลีกเลี่ยงอาหารประเภท แป้ง  น้ำตาล  ไขมัน  เพิ่มกิจกรรมในการปฏิบัติภาระกิจประจำวันให้มากขึ้น เช่น การทำงานบ้าน  งานอาชีพประจำ  เพิ่มการเคลื่อนไหวร่างกายมากขึ้น ออกกำลังกายอย่างน้อย  30  นาทีต่อวัน ทุกวัน
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใช้คาถา  3  ส.  ควบคุมน้ำหนักดังนี้
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ส. 1 สกัด</b> สิ่งกระตุ้นที่ทำให้หิวหลีกเลี่ยงของน่ากิน กลิ่นหอม ของชอบ ( ที่มีแป้ง น้ำตาล และไขมันสูง )
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ส. 2 สะกิด</b> ให้คนรอบข้างช่วยเหลือ  ไม่ยั่วยุ ยัดเยียดให้กินอาหาร  แต่ยุให้ออกกำลังกาย
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ส. 3 สะกดใจ</b> ไม่ให้บริโภคเกิน
				<div class="bmiSuggestion">
					<h4>คุณควรควบคุมน้ำหนัก<br>ให้อยู่ระหว่าง <span class="good_min_bmi"></span> ถึง <span class="good_max_bmi"></span> กก. </h4>
				</div>
			</div>
		</div>
	</div>


	<div id="resultBMIOver40Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">อ้วนมาก</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
คุณมีโอกาสเสี่ยงสูงมาก  และเพิ่มความเสี่ยงต่อปัญหาสุขภาพที่รุนแรง   ได้แก่  โรคเบาหวาน    โรคความดันโลหิตสูง       ไขมันในเลือดผิดปกติ   โรคหัวใจขาดเลือด   โรคถุงน้ำดี     โรคเก๊าท์   ข้อเข่าเสื่อม  เป็นต้นนอกจากนี้ยังเสี่ยงต่อการเกิดโรคหลอดเลือดหัวใจ    5  เท่า  เสี่ยงต่อการเป็นโรคหยุดหายใจขณะหลับ   3  เท่า   จนถึงอาจหยุดหายใจขณะหลับได้ 
<br><b>คำแนะนำ</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คุณต้องลดน้ำหนักอย่งเร่งด่วนและจริงจัง  หัวใจสำคัญของการลดน้ำหนักอย่างถาวร  คือ    กินอาหารที่มีไขมันต่ำ  ออกกำลังกายสม่ำเสมอ ลดปริมาณอาหารจำพวกแป้ง  น้ำตาลและไขมัน   เน้น  ปลา ผัก ควรปรึกษาเจ้าหน้าที่สาธารณสุข เพื่อได้รับคำแนะนำที่ถูกต้อง  และตรวจสุขภาพเป็นประจำทุกปี
				<div class="bmiSuggestion">
					<h4>คุณควรควบคุมน้ำหนัก<br>ให้อยู่ระหว่าง <span class="good_min_bmi"></span> ถึง <span class="good_max_bmi"></span> กก. </h4>
				</div>
			</div>
		</div>
	</div>

	<div id="resultCVDLower10Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความเสี่ยงต่อโรคหัวใจใน10ปี = เสี่ยงต่ำ</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!!</b> ความเสี่ยงต่อโรคหัวใจของคุณอยู่ในระดับต่ำที่สุด
<b>คำแนะนำ</b>
<br>1. บริโภคอาหารลดหวาน มัน เค็ม เพิ่มผักและผลไม้
<br>2. ออกกาลังกาย การเคลื่อนไหวร่างกาย ระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที ต่อวัน สัปดาห์ละ 5 วัน ในการเคลื่อนไหวในชีวิตประจาวัน เวลาว่าง และ การทางาน
<br>3. น้าหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 – 22.9 กก./ม หรือใกล้เคียง รอบเอว ผู้หญิง ไม่เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.
<br>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบและไม่สูดดมควันบุหรี่
<br>5. หยุดดื่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนาให้ลดการดื่มลง
(ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน
ผู้หญิง น้อยกว่าหรือเท่ากับ 1 หน่วยมาตรฐาน)
<br>6. ความคุมความดันโลหิตน้อยกว่า 140/90 มม.ปรอท
<br>7. ติดตามทุก 6 เดือน
<br>8. ติดตามประเมินซ้าภายใน 1 ปี
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultCVD1020Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความเสี่ยงต่อโรคหัวใจใน10ปี = เสี่ยงปานกลาง</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. การบริโภคอาหารลดหวาน มัน เค็ม เพิ่มผักและผลไม้
<br>2. ออกกาลังกาย การเคลื่อนไหวร่างกาย ระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาทีต่อวัน สัปดาห์ละ 5 วัน ในการเคลื่อนไหวในชีวิตประจาวัน เวลาว่าง และ การทางาน
<br>3. น้าหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 – 22.9 กก./ม หรือใกล้เคียง รอบเอว ผู้หญิง ไม่เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.
<br>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบและไม่สูดดมควันบุหรี่
<br>5. หยุดดื่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนาให้ลดการดื่มลง
(ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน ผู้หญิง น้อยกว่าหรือเท่ากับ 1 หน่วยมาตรฐาน)
<br>6. ความคุมความดันโลหิต น้อยกว่า 140/90 มม.ปรอท
<br>7. ติดตามทุก 6 เดือน
<br>8. ติดตามประเมินซ้าภายใน 1 ปี
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultCVD2030Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความเสี่ยงต่อโรคหัวใจใน10ปี = เสี่ยงสูง</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. บริโภคอาหารลดหวาน มัน เค็ม เพิ่มผักและผลไม้
<br>2. ออกกาลังกายการเคลื่อนไหวร่างกาย ระดับ หนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที ต่อวัน สัปดาห์ละ 5 วันในการเคลื่อนไหวในชีวิตประจาวัน เวลาว่าง และ การทางาน
<br>3. น้าหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 – 22.9 กก./หรือใกล้เคียง รอบเอว ผู้หญิง ไม่เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.
<br>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบ และไม่สูดดมควันบุหรี่
<br>5. หยุดดื่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนาให้ลดการดื่มลง (ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐานผู้หญิง น้อยกว่าหรือเท่ากับ 1 หน่วยมาตรฐาน)
<br>6. ควบคุมความดันโลหิต น้อยกว่า 140/90 มม.ปรอท ในรายที่ BP มากกว่าหรือเท่ากับ 140/90 มม.ปรอท พบแพทย์เพื่อรับการรักษา
<br>7. ติดตามทุก 3 เดือน
<br>8. ประเมินซ้า ภายใน 6 เดือน
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultCVD3040Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความเสี่ยงต่อโรคหัวใจใน10ปี = เสี่ยงสูงมาก</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. การบริโภคอาหาร ลดหวาน มัน เค็ม เพิ่มผักและผลไม้
<br>2. ออกกาลังกาย การเคลื่อนไหวร่างกายระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที/วัน สัปดาห์ละ 5 วัน
<br>3. น้าหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง18.5 – 22.9 กก./ม หรือใกล้เคียงรอบเอวผู้หญิง ไม่เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.
<br>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบ และไม่สูดดมควันบุหรี่
<br>5. หยุดดื่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนาให้ลดการดื่มลง (ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน ผู้หญิง น้อยกว่าหรือเท่ากับ 1 หน่วยมาตรฐาน)
<br>6. คลินิกอดบุหรี่ คลินิกอดเหล้า คลินิก DPAC
<br>7. ความคุมความดันโลหิต น้อยกว่า 140/90 มม.ปรอท
<br>8. ติดตามทุก 1 เดือน
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultCVDOver40Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความเสี่ยงต่อโรคหัวใจใน10ปี = เสี่ยงสูงอันตราย</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. การบริโภคอาหาร ลดหวาน มัน เค็ม เพิ่มผักและผลไม้
<br>2. ออกกาลังกาย การเคลื่อนไหวร่างกายระดับหนักปานกลาง เช่น เดินเร็ว อย่างน้อย 30 นาที/วัน สัปดาห์ละ 5 วัน
<br>3. น้าหนักและรอบเอว ควบคุม ดัชนีมวลกาย (BMI) ให้อยู่ในช่วง 18.5 – 22.9 กก./ม หรือใกล้เคียงรอบเอวผู้หญิง ไม่เกิน 80 ซม. ชาย ไม่เกิน 90 ซม.
<br>4. หยุดสูบบุหรี่หรือไม่เริ่มสูบ และไม่สูดดมควันบุหรี่
<br>5. หยุดดื่มเครื่องดื่มที่มีแอลกอฮอล์ในรายที่หยุดดื่มไม่ได้ แนะนาให้ลดการดื่มลง (ผู้ชาย น้อยกว่าหรือเท่ากับ 2 หน่วยมาตรฐาน ผู้หญิง น้อยกว่าหรือเท่ากับ 1 หน่วยมาตรฐาน)
<br>6. คลินิกอดบุหรี่ คลินิกอดเหล้า คลินิก DPAC
<br>7. ความคุมความดันโลหิต น้อยกว่า 140/90 มม.ปรอท
<br>8. ติดตามทุก 1 เดือน
<br>9. ประเมินซ้าภายใน 3 เดือน
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultWaistAbnormalBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><b>อ้วนลงพุง</b></h4>
				<h4 class="panel-title">(ชาย 90ซม.ขึ้นไป, หญิง 80ซม.ขึ้นไป)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. การรับประทานอาหารที่ดีต่อสุขภาพและออกกาลังกายอย่างสม่าเสมอ
<br>2. วัดรอบเอวด้วยตนเองทุก2-3เดือน
<br>3. อ.อาหาร เพิ่มผักและผลไม้รสไม่หวาน ผลิตภัณฑ์จากธัญพืช เนื้อสัตว์ไม่ติดมันและหลีกเลี่ยงอาหาร หวาน มัน เค็ม
<br>4. อ.ออกกาลังกาย วันละ 30 นาที/วัน 5 ครั้ง/สัปดาห์เพิ่มกิจกรรมทางกายเช่น ทาความสะอาดบ้าน ขึ้นลงบันได แทนการใช้ลิฟต์ เดินในระยะใกล้ๆแทนการใช้รถ
<br>5. อารมณ์ ผ่อนคลายอารมณ์
<br>6. หยุดสูบบุหรี่ และหลีกเลี่ยงการสุดควันบุหรี่
<br>7. งดดื่มสุรา
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultWaistNormalBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><b>รอบเอวของคุณอยู่ในเกณฑ์ปกติ</b></h4>
				<h4 class="panel-title">(ชายน้อยกว่า 90ซม., หญิงน้อยกว่า 80ซม.)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!!</b> รอบเอวของคุณอยู่ในเกณฑ์ปกติ
<b>คำแนะนำ</b>
<br>1. การรับประทานอาหารที่ดีต่อสุขภาพและออกกาลังกายอย่างสม่าเสมอ
<br>2. วัดรอบเอวด้วยตนเองทุก 2 – 3 เดือน
<br>3. ปรับเปลี่ยนพฤติกรรม 3อ.2ส
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPProperBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความดันโลหิตเหมาะสม</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควบคุมอาหาร
<br>2. ออกกำลังกาย
<br>3.วัดความดันโลหิตอย่างสม่ำเสมอ
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPNormalBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความดันโลหิตปกติ</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!!</b> ความดันโลหิตของคุณอยู่ในเกณฑ์ปกติ
<b>คำแนะนำ</b>
<br>1. ควบคุมอาหาร
<br>2. ออกกำลังกาย
<br>3.วัดความดันโลหิตอย่างสม่ำเสมอ
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPHighBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ความดันโลหิตสูงกว่าปกติ</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>ปรึกษาแพทย์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPHT1Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">โรคความดันโลหิตสูงระดับที่ 1 ระยะเริ่มแรก</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>ปรึกษาแพทย์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPHT2Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">โรคความดันโลหิตสูงระดับที่ 2 ระยะปานกลาง</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>ปรึกษาแพทย์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultBPHT3Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">โรคความดันโลหิตสูงระดับที่ 3 ระยะรุนแรง</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>รีบพบแพทย์โดยด่วน
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSugarNormalBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><b>น้ำตาลในเลือดปกติ</b></h4>
				<h4 class="panel-title">(มีน้ำตาลในเลือดน้อยกว่า 100 มก.ดล.)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!!</b> น้ำตาลในเลือดของคุณอยู่ในเกณฑ์ปกติ
<b>คำแนะนำ</b>
<br>1. ควบคุมอาหาร ออกกาลังกายสม่าเสมอ
<br>2. ควบคุมน้าหนักตัวให้อยู่ในเกณฑ์ที่เหมาะสม
<br>3. ควรประเมินความเสี่ยงซ้าทุก 1-2 ปี
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSugarRiskBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">กลุ่มเสี่ยงเป็นโรคเบาหวาน</h4>
				<h4 class="panel-title">(มีน้ำตาลในเลือดระหว่าง 100 - 125 มก.ดล.)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควบคุมอาหาร ออกกาลังกายสม่าเสมอ
<br>2. ควบคุมน้าหนักตัวให้อยู่ในเกณฑ์ที่เหมาะสม
<br>3. ตรวจวัดความดันโลหิต
<br>4. ประเมินความเสี่ยงซ้าทุก 1 ปี
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSugarPreDiagBlock" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">กลุ่มสงสัยป่วยโรคเบาหวาน</h4>
				<h4 class="panel-title">(มีน้ำตาลในเลือดตั้งแต่ 126 มก.ดล.ขึ้นไป)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควบคุมอาหาร ออกกาลังกายสม่าเสมอ
<br>2. ควบคุมน้าหนักตัวให้อยู่ในเกณฑ์ที่เหมาะสม
<br>3. ตรวจวัดความดันโลหิต
<br>4. ต้องได้รับการตรวจยืนยันว่าเป็นเบาหวานหรือไม่ ภายใน 3 เดือน
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSmoking1Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ไม่สูบบุหรี่</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!! ดูแลตนเองให้ห่างจากพิษภัยของบุหรี่ต่อไปนะ..</b>
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSmoking2Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">สูบบุหรี่แต่ไม่สูบทุกวัน (สูบเป็นครั้งคราว)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. เข้ารับการประเมินการติดบุหรี่ ติดนิโคติน
<br>2. ผู้ที่เสพติดมาก เช่น สูบในปริมาณมากและสูบทันทีเมื่อตื่นนอน ควรปรึกษาเจ้าหน้าที่ช่วยเลิกบุหรี่ที่เข้มข้น 
<br>3. สร้างแรงจูงใจและให้กำลังใจเพื่อช่วยเลิก จากครอบครัว
<br>4. หลีกเลี่ยงการดื่มเครื่องดื่มแอลกอฮอล์ เพราะจะกระตุ้นให้อยากสูบบุหรี่มากขึ้น
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultSmoking3Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">สูบบุหรี่ทุกวัน (สูบเป็นประจำ)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1.เข้ารับการประเมินการติดบุหรี่ติดนิโคติน
<br>2.ผู้ที่เสพติดมาก เช่น สูบในปริมาณมากและสูบทันทีเมื่อตื่นนอนควรปรึกษาเจ้าหน้าที่ช่วยเลิกบุหรี่ที่เข้มข้น 
<br>3. สร้างแรงจูงใจและให้กำลังใจเพื่อช่วยเลิก จากครอบครัว
<br>4. หลีกเลี่ยงการดื่มเครื่องดื่มแอลกอฮอล์ เพราะจะกระตุ้นให้อยากสูบบุหรี่มากขึ้น
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking1Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ไม่ดื่มสุรา</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>เยี่ยมมาก!! ดูแลตนเองให้ห่างจากพิษภัยของสุราต่อไปนะ..</b>
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking6Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราบางโอกาส (1-2ครั้ง/สัปดาห์)</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก 
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking2Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราทุกสัปดาห์</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก 
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking3Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราวันเว้นวัน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking4Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราเกือบทุกวัน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking4Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราเกือบทุกวัน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultDrinking5Block" class="resultGradeDetail">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">ดื่มสุราทุกวัน</h4>
			</div>
			<div class="panel-collapse collapse in" style="padding: 10px;">
<b>คำแนะนำ</b>
<br>1. ควรเข้ารับการประเมินพฤติกรรมการดื่มเครื่องดื่มแอลกอฮอล์ โดย อสม.หรือเจ้าหน้าที่สาธารณสุขในสถานบริการใกล้บ้าน
<br>2. สร้างแรงจูงใจและเสริมกำลังใจจากครอบครัวเพื่อช่วยเลิก
<br>3. พบเจ้าหน้าที่ เพื่อช่วยเลิกแอลกอฮอล์
			<div><h4></h4></div>
			</div>
		</div>
	</div>

	<div id="resultPanel" class="online-block">
<!-- 
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous backToSelfScreenBlock"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
 -->
 		<button type="button" class="btn btn-primary btn-lg btn-block selfScreenHistoryBtn" style="font-size: 20px;">ประวัติผลการประเมิน</button>
		<div style="height: 20px"></div>

		<div class="panel-group">
			<div style="border-radius: 5px; border: none; background-color: lightgrey; color: #000000; text-align: center; padding: 5px; margin-bottom: 5px;">
				<h4>ผลการคัดกรองด้วยตนเอง</h4>
				<div id="resultPanelDate"></div>
			</div>
			<div id="resultContent"></div>
		</div>

		<button type="button" class="btn btn-primary btn-lg btn-block selfScreenHistoryBtn" style="font-size: 20px;">ประวัติผลการประเมิน</button>
		<div style="height: 100px"></div>
	</div>

	<div id="selfScreenBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous backToserviceSelectBlock"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<h4>คัดกรองด้วยตนเอง</h4>
		<div id="inputSelfScreen" class="form-group">
			<input type="hidden" id="selfscreen_id" value="">

			<div class="form-group">
				<label for="isdm">คุณเป็นโรคเบาหวานใช่หรือไม่</label>
				<select class="form-control" id="isdm">
					<option value=""></option>
					<option value="0">0: ไม่ใช่</option>
					<option value="1">1: ใช่</option>
				</select>
			</div>

			<div class="form-group">
				<label for="isht">คุณเป็นโรคความดันโลหิตใช่หรือไม่</label>
				<select class="form-control" id="isht">
					<option value=""></option>
					<option value="0">0: ไม่ใช่</option>
					<option value="1">1: ใช่</option>
				</select>
			</div>

			<div class="form-group">
				<label for="height">ส่วนสูง (เซ็นติเมตร)</label>
				<input type="text" class="form-control" id="height" aria-describedby="" placeholder="">
			</div>

			<div class="form-group">
				<label for="weight">น้ำหนัก (กิโลกรัม)</label>
				<input type="text" class="form-control" id="weight" aria-describedby="" placeholder="">
			</div>

			<div class="form-group">
				<label for="waist">รอบเอว (เซ็นติเมตร)</label>
				<input type="text" class="form-control" id="waist" aria-describedby="" placeholder="">
			</div>

			<div class="form-group">
				<div class="col col-xs-5" style="padding: 0px;">
					<label for="sbp">ความดันโลหิต<br>(ค่าบน)</label>
					<input type="text" class="form-control" id="sbp" aria-describedby="" placeholder="">
				</div>
				<div class="col col-xs-2 text-center">
					<label for="dbp"><br><br></label>
					<div style="font-size: 20pt;">/</div>
				</div>
				<div class="col col-xs-5" style="padding: 0px;">
					<label for="dbp">ความดันโลหิต<br>(ค่าล่าง)</label>
					<input type="text" class="form-control" id="dbp" aria-describedby="" placeholder="">
				</div>
			</div>

			<div class="form-group">
				<label for="fbs">น้ำตาลในเลือด</label>
				<input type="text" class="form-control" id="fbs" aria-describedby="" placeholder="">
			</div>


			<div class="form-group">
				<label for="smoking">สูบบุหรี่</label>
				<select class="form-control" id="smoking">
					<option value=""></option>
					<option value="1">1: ไม่สูบ</option>
					<option value="2">2: สูบแต่ไม่ทุกวัน (สูบเป็นครั้งคราว)</option>
					<option value="3">3: สูบทุกวัน (สูบเป็นประจำ)</option>
				</select>
			</div>

			<div class="form-group">
				<label for="drinking">ดื่มสุรา</label>
				<select class="form-control" id="drinking">
					<option value=""></option>
					<option value="1">1: ไม่ดื่ม</option>
					<option value="6">2: ดื่มบางโอกาส(1-2ครั้ง/เดือน)</option>
					<option value="2">3: ดื่มทุกสัปดาห์</option>
					<option value="3">4: ดื่มวันเว้นวัน</option>
					<option value="4">5: ดื่มเกือบทุกวัน</option>
					<option value="5">6: ดื่มทุกวัน</option>
				</select>
			</div>


<!-- 			<div class="form-group">
				<label for="psycho_2q">ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึก หดหู่ เศร้า หรือท้อแท้สิ้นหวัง หรือไม่</label>
				<select class="form-control" id="psycho_2q">
					<option value="0">ไม่ใช่</option>
					<option value="1">ใช่</option>
				</select>
			</div> -->

			<button type="button" id="selfScreenSaveBtn" class="btn btn-primary btn-lg btn-block" style="font-size: 20px;">บันทึก</button>
			<button type="button" class="btn btn-primary btn-lg btn-block selfScreenHistoryBtn" style="font-size: 20px;">ประวัติผลการประเมิน</button>
		</div>
		<br>
		<br>
		<br>
	</div>


	<div id="serviceSelectBlock" class="online-block">
		<h4>คัดกรองด้วยตนเอง</h4>
<!-- 
		<h4>เลือกบริการ</h4>
		<button type="button" id="patientBlockBtn" class="btn btn-primary btn-lg btn-block" style="font-size: 20px;">นัดออนไลน์</button>
		<br>
		<button type="button" id="selfScreenBtn" class="btn btn-primary btn-lg btn-block" style="font-size: 20px;">คัดกรองด้วยตนเอง</button>		
 -->
	</div>


	<div id="patientBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous backToserviceSelectBlock"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<h4>เลือกผู้ป่วยที่ต้องการนัด</h4>
		<div class="panel-group">
			<div id="selfSelect" class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#mySelect">นัดให้ตัวเอง</a>
					</h4>
				</div>
				<div id="mySelect" class="panel-collapse collapse in">
					<div class="row">
						<div class="col-sm-3 col-xs-5">
							Line ID
						</div>
						<div id="regData_line_id" class="col-sm-9 col-xs-7">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-xs-5">
							เลขบัตรประชาชน
						</div>
						<div id="regData_cid" class="col-sm-9 col-xs-7">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-xs-5">
							HN
						</div>
						<div id="regData_hn" class="col-sm-9 col-xs-7">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-xs-5">
							ชื่อ
						</div>
						<div id="regData_name" class="col-sm-9 col-xs-7">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-xs-5">
							วันเดือนปีเกิด
						</div>
						<div id="regData_birthdate" class="col-sm-9 col-xs-7">
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#homeSelect">นัดให้บุคคลในครอบครัว</a>
					<span class='badge badge-light' id="badgeHomePatientCount"></span>
					</h4>
				</div>
			</div>
			<div id="homeSelect" class="panel-collapse collapse">
			</div>
		</div>
		<div class="panel-group">
			<div id="onlineHistory" class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#onlineHistoryPanel">ประวัติการนัด</a>
					<span class='badge badge-primary' id="badgeOnlineCount"></span>
					</h4>
				</div>
				<ul class="list-group" id="onlineHistoryPanel">
				</ul>
			</div>
		</div>
	</div>


	<div id="dateBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous" id="showOneBlockPatient"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<div class="ptName"></div>
		<h4>เลือกวันที่ที่ต้องการนัด</h4>
		<div id="inputDateSelect" class="form-group" style="padding:0px; margin:0px; width: 100%;">


			<div class="row" style="margin-bottom: 10px;">
				<div class="col-md-1 col-xs-1 text-right" style="padding: 0px;"><span id="calendarPreviousMonth" class="glyphicon glyphicon-step-backward" style="cursor: pointer;"></span></div>
				<div class="col-md-10 col-xs-10 text-center">
					<form class="form-inline">
							<select id="calendarMonth" style="width: auto;">
								<option value="0">มกราคม</option>
								<option value="1">กุมภาพันธ์</option>
								<option value="2">มีนาคม</option>
								<option value="3">เมษายน</option>
								<option value="4">พฤษภาคม</option>
								<option value="5">มิถุนายน</option>
								<option value="6">กรกฎาคม</option>
								<option value="7">สิงหาคม</option>
								<option value="8">กันยายน</option>
								<option value="9">ตุลาคม</option>
								<option value="10">พฤศจิกายน</option>
								<option value="11">ธันวาคม</option>
							</select>
							<select id="calendarYear" style="width: auto;">
								<?php  
								for ($i=2018; $i<=date("Y")+20 ; $i++) { 
									?>
									<option value="<?php echo $i; ?>">พ.ศ. <?php echo $i+543; ?></option>
									<?php
								}
								?>
							</select>
							<a href="#" id="calendarNowMonth">เดือนปัจจุบัน</a>
					</form>
				</div>
				<div class="col-md-1 col-xs-1 text-left" style="padding: 0px;">​
					<span id="calendarNextMonth" class="glyphicon glyphicon-step-forward" style="cursor: pointer;"></span>
				</div>
			</div>
			<div class="row" id="calendar" style="padding-left: 3px; padding-right: 3px;"></div>

		</div>
	</div>

	<div id="clinicBlock" class="online-block">

		<nav aria-label="...">
			<ul class="pager">
				<li class="previous" id="showOneBlockDate"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<div class="ptName"></div>
		<div class="ptBookDate"></div>

		<h4>เลือกแผนกที่ต้องการตรวจ</h4>
		<div id="inputClinicSelect" class="form-group">
			<div id="clinicSelect" class="list-group">
			</div>
		</div>

	 	<div id="showDupQonline" class="alert alert-danger" role="alert">
			<label>คุณเคยนัดแผนกนี้ในวันนี้ไว้แล้ว โปรดเลือกวันอื่น หรือแผนกอื่นค่ะ</label>
		</div>

	</div>

	<div id="timeBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous" id="showOneBlockClinic"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<div class="ptName"></div>
		<div class="ptBookDate"></div>
		<div class="ptBookClinic"></div>

		<h4>เลือกช่วงเวลาที่ต้องการตรวจ</h4>
		<div id="inputTimeSelect" class="form-group">
			<div id="timeSelect" class="list-group">
			</div>
		</div>
	</div>

	<div id="submitBlock" class="online-block">
		<nav aria-label="...">
			<ul class="pager">
				<li class="previous" id="showOneBlockTime"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>
		<div id="summary" class="form-group">
			<h4>สรุปข้อมูลการนัด</h4>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					Line ID
				</div>
				<div id="patData_line_id" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					เลขบัตรประชาชน
				</div>
				<div id="patData_cid" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					HN
				</div>
				<div id="patData_hn" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					ชื่อ
				</div>
				<div id="patData_name" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					วันเดือนปีเกิด
				</div>
				<div id="patData_birthdate" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					วันที่นัด
				</div>
				<div id="patData_book_date" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					แผนกที่นัด
				</div>
				<div id="patData_book_clinic_name" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					เวลานัด
				</div>
				<div id="patData_timeSelect" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<input type="hidden" id="time_id">

		</div>
		<div id="inputSubmit" class="form-group">
			<button id="qOnlineSave" type="button" class="btn btn-primary online-alert btn-lg btn-block" style="font-size: 20px;">บันทึกการจองคิว</button>
		</div>

	</div>


	<div id="registeredBlock" class="online-block">
		<nav aria-label="..." id="registeredShowBack">
			<ul class="pager">
				<li class="previous" id="showOneBlockPatient2"><a href="#" ><span aria-hidden="true">&larr;</span> ย้อนกลับ</a></li>
			</ul>
		</nav>	
		<div id="summary" class="form-group">
			<h4>ใบนัด</h4>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					Q ID
				</div>
				<div id="qonline_qonline_id" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					Line ID
				</div>
				<div id="qonline_line_id" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					เลขบัตรประชาชน
				</div>
				<div id="qonline_cid" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					HN
				</div>
				<div id="qonline_hn" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					ชื่อ
				</div>
				<div id="qonline_name" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					วันเดือนปีเกิด
				</div>
				<div id="qonline_birthdate" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					วันที่นัด
				</div>
				<div id="qonline_book_date" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					แผนกที่นัด
				</div>
				<div id="qonline_book_clinic_name" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					เวลานัด
				</div>
				<div id="qonline_book_time" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-xs-5">
					หมายเหตุ
				</div>
				<div id="qonline_book_note" class="col-sm-9 col-xs-7">
				</div>
			</div>
			<div class="row" style="margin: 10px;">
				<div id="qonline_hn_barcode" class="col-sm-12 text-center">
		 		</div>
	 		</div>			
			<div class="row" class="text-center" style="margin: 10px;">
				<div id="qonline_qrcode" class="col-sm-12 text-center">
		 		</div>
				<center>แสกน QRcode เพื่อตรวจสอบข้อมูล</center>	 		
	 		</div>			


		</div>
		<div id="historyGroup" class="form-group">
			<button id="goHome" type="button" class="btn btn-primary btn-lg btn-block" style="font-size: 20px;">กลับหน้าหลัก</button>
		</div>
	</div>


	<div id="historyBlock" class="online-block">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#myHistory">
							ประวัติการนัดให้ตัวเอง 
						</a>
						<span class='badge badge-light' id="badgeMyHistoryCount"></span>
					</h4>
				</div>
				<div id="myHistory" class="panel-collapse collapse"></div>
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#homeHistory">
							ประวัติการนัดให้บุคคลในครอบครัว 
						</a>
						<span class='badge badge-light' id="badgeHomeHistoryCount"></span>
					</h4>
				</div>
				<div id="homeHistory" class="panel-collapse collapse"></div>
			</div>
		</div>
	</div>



</form>
<footer class="footer">
SmartQ © 2019 Copyright: ICT สสจ.สกลนคร
</footer>
</div>

<script>
	ajax_session='<?php echo $_SESSION['user_id']; ?>';
	var register_wrong_limit=parseInt('<?php echo $cnn['register_wrong_limit']; ?>');
	var line_id='<?php echo $_SESSION['line_id']; ?>';
	var conData={};
	var regData={};
	var patData={};
	var appData={};

	var d = new Date();
  	var nowYear = d.getFullYear();
  	var nowMonth = d.getMonth();
  	var prasentYear = d.getFullYear();
  	var prasentMonth = d.getMonth();
	var nowYYYYmd = d.getFullYear()+"-"+d.getMonth()+"-"+d.getDate();

	function shortThaiDate(dbdate) {
		var y=(parseInt(dbdate.substr(0,4))+543).toString().substr(-2);
		var m=dbdate.substr(5,2);
		var d=parseInt(dbdate.substr(8,2));
		switch (m) {
			case '01' : m='ม.ค.'; break;
			case '02' : m='ก.พ.'; break;
			case '03' : m='มี.ค.'; break;
			case '04' : m='เม.ษ.'; break;
			case '05' : m='พ.ค.'; break;
			case '06' : m='มิ.ย.'; break;
			case '07' : m='ก.ค.'; break;
			case '08' : m='ส.ค.'; break;
			case '09' : m='ก.ย.'; break;
			case '10' : m='ต.ค.'; break;
			case '11' : m='พ.ย.'; break;
			case '12' : m='ธ.ค.'; break;
		}
		return d+m+y
	}

	function preCreateChart() {
		$.ajax({
			method: "POST",
			url: "../qonline/getSelfScreenHistory.php",
			data: {	cid: regData['cid'] }
		}).done(function (msg) {
	        $('#onlineHistoryPanel').empty();
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);
			createChart(a_msg);
        });
	}

	var cdate='';
	function getSelfScreenHistoryAll() {
		$("#tableHistory").empty();
		$.ajax({
			method: "POST",
			url: "../qonline/getSelfScreenHistoryAll.php",
			data: {	cid: regData['cid'] }
		}).done(function (msg) {
            a_msg = jQuery.parseJSON(msg);
            var a_data=[];
            a_data['screen_date']=[];
            a_data['isdm']=[];
            a_data['isht']=[];
            a_data['height']=[];
            a_data['weight']=[];
            a_data['waist']=[];
            a_data['bp']=[];
            a_data['fbs']=[];
            a_data['drinking']=[];
            a_data['smoking']=[];
            a_data['paraData']=[];

            $.each(a_msg,function(i,row){
            	cdate=row['cdate'];
            	a_data['paraData'][i]=JSON.stringify(row);
            	a_data['screen_date'][i]=shortThaiDate(row['screen_date']);
            	a_data['isdm'][i]=yn(row['isdm']);
            	a_data['isht'][i]=yn(row['isht']);
            	a_data['height'][i]=row['height'];
            	a_data['weight'][i]=row['weight'];
            	a_data['waist'][i]=row['waist'];
            	a_data['bp'][i]=row['sbp']+"/"+row['dbp'];
            	a_data['fbs'][i]=row['fbs'];
            	a_data['drinking'][i]=lookup_drinking(row['drinking']);
            	a_data['smoking'][i]=lookup_smoking(row['smoking']);
            });

			var table = $('<table></table>');
			table.addClass('main-table');
			var tbody=$('<tbody></tbody>');
			table.append(tbody);
			tbody.append(crTR(a_data['screen_date'],'วันที่','y','y',a_data['paraData']));
			tbody.append(crTR(a_data['isdm'],'โรคเบาหวาน'));
			tbody.append(crTR(a_data['isht'],'โรคความดันฯ'));
			tbody.append(crTR(a_data['height'],'ส่วนสูง'));
			tbody.append(crTR(a_data['weight'],'น้ำหนัก'));
			tbody.append(crTR(a_data['waist'],'รอบเอว'));
			tbody.append(crTR(a_data['bp'],'ความดันโลหิต'));
			tbody.append(crTR(a_data['fbs'],'น้ำตาลในเลือด'));
			tbody.append(crTR(a_data['drinking'],'ดื่มสุรา'));
			tbody.append(crTR(a_data['smoking'],'สูบบุหรี่'));
			table.css({"border-top":"solid 1px black","border-right":"solid 1px black"});
			table.find('tr').find('td').css({"border-left":"solid 1px black","border-bottom":"solid 1px black","font-family":"Tahoma","font-size":"12pt","white-space":"nowrap","text-align":"center"});
			$("#tableHistory").append(table);
			$(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');   
        });
	}

	function lookup_drinking(x) {
		var r='';
		switch (x) {
			case "0" : r="ไม่ระบุ"; break;
			case "1" : r="ไม่ดื่ม"; break;
			case "6" : r="ดื่มบางโอกาส"; break;
			case "2" : r="ดื่มทุกสัปดาห์"; break;
			case "3" : r="ดื่มวันเว้นวัน"; break;
			case "4" : r="ดื่มเกือบทุกวัน"; break;
			case "5" : r="ดื่มทุกวัน"; break;
		}
		return r;
	}

	function lookup_smoking(x) {
		var r='';
		switch (x) {
			case "0" : r="ไม่ระบุ"; break;
			case "1" : r="ไม่สูบ"; break;
			case "2" : r="สูบแต่ไม่ทุกวัน"; break;
			case "3" : r="สูบทุกวัน"; break;
		}
		return r;
	}

	function yn(x) {
		var r='ใช่';
		if (!(x=='1' | x==1)) {
			r='ไม่ใช่';
		}
		return r;
	}

	function crTR(x,t,btnViewResult,btnEdit,paraData) {
		var ntr=$('<tr></tr>');
		var fix_td=$('<td></td>');
		fix_td.addClass('fixed-side').text(t);
		ntr.append(fix_td);
		$.each(x,function(i,d) {
			var ntd=$('<td></td>').text(d);
			if (btnViewResult=='y') {
				ntd.append($('<br>'));
				ntd.append($('<button></button>').attr({"type":"button","paraData":paraData[i]}).addClass("btn btn-success btn-result-view").css({"padding":"4px","width":"100%","font-size":"11pt"}).text('ดูผล'));
			}
			if (btnEdit=='y' & shortThaiDate(cdate)==d) {
				ntd.append($('<br>'));
				ntd.append($('<button></button>').attr({"type":"button","paraData":paraData[i]}).addClass("btn btn-info btn-result-edit").css({"padding":"4px","width":"100%","font-size":"11pt"}).text('แก้ไข'));
			}
			ntr.append(ntd);
		});
		return ntr;
	}

	function createChart(graph_data) {
		console.log(graph_data);
		var xline=[];
		var yline=[];
		graph_data.forEach(function (i) {
			xline.push(shortThaiDate(i.screen_date));
		});
		graph_data.forEach(function (i) {
			yline.push(parseInt(i.bmi));
		});
		Highcharts.chart('chart', {
			chart: {type: 'line' }
			,title: {text: 'ดัชนีมวลกายของคุณ'}
			,subtitle: { text: 'ดัชนีมวลกายช่วยวัดระดับความอ้วน' }
			,xAxis: {
				categories: xline,
				crosshair: true
			}
			,yAxis: {
				min: 0
				,title: { text: '' }
				,tickInterval: 5
			}
			,legend: { enabled: false }
			,tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			}
			,plotOptions: {
				series: {
					pointPadding: 0.2
					,borderWidth: 0
	                ,dataLabels: {
	                    enabled: true,
	                    formatter: function () {
	        				return Highcharts.numberFormat(this.y,0,'.',',');
	    				}
	                }
					,rotation: -90
					,verticalAlign: 'top'
					,connectNulls: true
				}
			},
			series: [{
				name: ''
				,data: yline
			}]
		});
	}

	function ckVal(z) {
		var x=$("#"+z);
		var v=x.val();
		var r=1;
		if (v=="") {
			x.css({"border-color":"red"});
			r=1;
		}
		else {
			x.css({"border-color":"lightgrey"});
			r=0;
		}
		return r;
	}

	$(function () {

		$("#inputSelfScreen input:not(#fbs,#sbp,#dbp) , #inputSelfScreen select:not(#fbs,#sbp,#dbp)").bind("keyup change", function(e) {
			ckVal($(this).attr('id'));
		});

		loadQOnlineData(nowYear,nowMonth);
		$("#calendarPreviousMonth").click(function(){
			nowYear=(nowMonth==0)?nowYear-1:nowYear;
			nowMonth=(nowMonth==0)?11:nowMonth-1;
			loadQOnlineData(nowYear,nowMonth);
		})
		$("#calendarNextMonth").click(function(){
			nowYear=((nowMonth+1)>11)?nowYear+1:nowYear;
			nowMonth=((nowMonth+1)>11)?0:nowMonth+1;
			loadQOnlineData(nowYear,nowMonth);
		})
		$("#calendarNowMonth").click(function(){
			nowYear=prasentYear;
			nowMonth=prasentMonth;
			loadQOnlineData(nowYear,nowMonth);
		})
		$("#calendarMonth, #calendarYear").change(function(){
			nowYear=parseInt($("#calendarYear").val());
			nowMonth=parseInt($("#calendarMonth").val());
			loadQOnlineData(nowYear,nowMonth);
		})

		$("#showDetail").hide();
		$("#showCidRegisterDup").hide();
		$("#showDupDetail").hide();
		$("#showNoDetail").hide();
		$("#showWrongLimit").hide();

		lineCheck(line_id);

		$("#showOneBlockTime").click(function(){
			showOneBlock("timeBlock");
		});
		$("#showOneBlockClinic").click(function(){
			showOneBlock("clinicBlock");
		});
		$("#showOneBlockDate").click(function(){
			showOneBlock("dateBlock");
		});
		$("#showOneBlockServiceSelect").click(function(){
			showOneBlock("serviceSelectBlock");
		});
		$(".backToserviceSelectBlock").click(function(){
			// showOneBlock("serviceSelectBlock");
			window.location="index.php?dir=qonline&file=index&div=fullscreen&line_id=<?php echo $_SESSION['line_id']; ?>";
		});
		$("#selfScreenBtn").click(function(){
			showOneBlock("selfScreenBlock");
		});
		$(".selfScreenHistoryBtn").click(function(){
			//preCreateChart();
			getSelfScreenHistoryAll();
			showOneBlock("selfScreenHistoryBlock");
		});

		$("#selfScreenSaveBtn").click(function(){
			$("#resultContent").empty();

			var countNotValid=ckVal("isdm")+ckVal("isdm")+ckVal("height")+ckVal("weight")+ckVal("waist")+ckVal("smoking")+ckVal("drinking");
			if (countNotValid==0) {
				var height=parseFloat($("#height").val());
				var weight=parseFloat($("#weight").val());
				var sbp=parseInt($("#sbp").val());
				var dbp=parseInt($("#dbp").val());
				var dm=parseInt($("#isdm").val());
				var waist=parseFloat($("#waist").val());
				var smoking=($("#smoking").val());
				var drinking=($("#drinking").val());
				var fbs=parseInt($("#fbs").val());
				var age=getAge(regData['birthdate'],'today');
				var sex=(regData['sex']=='1'?1:2);
				var selfscreen_id=($("#selfscreen_id").val()==""?null:$("#selfscreen_id").val());
				var today=new Date();
                var screen_date=today.getFullYear()+'-'+add0(today.getMonth(),2)+'-'+add0(today.getDate(),2);

				showScreenResult(height,weight,sbp,dbp,dm,waist,smoking,fbs,age,sex,drinking,screen_date);

	            $.ajax({
	                method: "POST",
	                url: "../qonline/selfscreen_save.php",
	                data: { 
	                	selfscreen_id: selfscreen_id,
	                	line_id: regData['line_id'], 
	                	cid: regData['cid'], 
	                	hn: regData['hn'], 
	                	hospcode_smartq: '<?php echo $cnn['pcucode']; ?>',
	                	height: $("#height").val(),
	                	weight: $("#weight").val(),
	                	bmi: calBMI(weight,height),
	                	sbp: $("#sbp").val(),
	                	dbp: $("#dbp").val(),
	                	waist: $("#waist").val(),
	                	smoking: $("#smoking").val(),
	                	drinking: $("#drinking").val(),
	                	fbs: $("#fbs").val(),
	                	cvd_score: calCVDRisk(age,sex,sbp,dm,waist,height,smoking),
	                	isdm: $("#isdm").val(),
	                	isht: $("#isht").val()
	                }
	            }).done(function (msg) {
// console.log(msg);
					//preCreateChart();
					$("#selfscreen_id").val("");
					getSelfScreenHistoryAll();
	            });
	        } /// ---- END -- if (countNotValid==0)
		});
		$(".backToSelfScreenBlock").click(function(){
			showOneBlock("selfScreenBlock");
		});
		$("#patientBlockBtn").click(function(){
			showOneBlock("patientBlock");
		});
		$("#showOneBlockPatient").click(function(){
			showOneBlock("patientBlock");
		});
		$("#showOneBlockPatient2").click(function(){
			showOneBlock("patientBlock");
		});
		$("#cidRegisterBtn").click(function(){
            $.ajax({
                method: "POST",
                url: "../qonline/cidRegister_save.php",
                data: { 
                	line_id: conData['line_id'], 
                	cid: conData['cid'], 
                	hn: conData['hn'], 
                	pname: conData['pname'], 
                	fname: conData['fname'], 
                	lname: conData['lname'], 
                	birthdate: conData['birthdate'] 
                }
            }).done(function (msg) {
            	getCidRegister(line_id);
				showOneBlock("serviceSelectBlock");		
            });

		});
		$("#cidCheck").click(function(){
			$("#showDetail").hide();
			$("#showCidRegisterDup").hide();
			$("#showDupDetail").hide();
			$("#showNoDetail").hide();	
			$("#showWrongLimit").hide();

            $.ajax({
                method: "POST",
                url: "../qonline/cidRegisterWrong_check.php",
                data: {
                	line_id: $("#line_id").val(),
                	cid: $("#cid").val()
                }
            }).done(function (msg) {
            	if (msg<register_wrong_limit){

		            $.ajax({
		                method: "POST",
		                url: "../qonline/getCidRegisterByCid.php",
		                data: { cid: $("#cid").val() }
		            }).done(function (msg) {
		            	// console.log(msg);
		            	var a_msg = jQuery.parseJSON(msg);
		            	if (a_msg.length>0){

		            		$("#showCidRegisterDup").show();

		            	}else{






							$.post(
								"../ajax/ajax.php", 
								{ 
									action:'chk_hn_birthday', 
									card_cid: $("#cid").val(),
									card_birthday: $("#birthday_year").val()+"-"+$("#birthday_month").val()+"-"+$("#birthday_date").val(),
								}, 
								function(x){
									if (x) {
										if (x.length>1){
											conData={};
											$("#showDupDetail").show();
										}else{
											conData['line_id']=line_id;
											conData['cid']=$("#cid").val();
											conData['hn']=x[0].hn;
											conData['pname']=x[0].pname;
											conData['fname']=x[0].fname;
											conData['lname']=x[0].lname;
											conData['birthdate']=x[0].birthday;
											$("#showDetail").show();
											$("#conData_line_id").html(demoFormat('line_id',conData['line_id']));
											$("#conData_cid").html(demoFormat('cid',conData['cid']));
											$("#conData_hn").html(conData['hn']);
											$("#conData_name").html(conData['pname']+conData['fname']+" "+demoFormat('lname',conData['lname']));
											$("#conData_birthdate").html(demoFormat('birthday',dateFormat(conData['birthdate'],"thaiShortDate")));
								            $.ajax({
								                method: "POST",
								                url: "../qonline/cidRegisterWrong_save.php",
								                data: { 
								                	line_id: conData['line_id'],
								                	cid: conData['cid'], 
								                	hn: conData['hn'], 
								                	pname: conData['pname'], 
								                	fname: conData['fname'],
								                	lname: conData['lname'], 
								                	birthdate: conData['birthdate'] 
								                }
								            }).done(function (msg) {

								            	getHome(conData['cid']);
								            	getHistory(conData['line_id']);







								            	//console.log(msg);
								            });
										}
									}else{
										conData={};
										$("#showNoDetail").show();
									}
								}
								,'json'
							);
						}
					});
            	}else{
					$("#showWrongLimit").show();
            	}
            });
		});

		$('#clinicSelect').on( 'click', 'a', function(){
			var this_qclinicconfig_code=$(this).attr('qclinicconfig_code');
			var this_qclinicconfig_name=$(this).attr('qclinicconfig_name');
            $.ajax({
                method: "POST",
                url: "../qonline/qonlineCheckDup.php",
                data: { 
                	cid: patData['cid'], 
                	book_date: appData['book_date'], 
                	book_clinic:  this_qclinicconfig_code,
                }
            }).done(function (msg) {
            	var a_msg = jQuery.parseJSON(msg);
            	if (a_msg.length>0){
            		$("#showDupQonline").show();
            	}else{
//console.log($(this));
//alert(this_qclinicconfig_code);           		
					appData['book_clinic']=this_qclinicconfig_code;
					appData['book_clinic_name']=this_qclinicconfig_name;
					$(".ptBookClinic").html("<h4>คลินิกที่นัด : "+appData['book_clinic_name']+"</h4>");
					loadOnlineTime(patData['cid'],appData['time_table'],this_qclinicconfig_code,appData['book_date']);
					showOneBlock("timeBlock");	
				}
			});			

		})

		$('#timeSelect').on( 'click', 'a', function(){
			if ($(this).attr("balance_max_limit")>0){
	//			console.log($(this));
				timeSelect=timeFormat($(this).attr('time_start'),"minute")+" - "+timeFormat($(this).attr('time_end'),"minute")+" น.";
				appData['time_start']=$(this).attr('time_start');
				appData['time_end']=$(this).attr('time_end');
				appData['line_id']=line_id;
				appData['cid']=patData['cid'];
				appData['hn']=patData['hn'];
				appData['pname']=patData['pname'];
				appData['fname']=patData['fname'];
				appData['lname']=patData['lname'];
				appData['birthdate']=patData['birthdate'];
				appData['time_id']=$(this).attr('time_id');


				$("#patData_line_id").html(demoFormat('line_id',patData['line_id']));
				$("#patData_cid").html(demoFormat('cid',patData['cid']));
				$("#patData_hn").html(patData['hn']);
				$("#patData_name").html(patData['pname']+patData['fname']+' '+demoFormat('lname',patData['lname']));
				$("#patData_birthdate").html(demoFormat('birthday',dateFormat(patData['birthdate'],"thaiLongDate")));
				$("#patData_book_date").html(dateFormat(appData['book_date'],"thaiLongDate"));
				$("#patData_book_clinic_name").html(appData['book_clinic_name']);
				$("#patData_timeSelect").html(timeSelect);
				$("#patData_time_id").val(appData['time_id']);
				showOneBlock("submitBlock");	
			}else{
				alert("ไม่สามารถเลือกรายการที่มีจำนวนเท่ากับ 0 ได้ค่ะ");
			}			
		});

		$('#qOnlineSave').click(function(){
            $.ajax({
                method: "POST",
                url: "../qonline/qOnline_save.php",
                data: {
                	line_id: appData['line_id'],
                	cid: appData['cid'], 
                	hn: appData['hn'], 
                	pname: appData['pname'], 
                	fname: appData['fname'], 
                	lname: appData['lname'], 
                	birthdate: appData['birthdate'], 
                	time_id: appData['time_id'], 
                	book_date: appData['book_date'], 
                	book_clinic: appData['book_clinic'],
                	book_clinic_name: appData['book_clinic_name'],
                	time_start: appData['time_start'], 
                	time_end: appData['time_end'], 
                	time_table: appData['time_table'], 
                	qcidregister_id: regData['qcidregister_id'], 
                	hospcode: '<?php echo $cnn['pcucode']; ?>'  
                }
            }).done(function (msg) {
//console.log(msg);
				showAppoint(parseInt(msg),appData['book_date'],'save');
            });

		});

		$("#goHome").click(function(){
			location.reload();
		});

		$("#historyBtn").click(function(){
			$.ajax({
				method: "POST",
				url: "../qonline/getOnlineHistoryCid.php",
				data: {	cid: $("#cid").val() }
			}).done(function (msg) {
	//console.log(msg);											
		        $('#myHistory').empty();
	            var a_msg = {};
	            a_msg = jQuery.parseJSON(msg);
	            $("#badgeMyHistoryCount").html(a_msg.length);
	            $.each( a_msg, function( key, value ) {
			        var a=document.createElement('a');
			        a.setAttribute('class','list-group-item');
					a.setAttribute('href', '#');
					a.innerHTML=dateFormat(value.book_date,"thaiShortDate")+" "+value.book_clinic;
					$(a).appendTo($('#myHistory'));
	            });
				$.ajax({
					method: "POST",
					url: "../qonline/getOnlineHistoryLineId.php",
					data: {	line_id: $("#line_id").val() }
				}).done(function (msg) {
		//console.log(msg);											
			        $('#homeHistory').empty();
		            var a_msg = {};
		            a_msg = jQuery.parseJSON(msg);
		            $("#badgeHomeHistoryCount").html(a_msg.length);
		            $.each( a_msg, function( key, value ) {
				        var a=document.createElement('a');
				        a.setAttribute('class','list-group-item');
						a.setAttribute('href', '#');
						a.innerHTML=value.pname+value.fname+" "+demoFormat('lname',value.lname)+" "+dateFormat(value.book_date,"thaiShortDate")+" "+value.book_clinic;
						$(a).appendTo($('#homeHistory'));
		            });	            
		        });
	        });
			showOneBlock("historyBlock");
		});

		$("#selfSelect").click(function(){
			selectPatient($(this));
		});

		$(document).on('click','.btn-result-edit',function() {
			var d=$.parseJSON($(this).attr('paraData'));
			showOneBlock("selfScreenBlock");
			$("#selfscreen_id").val(d.selfscreen_id);
			$("#isdm").val(d.isdm);
			$("#isht").val(d.isht);
			$("#height").val(d.height);
			$("#weight").val(d.weight);
			$("#waist").val(d.waist);
			$("#sbp").val(d.sbp);
			$("#dbp").val(d.dbp);
			$("#fbs").val(d.fbs);
			$("#smoking").val(d.smoking);
			$("#drinking").val(d.drinking);
		});

		$(document).on('click',".btn-result-view",function() {
			var d=$.parseJSON($(this).attr('paraData'));
// console.log(d);
			var age=getAge(regData['birthdate'],d.screen_date);
			var sex=(regData['sex']=='1'?1:2);
// console.log(regData['birthdate']+'|'+regData['sex']);
			showScreenResult(d.height,d.weight,d.sbp,d.dbp,d.isdm,d.waist,d.smoking,d.fbs,age,sex,d.drinking,d.screen_date);
		});
	});

	function add0(x,n) {
		var r=x;
		for (var i=0;i<n-String(x).length;i=i+1) {
			r='0'+r;
		}
		return r;
	}

	function calBMI(weight,height) {
		return weight/((height/100)*(height/100));
	}

	function calCVDRisk(age,sex,sbp,dm,waist,height,smoking) {
		var cvd_prescore=(0.079*age)+(0.128*sex)+(0.019350987*sbp)+(0.58454*dm)+(3.512566*(waist/height))+(0.459*smoking);
		var cvd_score=(1-Math.pow(0.978296,Math.exp(cvd_prescore-7.720484)))*100;
		return cvd_score;
	}

	function showScreenResult(height,weight,sbp,dbp,dm,waist,smoking,fbs,age,sex,drinking,screen_date) {
// console.log(height+'|'+weight+'|'+sbp+'|'+dbp+'|'+dm+'|'+waist+'|smoking-'+smoking+'|'+fbs+'|'+age+'|sex-'+sex+'|drinking-'+drinking+'|screen_date-'+screen_date);
		$("#resultPanelDate").text('('+shortThaiDate(screen_date)+')');
		$("#resultContent").empty();
		// -------------- BMI -------------------------------------
		var bmi=calBMI(weight,height);
		var min_bmi=18.5;
		var max_bmi=24.9;
		var good_min_bmi=min_bmi*height*height/10000;
		var good_max_bmi=max_bmi*height*height/10000;
		$(".good_min_bmi").text(Math.round(good_min_bmi));
		$(".good_max_bmi").text(Math.round(good_max_bmi));

		if (bmi<18.5) { $("#resultBMI18Block").clone(false).appendTo($("#resultContent")); }
		else if (bmi<25) { $("#resultBMI25Block").clone(false).appendTo($("#resultContent")); }
		else if (bmi<30) { $("#resultBMI30Block").clone(false).appendTo($("#resultContent")); }
		else if (bmi<40) { $("#resultBMI40Block").clone(false).appendTo($("#resultContent")); }
		else { $("#resultBMIOver40Block").clone(false).appendTo($("#resultContent")); }

		// -------------- Calc CVD Risk (สูตรHDC) -------------------------------------
		//(0.079*age)+(0.128*sex)+(0.019350987*sbp)+(0.58454*dm)+(3.512566*(waist_cm/height))+(0.459*smoking);
		//(1-POWER(0.978296,EXP(FullScore-7.720484)))*100;
		// var cvd_prescore=(0.079*age)+(0.128*sex)+(0.019350987*sbp)+(0.58454*dm)+(3.512566*(waist/height))+(0.459*smoking);
		// var cvd_score=(1-Math.pow(0.978296,Math.exp(cvd_prescore-7.720484)))*100;
		var cvd_smoking=(smoking=='1'?0:1);
		var cvd_score=calCVDRisk(age,sex,sbp,dm,waist,height,cvd_smoking);
		// console.log(age+'|'+sex+'|'+sbp+'|'+dm+'|'+waist+'|'+height+'|'+smoking);
		// console.log(cvd_prescore);
		// console.log(cvd_score);

		if (cvd_score<10) { $("#resultCVDLower10Block").clone(false).appendTo($("#resultContent")); }
		else if (cvd_score<20) { $("#resultCVD1020Block").clone(false).appendTo($("#resultContent")); }
		else if (cvd_score<30) { $("#resultCVD2030Block").clone(false).appendTo($("#resultContent")); }
		else if (cvd_score<40) { $("#resultCVD3040Block").clone(false).appendTo($("#resultContent")); }
		else if (cvd_score>=40) { $("#resultCVDOver40Block").clone(false).appendTo($("#resultContent")); }
		

		// -------------- Waist -------------------------------------
		var waist_score=((sex==1&waist>90)|(sex==2&waist>80)?'abnormal':'normal');
		if (waist_score=='normal') { $("#resultWaistNormalBlock").clone(false).appendTo($("#resultContent")); }
		else { $("#resultWaistAbnormalBlock").clone(false).appendTo($("#resultContent")); }

		// -------------- BP -------------------------------------
		if (sbp & dbp) {
			if (sbp>=180|dbp>=110) { $("#resultBPHT3Block").clone(false).appendTo($("#resultContent")); }
			else if (sbp>=160|dbp>=100) { $("#resultBPHT2Block").clone(false).appendTo($("#resultContent")); }
			else if (sbp>=140|dbp>=90) { $("#resultBPHT1Block").clone(false).appendTo($("#resultContent")); }
			else if (sbp>=130|dbp>=85) { $("#resultBPHighBlock").clone(false).appendTo($("#resultContent")); }
			else if (sbp>=120|dbp>=80) { $("#resultBPNormalBlock").clone(false).appendTo($("#resultContent")); }
			else if (sbp<120|dbp<80) { $("#resultBPProperBlock").clone(false).appendTo($("#resultContent")); }
			// else { $("#resultBPNormalBlock").clone(false).appendTo($("#resultContent")); }
		}

		// -------------- Sugar -------------------------------------
		if (fbs) {
			if (fbs>=126) { $("#resultSugarPreDiagBlock").clone(false).appendTo($("#resultContent")); }
			else if (fbs>=100) { $("#resultSugarRiskBlock").clone(false).appendTo($("#resultContent")); }
			else if (fbs<100) { $("#resultSugarNormalBlock").clone(false).appendTo($("#resultContent")); }
			// else { $("#resultSugarNormalBlock").clone(false).appendTo($("#resultContent")); }
		}

		if (smoking) {
			if (smoking=='1') { $("#resultSmoking1Block").clone(false).appendTo($("#resultContent")); }
			else if (smoking=='2') { $("#resultSmoking2Block").clone(false).appendTo($("#resultContent")); }
			else if (smoking=='3') { $("#resultSmoking3Block").clone(false).appendTo($("#resultContent")); }
		}

		if (drinking) {
			if (drinking=='1') { $("#resultDrinking1Block").clone(false).appendTo($("#resultContent")); }
			else if (drinking=='6') { $("#resultDrinking6Block").clone(false).appendTo($("#resultContent")); }
			else if (drinking=='2') { $("#resultDrinking2Block").clone(false).appendTo($("#resultContent")); }
			else if (drinking=='3') { $("#resultDrinking3Block").clone(false).appendTo($("#resultContent")); }
			else if (drinking=='4') { $("#resultDrinking4Block").clone(false).appendTo($("#resultContent")); }
			else if (drinking=='5') { $("#resultDrinking5Block").clone(false).appendTo($("#resultContent")); }
		}

		$("#resultPanel").find("div").css({"display":"block"});
		showOneBlock("resultPanel");
	}
	
	function getAge(dateString,dateRef) {
		var today = new Date(dateRef);
		if (dateRef=='today') {
			today = new Date();
		}
	    var birthDate = new Date(dateString);
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	        age--;
	    }
	    return age;
	}

	function loadQOnlineData(year,month){
		year=parseInt(year);
		month=parseInt(month);

//console.log(year+"-"+month);
		var xyCalendar = $("#calendar").offset();
		$("#calendar").html("");
		$("#calendarMonth").val(month);
		$("#calendarYear").val(year);
		var thisDate = new Date(year,month,1);
		var startDate = new Date(year,month,1);
		startDate.setDate(thisDate.getDate()-thisDate.getDay());
		if (startDate.getMonth()==month){
			startDate.setDate(startDate.getDate()-7);
		}else{
			var testDate = new Date(startDate.getFullYear(),startDate.getMonth());
			testDate.setDate(startDate.getDate()+1);
			if (testDate.getMonth()==month){
				startDate.setDate(startDate.getDate()-7);
			}
		}
		var endDate = new Date(year,month+1,1);
		if (endDate.getDay()==6){
			endDate.setDate(8);
		}else{
			endDate.setDate(endDate.getDate()+(6-endDate.getDay()));
		}
	    $.ajax({
	        method: "POST",
	        url: "../qonline/myQonline.php",
	        data: { 
	        	start_date: startDate.getFullYear()+"-"+("00"+(startDate.getMonth()+1)).substr(-2)+"-"+("00"+startDate.getDate()).substr(-2),
	        	end_date: endDate.getFullYear()+"-"+("00"+(endDate.getMonth()+1)).substr(-2)+"-"+("00"+endDate.getDate()).substr(-2)
	        }
	    }).done(function (msg) {
//console.log(msg);
	    	var a_msg = jQuery.parseJSON(msg);
//console.log(a_msg);

			var dayList = {0:'อา',1:'จ',2:'อ',3:'พ',4:'พฤ',5:'ศ',6:'ส'};
	        var table = document.createElement("TABLE");
	        table.className += "table table-bordered table-condensed";
	        var thead = table.createTHead();
	        var row = thead.insertRow(-1);
	        $("#calendar").parent().height($("#calendar").parent().parent().width());
	        var cellWidth = $("#calendar").parent().parent().width()/7;
			$.each(dayList, function (index,value) {
	            var headerCell = document.createElement("TH");
	            headerCell.innerHTML = value;
	            $(headerCell).css({overflow: "hidden"});
	            $(headerCell).css({textOverflow: "clip"});
	            $(headerCell).css({textAlign: "center"});
			    $(headerCell).css({fontSize: "18px"});
			    $(headerCell).css({fontWeight: "bold"});
			    $(headerCell).css({width: cellWidth+"px"});
			    $(headerCell).css({maxWidth: cellWidth+"px"});
	            row.appendChild(headerCell);
	        });
			var diffTime = Math.abs(endDate.getTime() - startDate.getTime());
			var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 	        
//	        var cellHeight = ($("#calendar").parent().height()-(xyCalendar.top+40))/(diffDays/7);
	        var cellHeight = cellWidth*1;
	        var tbody = table.createTBody();
	        while(startDate<endDate){
		        row = tbody.insertRow(-1);
				$.each(dayList, function (index,value) {
	                var cell = row.insertCell(-1);
	                $(cell).height(cellHeight);
	            	if (nowYYYYmd==startDate.getFullYear()+"-"+startDate.getMonth()+"-"+startDate.getDate()){
	                	cell.className += "bg-primary";            		
	            	}else{
		                if (startDate.getMonth()!=month){
		                	cell.className += "bg-gray";
		            	}            		
	            	}
	            	var thisStartDate = startDate.getFullYear()+"-"+("00"+(startDate.getMonth()+1)).substr(-2)+"-"+("00"+startDate.getDate()).substr(-2);
	        		var div = document.createElement("DIV");
		            $(div).css({textAlign: "center"});
				    $(div).css({fontSize: "18px"});
				    $(div).css({fontWeight: "bold"});
	        		div.innerHTML = startDate.getDate();
	        		$(div).css({cursor: "pointer"});
	        		$(div).click(function(){
	        			selectdate(thisStartDate);
				    	//showQOnlineDate(thisStartDate);	        			
	        		});
	        		cell.appendChild(div);
	                if (a_msg[thisStartDate]!=undefined){
	                	$.each(a_msg[thisStartDate],function(index,value){
	        				var div = document.createElement("DIV");
				            $(div).css({overflow: "hidden"});
				            $(div).css({textOverflow: "clip"});
				            $(div).css({textAlign: "left"});
						    $(div).css({fontSize: "14px"});
						    $(div).css({fontWeight: "normal"});
						    $(div).css({width: cellWidth+"px"});
						    $(div).css({maxWidth: cellWidth+"px"});
			        		$(div).css({cursor: "pointer"});
						    $(div).click(function(){
						    	//showQOnlineDateClinic(value['book_date'],value['depcode'],value['department']);
						    })

	        				var span = document.createElement("SPAN");
	        				span.className="badge bg-red";
	        				$(span).html(value['count_smartq']+"/"+value['count_hosxp']);

	        				var text=value['department'];
	        				div.appendChild(span);
	        				div.innerHTML+=" "+text;
	        				cell.appendChild(div);



	                	})

	                }
	                $(cell).css({fontSize: "16px"});
	                $(cell).css({height: cellHeight+"px"});
	                startDate.setDate(startDate.getDate()+1);
				});
	        }
	        var dvTable = document.getElementById("calendar");
	        dvTable.appendChild(table);
	    });

	}

	function selectdate(selectDate){
        $('#clinicSelect').empty();
        $('#timeSelect').empty();

		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var nowdate = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;

		appData['book_date'] = selectDate;
		if (appData['book_date']>nowdate){
			loadOnlineClinic(patData['cid'],appData['book_date']);
			$(".ptBookDate").html("<h4>วันที่นัด : "+dateFormat(appData['book_date'],"thaiLongDate")+"</h4>");
		}else{
			alert('ไม่สามารถเลื่อกวันนัดนี้ได้');
		}

	}


	function showAppoint(qonline_id,book_date,purpose){
        $.ajax({
            method: "POST",
            url: "../qonline/getQonline.php",
            data: { qonline_id: qonline_id, book_date: book_date }
        }).done(function (msg) {
        	var a_msg = jQuery.parseJSON(msg);
			$("#qonline_qonline_id").html(demoFormat('line_id',a_msg['qonline_id']));
			$("#qonline_line_id").html(demoFormat('line_id',a_msg['line_id']));
			$("#qonline_cid").html(demoFormat('cid',a_msg['cid']));
			$("#qonline_hn_barcode").html(a_msg['hn_barcode']);					
			$("#qonline_hn").html(a_msg['hn']);
			$("#qonline_name").html(a_msg['pname']+a_msg['fname']+' '+demoFormat('lname',a_msg['lname']));
			$("#qonline_birthdate").html(demoFormat('birthday',dateFormat(a_msg['birthdate'],"thaiLongDate")));
			$("#qonline_book_date").html(dateFormat(a_msg['book_date'],"thaiLongDate"));
			$("#qonline_book_clinic_name").html(a_msg['book_clinic_name']);
			$("#qonline_book_time").html(a_msg['time_start']+" - "+a_msg['time_end']);
			$("#qonline_book_note").html("โปรดมาแสดงตัวก่อนเวลานัด <?php echo $cnn['qonline_come_early']; ?> นาที หากมาสายเกิน <?php echo $cnn['qonline_come_late_limit']; ?> นาที จะถือว่าสละสิทธิ์");
			genQRCode(a_msg['qonline_id'],a_msg['book_date']);
			showOneBlock("registeredBlock");				
		});
	}

	function loadOnlineClinic(cid,dateSelect){
		$("#showDupQonline").hide();
		$.ajax({
			method: "POST",
			url: "../qonline/getOnlineSelfdepartment.php",
			data: {	
				cid: cid,
				dateSelect: dateSelect
			}
		}).done(function (msg) {
//console.log('getOnlineSelfdepartment.php');
//console.log(msg);
	        $('#clinicSelect').empty();
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);

            $.each( a_msg['data'], function( key, value ) {
		        var a=document.createElement('a');
				$(a).attr('href', '#');
				$(a).attr('qclinicconfig_code', value.qclinicconfig_code);
				$(a).attr('qclinicconfig_name', value.selfdepartmentname);
				var appointed="";
				if (value.time_start!=""){
					appointed="<br>นัดแล้ว เวลา "+value.time_start.substr(0,5)+" - "+value.time_end.substr(0,5)+" น.";
		        	a.setAttribute('class','list-group-item disabled');
		    	}else{
			        a.setAttribute('class','list-group-item');
				}
//				a.innerHTML=value.qclinicconfig_code+" : "+value.selfdepartmentname+appointed+" <span class='badge badge-light'>"+(value.max_limit-value.count_book)+"/"+value.max_limit+"</span>";
				a.innerHTML=value.selfdepartmentname+appointed+" <span class='badge badge-light'>"+(value.max_limit-value.count_book)+"/"+value.max_limit+"</span>";
				$(a).appendTo($('#clinicSelect'));
            });
            appData['time_table']=a_msg['time_table'];
            if (a_msg['data'].length>0){
				showOneBlock("clinicBlock");				
            }else{
				alert("ขออภัยค่ะ คลินิกของเราไม่ได้เปิดให้บริการในวันที่ท่านเลือกค่ะ");
			}			
        });
	}

	function loadOnlineTime(cid,time_table,qclinicconfig_code,dateSelect){
		$.ajax({
			method: "POST",
			url: "../qonline/getOnlineTime.php",
			data: {
				cid: cid,
				time_table: time_table,
				qclinicconfig_code: qclinicconfig_code,	
				dateSelect: dateSelect
			}
		}).done(function (msg) {
// console.log('getOnlineTime.php return');
// console.log(msg);
	        $('#timeSelect').empty();
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);
            $.each( a_msg, function( key, value ) {
		        var a=document.createElement('a');
				a.setAttribute('href', '#');
				a.setAttribute('time_id', value.time_id);
				a.setAttribute('time_start', value.time_start);
				a.setAttribute('time_end', value.time_end);
				a.setAttribute('balance_max_limit', value.balance_max_limit);
				var appointed="";
				if (value.book_clinic_name!=""){
					appointed="<br>นัดแล้ว แผนก"+value.book_clinic_name;
		        	a.setAttribute('class','list-group-item disabled');
		    	}else{
			        a.setAttribute('class','list-group-item');
				}
				a.innerHTML=value.time_start.substr(0,5)+" น. - "+value.time_end.substr(0,5)+" น. "+appointed+"<span class='badge badge-light'>"+(value.max_limit-value.balance_max_limit)+"/"+value.max_limit+"</span>";
				$(a).appendTo($('#timeSelect'));
            });
        });
	}

	function showOneBlock(blockName){
		$(".online-block").hide();
		$("#"+blockName).show();
	}

	function lineCheck(line_id){
		if (line_id){
			getCidRegister(line_id);
		}else{
			showOneBlock("hackerBlock");
		}
	}

	function getCidRegister(line_id){
		showOneBlock("loadingBlock");
		$.ajax({
			method: "POST",
			url: "../qonline/getCidRegister.php",
			data: {	line_id: line_id}
		}).done(function (msg) {
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);
			if (a_msg){
				regData=a_msg;
// console.log(a_msg);
				$("#regData_line_id").html(demoFormat('line_id',regData['line_id']));
				$("#regData_cid").html(demoFormat('cid',regData['cid']));
				$("#regData_hn").html(regData['hn']);
				$("#regData_name").html(regData['pname']+regData['fname']+" "+demoFormat('lname',regData['lname']));
				$("#regData_birthdate").html(demoFormat('birthday',dateFormat(regData['birthdate'],"thaiLongDate")));


				$("#selfSelect").attr('cid', regData['cid']);
				$("#selfSelect").attr('hn', regData['hn']);
				$("#selfSelect").attr('pname', regData['pname']);
				$("#selfSelect").attr('fname', regData['fname']);
				$("#selfSelect").attr('lname', regData['lname']);
				$("#selfSelect").attr('birthdate', regData['birthdate']);



				getHome(regData['cid']);
				getHistory(regData['line_id']);
				// showOneBlock("serviceSelectBlock");
				showOneBlock("selfScreenBlock");
			}else{
				showOneBlock("cidBlock");
			}
		});
	}

	function getHome(myCid){
		$.ajax({
			method: "POST",
			url: "../qonline/getHome.php",
			data: {	cid: myCid }
		}).done(function (msg) {
//console.log(msg);											
	        $('#homeSelect').empty();
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);
            $("#badgeHomePatientCount").html(a_msg.length);
            $.each( a_msg, function( key, value ) {
		        var a=document.createElement('a');
		        a.setAttribute('class','list-group-item');
				a.setAttribute('href', '#');
				a.setAttribute('cid', value.cid);
				a.setAttribute('hn', value.hn);
				a.setAttribute('pname', value.pname);
				a.setAttribute('fname', value.fname);
				a.setAttribute('lname', value.lname);
				a.setAttribute('birthdate', value.birthday);
				a.innerHTML=value.pname+value.fname+" "+demoFormat('lname',value.lname)+" "+demoFormat('birthday',dateFormat(value.birthday,"thaiShortDate"));
				a.onclick = function () {
					selectPatient($(this));
				};
				$(a).appendTo($('#homeSelect'));
            });
        });
	}

	function getHistory(myLineId){
		$.ajax({
			method: "POST",
			url: "../qonline/getOnlineHistory.php",
			data: {	line_id: myLineId }
		}).done(function (msg) {
//console.log(msg);											
	        $('#onlineHistoryPanel').empty();
            var a_msg = {};
            a_msg = jQuery.parseJSON(msg);
            $("#badgeOnlineCount").html(a_msg.length);
            $.each( a_msg, function( key, value ) {
		        var a=document.createElement('li');
		        var ptname=value.pname+value.fname+" "+demoFormat('lname',value.lname);
		        a.setAttribute('class','list-group-item');
				a.innerHTML=ptname+"<br>"+dateFormat(value.book_date,"thaiShortDate")+" "+value.time_start.substr(0,5)+" น.<br>"+value.book_clinic_name;
				a.onclick = function () {
					showAppoint(value.qonline_id,value.book_date,'show');
				};
				var b=document.createElement('span');
				b.setAttribute('class','badge');
				b.setAttribute('book_date', value.book_date);
				b.setAttribute('qonline_id', value.qonline_id);
				b.setAttribute('ptname', ptname);
				b.setAttribute('time_start', value.time_start);
				b.setAttribute('book_clinic_name', value.book_clinic_name);
				b.innerHTML="ยกเลิกนัด";
				b.onclick = function () {
					qOnlineCancel($(this));
				};

				$(b).appendTo(a);
				$(a).appendTo($('#onlineHistoryPanel'));
            });
        });
	}

	function qOnlineCancel(pt){
		//console.log(pt.attr("qonline_id"));
		bootbox.confirm({
		    message: "คุณต้องการยกเลิกนัดสำหรับ "+pt.attr("ptname")+"<br>วันที่ "+dateFormat(pt.attr("book_date"),"thaiShortDate")+" เวลา "+pt.attr("time_start").substr(0,5)+" น.<br>แผนก "+pt.attr("book_clinic_name")+" ใช่หรือไม่",
		    buttons: {
		        confirm: {
		            label: 'ตกลง',
		            className: 'btn-success'
		        },
		        cancel: {
		            label: 'ไม่',
		            className: 'btn-danger'
		        }
		    },
		    callback: function (result) {
		    	if (result){
					$.ajax({
						method: "POST",
						url: "../qonline/qOnlineCancel.php",
						data: {	
							book_date: pt.attr('book_date'),
							qonline_id: pt.attr('qonline_id')
						}
					}).done(function (msg) {
						location.reload();
					});
		    	}
		    }
		});
	}

	function selectPatient(pt){
		//console.log(pt);
		patData={};
		patData['line_id']=line_id;
		patData['cid']=pt.attr('cid');
		patData['hn']=pt.attr('hn');
		patData['pname']=pt.attr('pname');
		patData['fname']=pt.attr('fname');
		patData['lname']=pt.attr('lname');
		patData['birthdate']=pt.attr('birthdate');
		$(".ptName").html("<h4>ชื่อผู้ป่วย : "+patData['pname']+patData['fname']+" "+demoFormat('lname',patData['lname'])+"</h4>");
		showOneBlock("dateBlock");
	}

	function timeFormat(time,format){
		var time_return=time;
		switch (format){
			case "minute":
				time_return=time.substring(0,5);
				break;
			default :
				break;
		}
		return time_return;
	}

	function dateFormat(date,format){
		var a_date=date.split("-");
		var d=new Date(a_date[0],a_date[1]-1,a_date[2]);
		var date_return=date;
		var fullMonth = new Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		var shortMonth = new Array("ม.ค.","ก.พ.","มี.ค.","ม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		switch (format){
			case "thaiLongDate":
				date_return=d.getDate()+" "+fullMonth[d.getMonth()]+" "+(parseInt(a_date[0])+543);
				break;
			case "thaiShortDate":
				date_return=d.getDate()+" "+shortMonth[d.getMonth()]+" "+(parseInt(a_date[0])+543);
				break;
			default :
				break;
		}
		return date_return;
	}

	function genQRCode(q_text,vstdate){
		<?php
		$end_part=stristr($_SERVER[HTTP_REFERER],'/tv/');
		$qrcode_url=str_replace($end_part,'/qcheck/index.php',$_SERVER[HTTP_REFERER]);
		echo "var qrcode_url='".$qrcode_url."'".PHP_EOL;
		?>
		generateQrcode("qonline_qrcode",qrcode_url+"?q_text="+q_text+"&vstdate="+vstdate,128,128);
	}

</script>
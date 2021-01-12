<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>บันทึกข้อมูลสุขภาพ</title>
  </head>
  
  <body>
        <div class = "container">
          <h3>บันทึกข้อมูลสุขภาพ</h3>


    <form>
        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="inputState">คุณเป็นโรคเบาหวานใช่หรือไม่</label>
                <select id="inputState" class="form-control">
                <option selected></option>
                <option>ใช่</option>
                <option>ไม่ใช่</option>
                </select>
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="inputState">คุณเป็นโรคความดันโลหิตใช่หรือไม่</label>
                <select id="inputState" class="form-control">
                <option selected></option>
                <option>ใช่</option>
                <option>ไม่ใช่</option>
                </select>
           </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">ส่วนสูง(เซ็นติเมตร)</label>
                <input type="height" class="form-control" id="inputEmail4">
            </div>
        
            <div class="form-group col-md-6">
                <label for="inputEmail4">น้ำหนัก(กิโลกรัม)</label>
                <input type="weight" class="form-control" id="inputEmail4">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputPassword4">รอบเอว(เซ็นติเมตร)</label>
                <input type="waist" class="form-control" id="inputPassword4">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-6 ">
                <label for="inputEmail4">ความดันโลหิต(ค่าบน)</label>
                <input type="on" class="form-control" id="inputEmail4">
            </div>

            <div class="form-group col-6 ">
                <label for="inputPassword4">ความดันโลหิต(ค่าล่าง)</label>
                <input type="lower" class="form-control" id="inputPassword4">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputPassword4">น้ำตาลในเลือด</label>
                <input type="sugar" class="form-control" id="inputPassword4">
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="inputState">สูบบุหรี่</label>
                <select id="inputState" class="form-control">
                <option selected></option>
                <option>สูบ</option>
                <option>ไม่สูบ</option>
                </select>
            </div>
        </div>

        <div class="form-row">   
            <div class="form-group col-md-12">
                <label for="inputState">ดื่มสุรา</label>
                <select id="inputState" class="form-control">
                <option selected></option>
                <option>ดื่ม</option>
                <option>ไม่ดื่ม</option>
                <option>ดื่มบ้างบางโอกาส</option>
                </select>
            </div>
        </div>
  
            <center>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <button type="submit" class="btn btn-primary">ยกเลิก</button>
            </center>
    </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">ลงทะเบียน</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">เลขบัตรประจำตัวประชาชน</label>
                                    <input class="input--style-4" type="text" name="numId">
                                </div>
                            </div>
                        </div> 
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ชื่อ</label>
                                    <input class="input--style-4" type="text" name="firstName">
                                </div>
                            </div>
                       
                             <div class="col-2">
                                <div class="input-group">
                                    <label class="label">นามสกุล</label>
                                    <input class="input--style-4" type="text" name="lastName">
                                </div>
                            </div>
                        
                            <div class="col-2"
                                <div class="input-group">
                                    <label class="label">เบอร์โทรศัพท์</label>
                                    <input class="input--style-4" type="text" name="phone">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ที่อยู่</label>
                                    <input class="input--style-4" type="text" name="address">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">จังหวัด</label>
                                    <input class="input--style-4" type="text" name="province">
                                </div>
                            </div> <div class="col-2">
                                <div class="input-group">
                                    <label class="label">อำเภอ</label>
                                    <input class="input--style-4" type="text" name="district">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ตำบล</label>
                                    <input class="input--style-4" type="text" name="subDistrict">
                                </div>
                            </div>

                            <div class="input-group">
                            <label class="label">ชื่อหน่วยงาน</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="agency">
                                    <option disabled="disabled" selected="selected"> </option>
                                    <option>หน่วยงาน A</option>
                                    <option>หน่วยงาน B</option>
                                    <option>หน่วยงาน C</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                            </div>  
                            <div class="input-group">
                            <label class="label">ชื่อแผนก</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="department">
                                    <option disabled="disabled" selected="selected"> </option>
                                    <option>แผนก A</option>
                                    <option>แผนก B</option>
                                    <option>แผนก C</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                            </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">น้ำหนัก</label>
                                    <input class="input--style-4" type="email" name="weight">
                                </div>
                            </div>
                        
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ส่วนสูง</label>
                                    <input class="input--style-4" type="text" name="height">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email">
                                </div>
                            </div>
                        </div>

                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="cancel">ยกเลิก</button>
                            <button class="btn btn--radius-2 btn--blue" type="next">ถัดไป</button>   
                            
                            
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

</head>
<body>

    <div class="container">
        <h1>A demo of Bootstrap validate form</h1>
    </div>
    <!-- don't forget novalidate to stop browser form validation -->
    <form class="form">
    <div class="container">
        <div class="row">
            <div class='col-sm-4 form-group'>
                <label for="name">Your Name:</label>
                <input id="lname" class="form-control" min="3" required type="text" data-error-msg="Must enter your name?">
            </div>
                    
        <div class="form">
            <div class="col-sm-4 form-group">
                <label for="waist">รอบเอว(เซ็นติเมตร)</label>
                <input  class="form-control"   required type="text" data-error-msg="กรุณากรอกข้อมูล!">
            </div>
        </div>
            <div class='col-sm-4 form-group'>
                <label for="name">Email:</label>
                <input id="email" class="form-control" type="email" required data-error-msg="The email is required in valid format!">
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-4 form-group'>
                <label for='address'>Address: (optional)</label>
                <input id='address' class='form-control' type='text'>
            </div>
        </div>
        <div class="row">
            <div class='col-sm-4 form-group'>
                <label for='terms'>Agree with T&Cs?</label>
                <select id='terms' class='form-control' required>
                    <option selected disabled>Select </option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </div>
            <div class='col-sm-4 form-group'>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="option1" value="" required data-error-msg="You have to select one expertise.">
                        HTML
                    </label>
                </div>
                <div class="checkbox disabled">
                    <label>
                        <input type="checkbox" name="option1" value="">
                        CSS
                    </label>
                </div>
            </div>
            <div class='col-sm-4 form-group'>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                        Python
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        Java
                    </label>
                </div>
                <div class="radio disabled">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                        SQL
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <button type="submit" class="btn btn-danger btn-block">Proceed</button>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-validate.js"></script>
    <script>
    $(function() {
        console.log($('form'));
        $('form').validator({
            validHandlers: {
                '.customhandler':function(input) {
                    //may do some formatting before validating
                    input.val(input.val().toUpperCase());
                    //return true if valid
                    return input.val() === 'JQUERY' ? true : false;
                }
            }
        });

        $('form').submit(function(e) {
            e.preventDefault();

            if ($('form').validator('check') < 1) {
                alert('Hurray, your information will be saved!');
            }
        })
    })
    </script>
</body>

</html>


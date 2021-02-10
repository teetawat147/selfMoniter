<?php
include("../include/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminHealthAmpru</title>
</head>
    <body>
        <br>
        <center><h1>AdminHealthAmpur<h1></center>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <?php
        $sql ="select * from office WHERE ampur_code = '09'";
        $result = $conn->prepare($sql);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        ?> 
        
        <div class = "container">
            <?php
            foreach ($rows as $key => $row) {
                ?>  
                <div class="row" margin-top  >
                    <div class="col">
                        <img class="mr-3" src="../images/<?php echo $row['office_type'];?>.png" style="width: 150px;" >
                    </div>
                    <div class="col-6">
                        <div class="row">

                            <div class="col-12 col-md-6">
                                <?php
                                echo $row['office_name'];
                                ?>
                            </div>
                            <div class="col-12 col-md-6">
                                จำนวนสมาชิก  
                                <?php
                                echo $row['persons'];
                                ?>
                                คน
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        3 of 3
                    </div>
                </div>
                <?php
            }
            ?>   
        </div>
    </body>
</html>


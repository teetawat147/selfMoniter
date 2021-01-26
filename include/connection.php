<?php
if (!isset($_SESSION)){
    session_start();
}
$db_host = '159.138.241.143';
$db_name = 'selfmoniter';
$db_user = 'selfmoniter';
$db_pass = '123456';

// connect
try {
    // If you change db server system, change this too!
    $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
    // echo "Connected to database";
    $sql = "SET NAMES utf8"; 
    $result = $conn->prepare($sql);
    $result->execute();  
}
catch (PDOException $e) {
    echo $e->getMessage();
}



// $datetime = date("Y-m-d H:i:s");
// $sql ="INSERT into office (officeName, personId, inputDatetime) value ('รพ.สว่างแดนดิน', 1, '$datetime')";
// $result = $conn->prepare($sql);
// $result->execute();

// $sql="SELECT * FROM office";
// $result = $conn->prepare($sql);
// $result->execute();

// if ($result !== false) {
//     echo 'Found ' . $result->rowCount() . " application(s).<br>" ;

//     while($row = $result->fetch()) {
//         echo '- ' . $row['officeName'] . ' was released on ' . $row['personId'] . "<br>";
//     }
// }
?>
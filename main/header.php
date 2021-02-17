<?php
  include('../include/connection.php');
  // print_r($_SESSION);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../main/index.php">Self Monitor</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../main/healthScreen.php">ข้อมูลสุขภาพ</a>
      </li>
      
      <?php   
      if (($_SESSION['groupId']=="1" or $_SESSION['groupId']=="2" or $_SESSION['groupId']=="3" )){
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ระบบแอดมิน
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php   
              if (($_SESSION['groupId']=="1")){
                ?>
                <a class="dropdown-item" href="../main/bmiGet.php">ระดับ BMI</a>
                <a class="dropdown-item" href="../main/cvdScoreGet.php">ระดับ CVD risk</a>
                <a class="dropdown-item" href="../main/waistGet.php">ระดับ รอบเอว</a>
                <a class="dropdown-item" href="../main/bpGet.php">ระดับ BP</a>
                <a class="dropdown-item" href="../main/dmGet.php">ระดับ DM</a>
                <a class="dropdown-item" href="../main/smokeGet.php">ระดับ การสูบบุหรี่</a>
                <a class="dropdown-item" href="../main/alcoholGet.php">ระดับ การดื่มสุรา</a>
                <?php
              }
              ?>
              <a class="dropdown-item" href="../main/personGet.php">ผู้ใช้งาน</a>
          </div>
        </li>
        <?php
      }
      ?>

    </ul>
    


    <?php
    if ($_SESSION['fname']){
      
    
    ?>
    <span class="navbar-text">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
      echo $_SESSION['fname'].' '.$_SESSION['lname'];
      ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../main/editProfile.php">Edit Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" onclick="remove()" href="../main/logout.php">Logout</a>
        </div>
      </li>
    </ul>
    </span>
    <?php
    }
    ?>
  </div>
</nav>
<script>
  function remove() {
  //sessionStorage.clear();
  // localStorage.removeItem(key);
  window.localStorage.clear(); 
}
</script>
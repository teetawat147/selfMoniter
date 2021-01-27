<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
      nav
      {
       background: #7568EF;
      }
      
      .nav-icon
      {
        position: absolute;  
        right: 0;  
        top: 0;
      }

      img
      {
        width: 20px;
        height: 20px;
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-list" id="navbarTogglerDemo03">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active text-white" aria-current="page" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">รายงานภาพรวม</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">รายงานBMI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">รายงานBMI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">รายงานการกรอกข้อมูลของบุคลากร</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">ติดต่อเรา</a>
        </li>
      </ul>
    </div>

    <div class="d-flex justify-content-end nav-icon">
        <a class="navbar-brand" href="#">
          <img src="../images/icon-search.svg">
        </a>
        <a class="navbar-brand" href="#">
          <img src = "../images/icon-notification.svg"/>
=======
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar w/ text</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
>>>>>>> 51edde31aacd312e1d26b29205281bc761c62001
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
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
          <a class="dropdown-item" href="#">Edit Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../main/logout.php">Logout</a>
        </div>
      </li>
    </ul>
    </span>
    <?php
    }
    ?>
  </div>
</nav>
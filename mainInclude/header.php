<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.minified.css">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Student Testimonial Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/owl.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/testyslider.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Digi LMS</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark pl-5 fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-lg-5 fs-4" href="#">Digi LMS</a>
    <button class="navbar-toggler" type="button" onclick="addBg()" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="courses.php">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paymentstatus.php">Payment Status</a>
        </li>
        <?php 
              session_start();   
              if (isset($_SESSION['is_login'])){
                echo '<li class="nav-item"><a href="student/studentProfile.php" class="nav-link">My Profile</a></li> <li class="nav-item "><a href="logout.php" class="nav-link">Logout</a></li>';
              } else {
                echo '<li class="nav-item"><a href="#login" class="nav-link" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter">Login</a></li> <li class="nav-item"><a href="#signup" class="nav-link" data-bs-toggle="modal" data-bs-target="#stuRegModalCenter">Signup</a></li>';
              }
          ?>
          <li class="nav-item">
          <a class="nav-link" href="#">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav> 
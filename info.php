<?php
session_start();
require_once("connection.php");


$stud_email = $_SESSION["email"];
$stud_Id =  $_SESSION["id"];



if(isset($_SESSION['student_final']) ) {
  header('Location: studentDash.php');
  exit();
}



$basic_query = "SELECT * FROM basic_info inner join students ON basic_info.application_id=students.student_id WHERE basic_info.application_id='$stud_Id'";
$basic_result=mysqli_query($conn,$basic_query);

if(isset($basic_result)){
  $student = mysqli_fetch_assoc($basic_result);
  $image = isset($student['image'])? $student['image'] : "";
         $imageSrc = '.'  . '/' . $image;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home </title>
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <style>
    .welcome h1 {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #202020;
      z-index: -1;
      width: 100%;
      text-align: center;
      font-size: 80px;
    }
  </style>

  <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">
</head>

<body>

  
<div class="wrapper">


<nav id="sidebar" aria-label="side">
  <div class="title">
    <div class="col-md-6 mb-4">
    <?php if(isset($student['image'])){
         
         echo "<img class='rounded-circle z-depth-2' style='width:210%' src=' $imageSrc' />";
       }
       else{
         echo "<img class='rounded-circle z-depth-2' alt='100x100' style='width:210%' src='https://bootdey.com/img/Content/avatar/avatar3.png' data-holder-rendered='true'>";
       }
       ?>

    </div>
    <h2>
    <?php 
    

    if ($student) {
      echo  "" . $student['first_name'] . " " . $student['last_name'];
    } else {
      echo "Student";
 }

?>
    </h2>
  </div>
      <ul class="list-items">
        <li><a href="/ashweb20-team-team-e/basic.php?email=<?php echo $stud_email ?>">Basic Information</a></li>
        <li><a href="/ashweb20-team-team-e/education.php">Education</a></li>
        <li><a href="/ashweb20-team-team-e/course.php">Course</a></li>
        <li><a href="/ashweb20-team-team-e/application_review.php">Final Review</a></li>
        <li><a href="/ashweb20-team-team-e/logout.php">Sign Out</a></li>

      </ul>
    </nav>
  </div>



  <div class="welcome">
    <h1>
      <?php
    

        if (isset($student)) {
       

          echo "Welcome,". $student['first_name'];
        } else {
          echo "Welcome,Student";
        }
    
      ?>
    </h1>
  </div>
  </div>
  <?php if (isset($_GET['message'])) : ?>
    <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
  <?php endif; ?>
  <script>
    const flashdata = $(".flash-data").data("flashdata");

    if (flashdata) {
      Swal.fire({
        icon: "success",
        title: "Information saved!",
        text: "Kindly move to the next required details",
        allowOutsideClick: false,
        allowEscapeKey: false,
        footer: "<a href=course.php>Click here!</a>",
        type: "success",
      }).then(function() {
        window.location.href = "course.php";
      });
    }
  </script>
</body>

</html>
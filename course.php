<?php
session_start();

require_once("connection.php");

$stud_email = $_SESSION["email"];
$id = $_SESSION['id'];

if (isset($_GET['error'])) {
  $err_msg = "We're sorry an error occurred";
}


$course_query = "SELECT * FROM `course_info` inner join students ON course_info.student_id=students.student_id WHERE course_info.student_id='$id'";
$course_result = mysqli_query($conn, $course_query);

$m = mysqli_fetch_assoc($course_result);


$basic_query = "SELECT * FROM basic_info inner join students ON basic_info.application_id=students.student_id WHERE basic_info.application_id='$id'";
$basic_result=mysqli_query($conn,$basic_query);

if(isset($basic_result)){
  $student = mysqli_fetch_assoc($basic_result);
  $image = isset($student['image'])? $student['image'] : "";
         $imageSrc = $image;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Course</title>
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .welcome {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #202020;
      width: 50%;
      font-size: 20px;
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
        <li><a href="/ashweb20-team-team-e/logout.php">Sign Out</a></li><br />
        <li><a href="/ashweb20-team-team-e/reset-password-student.php">Reset Password</a></li>

      </ul>
    </nav>
  </div>

  <div class="welcome">

    <div style="text-align:center;">
      <h1>Fill out all fields</h1>
      <h2>Save the work when done</h2>
    </div>
    <?php
    if (isset($err_msg)) {
      echo '<div class="alert alert-danger">' .
        $err_msg
        . '</div>';
    }

    ?>
    <form class="form-group" action="course_info.php" method="POST" onsubmit="return trans_det()">

      <div class="form-group">
        <label class="my-1 mr-2" for="course">Course</label><br>
        <select class="custom-select my-1 mr-sm-2" name="Courses" id="course">
          <option selected><?php if (isset($m['course'])) {
                              echo $m['course'];
                            } else {
                              echo "Choose...";
                            } ?></option>
          <option value="General Science">General Science</option>
          <option value="General Arts">General Arts</option>
          <option value="Home Economics">Home Economics</option>
          <option value="Visual Arts">Visual Arts</option>
        </select>
      </div>


      <div class="form-group">
        <label class="my-1 mr-2" for="subject">Core Subject</label><br>
        <select class="custom-select my-1 mr-sm-2" name="Subjects" id="subject" required>
          <option selected><?php if (isset($m['core'])) {
                              echo $m['core'];
                            } else {
                              echo "Choose...";
                            }  ?></option>
          <option value="English,Integrated-Science,Social Studies,Core-Mathematics ">English,Integrated Science, Social Studies,Core Mathematics</option>
        </select>
      </div>


      <div class="form-group">
        <label class="my-1 mr-2" for="elective">Elective Subjects</label><br>
        <select class="custom-select my-1 mr-sm-2" name="Elective" id="elective">

          <option selected><?php if (isset($m['elective'])) {
                              echo $m['elective'];
                            } else {
                              echo "Choose...";
                            }  ?></option>
          <option value="Economics,French,Government,History">Economics,French,Goverment,History</option>
          <option value="Economics,French,Government,Elective Mathematics"> Economics,French,Goverment,Elective Mathematics</option>
          <option value="Economics,History,Government,Music">Economics,History,Goverment,Music</option>
          <option value="Biology,Chemistry,Physics,Elective-Mathematics">Biology,Chemistry,Physics,Elective Mathematics</option>
          <option value="Geography,Chemistry,Physics,Elective-Mathematics">Geography,Chemistry,Physics,Elective Mathematics</option>
          <option value='Ceramics,Woodwork,Graphic Designing'>Ceramics,Woodwork,Graphic Designing</option>
          <option value='Food and Nutrition,Biology'>Food and Nutrition,Biology</option>
     
      </select>

  </div>

  <div>
    <button type="submit" name='submit' class="btn btn-primary btn-lg" onclick="trans_det()">SAVE</button>
  </div>
  </form>
  <script type="text/javascript" src="/ashweb20-team-team-e/js/app.js"></script>
  </div>
  </div>
  <?php if (isset($_GET['success'])) : ?>
    <div class='flash-data' data-flashdata="<? $_GET['success'];?>"></div>
  <?php endif; ?>
  <script>
    const flashdata = $(".flash-data").data("flashdata");

    if (flashdata) {
      Swal.fire({
        icon: "success",
        title: "Information saved!",
        text: "Kindly move to preview your details",
        allowOutsideClick: false,
        allowEscapeKey: false,
        type: "success",
      }).then(function() {
        window.location.href = "application_review.php";
      });
    }
  </script>
</body>

</html>
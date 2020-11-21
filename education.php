<?php

session_start();
require_once("connection.php");

$stud_email = $_SESSION["email"] != null ? $_SESSION["email"] : "";
$id = $_SESSION['id'] != null ? $_SESSION['id'] : "";

if (isset($_GET['error'])) {
  if ($_GET['error'] == 'wrongFile') {
    $err_msg = "Your file extension must be .zip, .pdf or .docx or file too big";
    $nClass = $_GET['JHS'];
    $nCourse = $_GET['course'];
    $nExtra = $_GET['extra'];
    $nResult = $_GET['result'];

  } else {
    $err_msg = "We're sorry an error occurred";
    $nClass = $_GET['JHS'];
    $nCourse = $_GET['course'];
    $nExtra = $_GET['extra'];
    $nResult = $_GET['result'];
  }
}

$edu_query = "SELECT * FROM `education_info` inner join students ON education_info.student_id=students.student_id WHERE education_info.student_id='$id'";
$edu_result = mysqli_query($conn, $edu_query);
$n = mysqli_fetch_assoc($edu_result);



$basic_query = "SELECT * FROM basic_info inner join students ON basic_info.application_id=students.student_id WHERE basic_info.application_id='$id'";
$basic_result = mysqli_query($conn, $basic_query);

if (isset($basic_result)) {
  $student = mysqli_fetch_assoc($basic_result);
  $image = isset($student['image']) ? $student['image'] : "";
  $imageSrc = $image;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Education</title>
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
  <style>
    .welcome {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #202020;
      width: 50%;
      font-size: 20px;

    }

    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
      color: #468847;
      background-color: #DFF0D8;
      border: 1px solid #D6E9C6;
    }

    input.parsley-error,
    select.parsley-error,
    textarea.parsley-error {
      color: #B94A48;
      background-color: #F2DEDE;
      border: 1px solid #EED3D7;
    }

    .parsley-errors-list {
      margin: 2px 0 3px;
      padding: 0;
      list-style-type: none;
      font-size: 0.9em;
      line-height: 0.9em;
      opacity: 0;
      color: #B94A48;

      transition: all .3s ease-in;
      -o-transition: all .3s ease-in;
      -moz-transition: all .3s ease-in;
      -webkit-transition: all .3s ease-in;
    }

    .parsley-errors-list.filled {
      opacity: 1;
    }
  </style>

  <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">
</head>

<body>

  <div class="wrapper">


    <nav id="sidebar" aria-label="side">
      <div class="title">
        <div class="col-md-6 mb-4">
          <?php if (isset($student)) {

            echo "<img class='rounded-circle z-depth-2' style='width:210%' src=' $imageSrc' />";
          } else {
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
    <div style="text-align:center">
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
    <form class="form-group" method="POST" enctype="multipart/form-data" action='edu_info.php' data-parsley-validate>

      <div class="form-group">
        <label for="jhs">Junior High School</label>
        <input type="text" class="form-control " id="jhs" name="JHS" placeholder="JHS" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup" required value="<?php if (isset($n['Junior_High'])) { echo $n['Junior_High'];}elseif(isset($nClass)) {echo $nClass;}?>">
      </div>
      <div class="form-group">
        <label for="courses">Number of Courses</label>
        <input type="number" class="form-control" id="courses" name="Course" placeholder="Courses" data-parsley-type="number" data-parsley-trigger="keyup" value="<?php if (isset($n['course'])) {
                                                                                                                                                                    echo $n['course'];
                                                                                                                                                                  } elseif(isset($nCourse)){ echo $nCourse;} ?>" required>

      </div>


      <div class="form-group">
        <label for="extra">Extracurricular Activities</label><br>
        <input type="text" class="form-control" placeholder="Enter activity" name="Extra" id="extra" data-parsley-pattern="^[a-zA-Z, ]+$" data-parsley-trigger="keyup" value="<?php if (isset($n['Extra_Activity'])) {
                                                                                                                                                                                echo $n['Extra_Activity'];
                                                                                                                                                                              }elseif(isset($nExtra)) { echo $nExtra;} ?>" required>
      </div>


      <div class="form-group">
        <label class="my-1 mr-2" for="results">Results</label><br>
        <select class="form-control" name="Results" id="results">
          <option selected>Choose...</option>
          <option value="I am awaiting my results" <?= (isset($n['Results']) == 'I am awaiting my results') ? 'selected' : "" ?>>I am awaiting my results</option>
          <option value="I have my results" <?= (isset($n['Results']) == 'I have my results') ? 'selected' : "" ?>>I have my results</option>
        </select>

        <br />
        <br />
        <!-- <label for="otherField1">Upload your results</label> -->
        <div class='form-control' id="myResults">
          <fieldset>
          <legend>Upload your certificate</legend>
            <input class="form-control w-100" name='myResults'  placeholder="Upload Result">
          </fieldset>
        </div>
      </div>
      <br />
      <div>
        <button type="submit" name='submit' class="btn btn-primary btn-lg">SAVE</button>
      </div>



      <script type="text/javascript" src="ashweb20-team-team-e/js/app.js"></script>
    </form>
  </div>
  <?php if (isset($_GET['success'])) : ?>
    <div class='flash-data' data-flashdata="<? $_GET['success'];?>"></div>
  <?php endif; ?>
  </div>
  <script>
    $(document).ready(function() {
      $('#myResults').hide();
      $('#results').on('click', () => {
        const result = document.getElementById('results').value;
        if (result == "I have my results") {
          $('#myResults').show();
          $('#myResults input').prop('type','file');
        } else{
          $('#myResults').hide();
          
        }
      });

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

    })
  </script>

</body>

</html>
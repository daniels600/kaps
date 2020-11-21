<?php
session_start();

require_once("connection.php");

if (isset($_SESSION["email"]) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
  $getEmail = $_SESSION["email"];
  $getID = $_SESSION["id"];


  $status_query="SELECT STATUS from students where student_id=$getID";
  $staus_result=mysqli_query($conn,$status_query);
  $row=mysqli_fetch_assoc($staus_result);

  $basic_query = "SELECT * FROM basic_info inner join students ON basic_info.email=students.Email WHERE basic_info.email='$getEmail'";

  $edu_query = "SELECT * FROM education_info inner join students ON education_info.student_id=students.student_id WHERE education_info.student_id='$getID'";

  $course_query = "SELECT * FROM course_info inner join students ON course_info.student_id=students.student_id WHERE course_info.student_id='$getID'";


  $basic_result = mysqli_query($conn, $basic_query);
  $edu_result = mysqli_query($conn, $edu_query);
  $course_result = mysqli_query($conn, $course_query);


  if (isset($basic_result)) {
    $student = mysqli_fetch_assoc($basic_result);
    $fname = isset($student['first_name'])? $student['first_name'] : "" ;
    $lname =  isset($student['last_name'])? $student['last_name'] : "";
    $dob =  isset($student['dob']) ? $student['dob'] : "" ;
    $gender =  isset($student['gender']) ? $student['gender'] : "";
    $Email = isset($student['email'])? $student['email'] : "";
    $phone = isset($student['phoneNumber'])? $student['phoneNumber'] : "";
    $image = isset($student['image'])? $student['image'] : "";
    $imageSrc = $image;
    $stu_id = $getID;
  }


  if (isset($edu_result)) {
    $n = mysqli_fetch_assoc($edu_result);
    $class = isset($n['Junior_High'])? $n['Junior_High']:"";
    $num_course = isset($n["Offered_Course"])? $n["Offered_Course"] : "";
    $extra = isset($n["Extra_Activity"])? $n["Extra_Activity"] : "";
    $stu_results = isset($n["Results"])? $n["Results"] : "";
  }


  if (isset($course_result)) {
    $m = mysqli_fetch_assoc($course_result);
    $course = isset($m["course"])? $m["course"] : "";
    $core = isset($m["core"])? $m["core"] : "";
    $elective = isset($m["elective"])? $m["elective"]:"";
  }
}

if (isset($_POST['update'])) {
  $studentId = mysqli_real_escape_string($conn, $stu_id);
  $fname = mysqli_escape_string($conn, $_POST["First"]);
  $lname = mysqli_escape_string($conn, $_POST["Last"]);
  $dob = mysqli_escape_string($conn, $_POST["Birth"]);
  $gender = mysqli_escape_string($conn, $_POST["Gender"]);
  $mail = mysqli_escape_string($conn, $_POST["Mail"]);
  $phone = mysqli_escape_string($conn, $_POST["Phone"]);

  // $course_num = mysqli_real_escape_string($conn, $_POST['courses']);
  $course = mysqli_real_escape_string($conn, $_POST["main_course"]);
  $core = mysqli_real_escape_string($conn, $_POST["core"]);
  $elective = mysqli_real_escape_string($conn, $_POST["Elective"]);


  $class = mysqli_real_escape_string($conn, $_POST["JHS"]);
  $Offered_course = mysqli_real_escape_string($conn, $_POST["offered_courses"]);
  $extra = mysqli_real_escape_string($conn, $_POST["extra"]);
  $results = mysqli_real_escape_string($conn, $_POST["Results"]);

  $updateBasic = mysqli_query($conn, "UPDATE basic_info SET first_name='$fname', last_name=' $lname', dob ='$dob', gender= '$gender',email='$mail',phoneNumber ='$phone' WHERE student_id = $studentId");

  $updateCourse = mysqli_query($conn, "UPDATE course_info SET course='$course', core='$core', elective='$elective' WHERE student_id = $studentId");


  $updateEdu = mysqli_query($conn, "UPDATE education_info SET Junior_High='$class', Offered_Course='$Offered_course',Extra_Activity='$extra', Results='$results' WHERE student_id = $studentId");



  if ($updateBasic && $updateCourse &&  $updateEdu) {
    header('Location: application_review.php?update=success');
  }
}


if (isset($_POST['final_submit'])) {
  $_SESSION['student_final'] = $getID;

  header('Location: student_review.php?message=finalSubmit');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Review</title>
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>


  <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">
  <link rel="stylesheet" href="/ashweb20-team-team-e/css/admin.css">

  <style>
    .welcome {
      margin-top: 28%;
      position: absolute;
      top: 60%;
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
</head>

<body>
  <div class="wrapper">


    
  <div class="wrapper">


<nav id="sidebar" aria-label="side">
  <div class="title">
    <div class="col-md-6 mb-4">
      
      <img class="rounded-circle z-depth-2" style="width:210%" src="<?php echo $imageSrc; ?>" />

    </div>
    <h2>
      <?php 
      if ($_SESSION["loggedin"]) {
        $mail = $_SESSION["id"];
        require_once("connection.php");
        $sql = "SELECT * FROM `basic_info` inner join students ON basic_info.email=students.Email WHERE basic_info.application_id='$mail'";
        $results = mysqli_query($conn, $sql);


        if ($results) {
          if ($row = mysqli_fetch_assoc($results)) {
            echo  "" . $row['first_name'] . " " . $row['last_name'];
          } else {
            echo "Student";
          }
        } else {
          echo "Student";
        }
      }
      ?>
    </h2>
  </div>
      <ul class="list-items">
      <li><a href="/ashweb20-team-team-e/basic.php?email=<?php echo $getEmail ?>">Basic Information</a></li>
        <li><a href="/ashweb20-team-team-e/education.php">Education</a></li>
        <li><a href="/ashweb20-team-team-e/course.php">Course</a></li>
        <li><a href="/ashweb20-team-team-e/application_review.php">Final Review</a></li>
        <li><a href="/ashweb20-team-team-e/logout.php">Sign Out</a></li><br/>
        <li><a href="/ashweb20-team-team-e/reset-password-student.php">Reset Password</a></li>
      </ul>
    </nav>
  </div>



  <div class="welcome">

  
  <div class="alert alert-danger">
    <strong>Disclaimer!</strong> Submitting this form will not give you access to edit the application. Review your application thoroughly
  </div>

  <div class="alert alert-success">
  <p>STATUS: <?php if(isset($row["STATUS"])) {echo $row["STATUS"];} ?></p>
  </div>
    
    <form class="form-group" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" class="form-control " id="fname" name="First" placeholder="First Name" value="<?php echo $fname; ?>" required>
      </div>
      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname" name="Last" placeholder="Last Name" value="<?php echo $lname; ?>" required>

      </div>


      <div class="form-group">
        <label for="dob">Date of Birth</label><br>
        <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="Birth" id="dob" value="<?php echo  $dob; ?>" required>
      </div>


      <div class="form-group">
        <label for="gender">Gender</label>
        <select class="custom-select my-1 mr-sm-2" name="Gender" id="gender" required>
          <option selected>
          <?php if($gender){echo $gender;}else{ echo "Choose....."; }?>
          </option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        

      </div>

      <div class="form-group">
        <label for="mail">Email</label><br>
        <input type="email" class="form-control" placeholder="Email" name="Mail" id="mail" value="<?php echo  $Email; ?>" required>
      </div>


      <div class="form-group">
        <label for="phone">Phone Number</label><br>
        <input type="tel" class="form-control" placeholder="Phone Number" name="Phone" id="phone" maxlength=10 value="<?php echo  $phone; ?>" required>
      </div>


      <div class="form-group">
        <label for="jhs">JHS School</label><br>
        <input type="text" class="form-control" placeholder="JHS" name="JHS" id="jhs" value="<?php echo  $class; ?>" required>
      </div>


      <div class="form-group">
        <label for="courses">Number of Courses</label><br>
        <input type="text" class="form-control" placeholder="Course" name="offered_courses" id="courses" value="<?php echo  $num_course; ?>">
      </div>


      <div class="form-group">
        <label for="activity">ExtraCurricular Activities</label><br>
        <input type="text" class="form-control" placeholder="extra" name="extra" id="extra" value="<?php echo $extra ?>">
      </div>


      <div class="form-group">
        <label class="my-1 mr-2" for="results">Results</label><br>
        <select class="custom-select my-1 mr-sm-2" name="Results" id="results">
          <option selected>Choose...</option>
          <option value="I am awaiting my results" <?= ($stu_results == 'I am awaiting my results') ? 'selected' : "" ?>>I am awaiting my results</option>
          <option value="I have my results" <?= ($stu_results == 'I have my results') ? 'selected' : "" ?>>I have my results</option>
        </select>
      </div>


      <div class="form-group">
        <label for="course">Main Course</label><br>
        <select class="custom-select my-1 mr-sm-2" name="main_course" id="course">
          <option selected>Choose ...</option>
          <option value="General Science" <?= ($course == 'General Science') ? 'selected' : "" ?>>General Science</option>
          <option value="General Arts" <?= ($course == 'General Arts') ? 'selected' : "" ?>>General Arts</option>
          <option value="Home Economics" <?= ($course == 'Home Economics') ? 'selected' : "" ?>>Home Economics</option>
          <option value="Visual Arts" <?= ($course == 'Visual Arts') ? 'selected' : "" ?>>Visual Arts</option>
          </select>
      </div>

      <div class="form-group">
        <label for="core">Core Course</label><br>
        <input type="text" class="form-control" placeholder="core" name="core" id="core" value="<?php echo $core ?>" required>
      </div>


      <div class="form-group">
      <label class="my-1 mr-2" for="elective">Elective Subjects</label><br>
        <select class="custom-select my-1 mr-sm-2" name="Elective" id="elective">
            <option>Choose ... </option>
            <option value="Economics,French,Government,History"  <?= ($elective== 'Economics,French,Government,History') ? 'selected' : "" ?>>Economics,French,Government,History</option>
            <option value="Economics,French,Government,Elective Mathematics" <?= ($elective== 'Economics,French,Government,Elective Mathematics') ? 'selected' : "" ?>> Economics,French,Government,Elective Mathematics</option>
            <option value="Economics,History,Government,Music" <?= ($elective== 'Economics,History,Government,Music') ? 'selected' : "" ?>>Economics,History,Government,Music</option>
            <option value="Biology,Chemistry,Physics,Elective Mathematics" <?= ($elective== 'Biology,Chemistry,Physics,Elective Mathematics') ? 'selected' : "" ?>>Biology,Chemistry,Physics,Elective Mathematics</option>
            <option value="Geography,Chemistry,Physics,Elective Mathematics" <?= ($elective== 'Geography,Chemistry,Physics,Elective Mathematics') ? 'selected' : "" ?>>Geography,Chemistry,Physics,Elective Mathematics</option>
            <option value="Ceramics,Woodwork,Graphic Designing" <?= ($elective== 'Ceramics,Woodwork,Graphic Designing') ? 'selected' : "" ?>>Ceramics,Woodwork,Graphic Designing</option>
            <option value="Food and Nutrition,Biology" <?= ($elective== 'Food and Nutrition,Biology') ? 'selected' : "" ?>>Food and Nutrition,Biology</option>
        </select>
      </div><br>


      <div class="form-group">
        <input type="hidden" name="student_id" value="<?php echo $stu_id; ?>" required>
      </div>

     
      <br />

      <div class="form-group">
        <span>Submitted BECE : </span><a href="downloadReport.php?file_id=<?php echo $stu_id; ?>"> Report</a></td>
      </div>
      <div class="form-control">
        <button class="btn btn-success" id='btn-final' name='final_submit' role="button">Final Submit</button>
        <button class="btn btn-primary" name='update' role="button" style="float:right">Update</button>
      </div>

    </form>

    <?php if (isset($_GET['update'])) : ?>
      <div class='flash-data' data-flashdata="<? $_GET['update'];?>"></div>
    <?php endif; ?>
    <?php if (isset($_GET['message'])) : ?>
      <div class='flash-save' data-flashsave="<? $_GET['message'];?>"></div>
    <?php endif; ?>
  </div>
  <script>
    const flashdata = $(".flash-data").data("flashdata");

    if (flashdata) {
      Swal.fire({
        icon: "success",
        title: "Information Updated!",
        text: "You can proceed to save if you're done",
        type: "success",
      }).then(function() {
        window.location.href = "application_review.php";
      });
    }

      const flashsave = $('.flash-save').data('flashsave');

        if(flashsave) {
            Swal.fire({
                icon:'success',
                type: 'success',
                title: 'Congratulations!',
                text: 'Your record submitted!',
                    
            }).then(function () {
                window.location.href = 'student_page.php';
            });
        }
  </script>



</body>


</html>
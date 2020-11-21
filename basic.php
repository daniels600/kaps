<?php
session_start();

 require_once("connection.php");

$stud_email = $_SESSION["email"];
$id=$_SESSION['id'];

if (isset($_GET['email'])) {
  $getEmail = $_GET['email'];
}

if (isset($_GET['error'])) {
  if($_GET['error'] == 'wrongImage'){
    $err_msg = "Please insert correct image!";
    $nFname = $_GET['fname'];
    $nLname = $_GET['lname'];
    $ndob = isset($_GET['dob'])? $_GET['dob'] : "";
    $ngender = isset($_GET['sex'])? $_GET['sex'] :"" ;
    $nmail = isset($_GET['mail'])? $_GET['mail'] :"";
    $nphone = isset($_GET['phone'])? $_GET['phone'] : "";

  }else {
    $err_msg = "We're sorry an error occurred";
    $nFname = isset($_GET['fname'])? $_GET['fname'] : "" ;
    $nLname = isset($_GET['lname'])? $_GET['lname'] : "";
    $ndob = isset($_GET['dob'])? $_GET['dob'] : "";
    $ngender = isset($_GET['sex'])? $_GET['sex'] :"" ;
    $nmail = isset($_GET['mail'])? $_GET['mail'] :"";
    $nphone = isset($_GET['phone'])? $_GET['phone'] : "";
  }
  
}



$basic_query = "SELECT * FROM basic_info inner join students ON basic_info.application_id=students.student_id WHERE basic_info.application_id='$id'";
$basic_result=mysqli_query($conn,$basic_query);

if(isset($basic_result)){
  $student = mysqli_fetch_assoc($basic_result);
  $fname = isset($student['first_name'])? $student['first_name'] : "" ;
  $lname =  isset($student['last_name'])? $student['last_name'] : "";
  $dob =  isset($student['dob']) ? $student['dob'] : "" ;
  $gender =  isset($student['gender']) ? $student['gender'] : "";
  $Email = isset($student['email'])? $student['email'] : "";
  $phone = isset($student['phoneNumber'])? $student['phoneNumber'] : "";
  $image = isset($student['image']) ? $student['image'] : "";
  $imageSrc = $image;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home </title>
  <link rel="icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
  <style>
    .welcome {
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
        <li><a href="/ashweb20-team-team-e/logout.php">Sign Out</a></li><br/>
        <li><a href="/ashweb20-team-team-e/reset-password-student.php">Reset Password</a></li>
      </ul>
    </nav>
  </div>

  
 


  <div class="welcome">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div style="text-align:center;">
      <h1>Fill out all fields</h1>
      <h2>Save the work when done</h2>
    </div>
    <div>
      <?php
      if (isset($err_msg)) {
        echo '<div class="alert alert-danger">' .
          $err_msg
          . '</div>';
      }

      ?>
      <form class="form-group" method="POST" enctype="multipart/form-data" action="student_info.php" data-parsley-validate>
        <p id="errorEmpty"></p>
        <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" class="form-control " id="fname" name="First" placeholder="First Name" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup" data-parsley-error-message='Please enter correct first name' value='<?php if(isset($fname)){ echo $fname;}else{ echo $_GET['fname'];}?>'  required>
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input type="text" class="form-control" id="lname" name="Last" placeholder="Last Name" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup" data-parsley-error-message='Please enter correct last name' value="<?php if(isset($lname)){echo $lname;}elseif(isset($nLname)){echo $nLname; }?>" required>
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth</label><br>
          <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="Birth" id="dob" 
          value="<?php if(isset($dob)){echo $dob;}elseif(isset($ndob)){echo $ndob; }?>" required>
        </div>


        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="custom-select my-1 mr-sm-2" name="Gender" id="gender" required>
          <option selected>Choose ...</option>
          <option value="Male" <?= isset($ngender) == 'Male' ? "selected" : ""?>>Male</option>
          <option value="Female" <?= isset($ngender) == 'Female' ? "selected" : ""?> >Female</option>
        </select>
        

        </div>

        <div class="form-group">
          <label for="mail">Email*</label><br>
          <input type="email" class="form-control" placeholder="Email" name="Mail" id="mail" value="<?php if (isset($getEmail)) {
                    echo $getEmail;
          } ?>" required>

        </div>


        <div class="form-group">
          <label for="phone">Phone Number</label><br>
          <input type="tel" class="form-control" placeholder="Phone Number"  name="Phone" id="phone" data-parsley-maxlength="10" data-parsley-trigger="keyup" value="<?php if(isset($phone)){echo $phone;}elseif(isset($nphone)){echo $nphone; }?>"required>
        </div><br>


        <div class="form-group">
          <p><label class="btn btn-primary"for="file" style="cursor: pointer;">Upload Image</label></p>
          <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"  data-parsley-error-message='Please insert an image' required></p>
         
          <p><img id="output" width="200" name="image"/></p>
                                            
        </div>
          <?php if(isset($_GET['error'])){if($_GET['error'] == 'wrongImage') {echo "<p style='color:red'>Upload a *jpeg  *gif *png *jpg</p>";}}?>

        <div>
          <button type="submit" class="btn btn-primary btn-lg" name="submit">SAVE</button>
        </div>


        <script type="text/javascript" src="/ashweb20-team-team-e/js/app.js"></script>


      </form>

   


    </div>
  </div>
  <?php if (isset($_GET['success'])) : ?>
    <div class='flash-data' data-flashdata="<? $_GET['success'];?>"></div>
  <?php endif; ?>
  <script>
    var loadFile = function(event) {
      var image = document.getElementById("output");
      image.src = URL.createObjectURL(event.target.files[0]);
    };

    const flashdata = $(".flash-data").data("flashdata");

    if (flashdata) {
      Swal.fire({
        icon: "success",
        title: "Information saved!",
        text: "Kindly move to the next required details",
        allowOutsideClick: false,
        allowEscapeKey: false,
        footer: "<a href=education.php>Click here!</a>",
        type: "success",
      }).then(function() {
        window.location.href = "education.php";
      });
    }
  </script>
</body>
 
</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Page</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
   
   <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">
   <link rel="stylesheet" href="/ashweb20-team-team-e/css/admin.css">

   <style>

    .welcome {
        margin-top:15%;
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: #202020;
        width: 50%;
        font-size: 20px;
    }
    </style>
</head>
<body>
<?php 
      session_start();
      if ($_SESSION["loggedin"]) {
        $mail = $_SESSION["id"];
        require_once("connection.php");
        $sql = "SELECT * FROM `basic_info` inner join students ON basic_info.email=students.Email WHERE basic_info.application_id='$mail'";
        $results = mysqli_query($conn, $sql);
        
        if($results){
        $row = mysqli_fetch_assoc($results);
        $image = isset($row['image'])? $row['image'] : "";
        $imageSrc = '.'  . '/' . $image;

  ?>
<div class="wrapper">


<nav id="sidebar" aria-label="side">
  <div class="title">
    <div class="col-md-6 mb-4">
    <?php if(isset($row['image'])){
         
         echo "<img class='rounded-circle z-depth-2' style='width:210%' src=' $imageSrc' />";
       }
       else{
         echo "<img class='rounded-circle z-depth-2' alt='100x100' style='width:210%' src='https://bootdey.com/img/Content/avatar/avatar3.png' data-holder-rendered='true'>";
       }
       ?>

    </div>
    <h2>
      <?php

          echo  "" . $row['first_name'] . " " . $row['last_name'];
          } else {
            echo "Student";
          }
        } else {
          echo "Student";
        }
      
      ?>
    </h2>
  </div>
<ul class="list-items">

<li><a href="/ashweb20-team-team-e/logout.php">Sign Out</a></li>

</ul>
</nav>
</div>



<div class="welcome">
<?php
      if ($_SESSION["loggedin"] ) {

        $sql = "SELECT first_name,STATUS FROM basic_info inner join students ON basic_info.application_id=students.student_id WHERE basic_info.application_id='$mail'";
        $results = mysqli_query($conn, $sql);

        if (isset($results)) {
          $row = mysqli_fetch_assoc($results);

          echo '<div class="alert alert-success" >' .
                '<p style="text-align:center"> ADMISSION STATUS: ' .$row["STATUS"]. '</p>'
            . '</div>';
        } else {
          echo "Welcome,Student";
        }
      }
      ?>
<?php
$sql_basic="SELECT * FROM `basic_info` inner join students ON basic_info.email=students.Email WHERE basic_info.application_id='$mail'";
$resul=mysqli_query($conn,$sql_basic);
$row = mysqli_fetch_assoc($resul);



$sql_edu="SELECT * FROM `education_info` inner join students ON education_info.student_id=students.student_id WHERE education_info.student_id='$mail'";
$result=mysqli_query($conn,$sql_edu);
$rows = mysqli_fetch_assoc($result);


$sql="SELECT * FROM `course_info` inner join students ON course_info.student_id=students.student_id WHERE course_info.student_id='$mail'";
$resut=mysqli_query($conn,$sql);
$ros=mysqli_fetch_assoc($resut);


?>
<form class="form-group"  method="POST" enctype="multipart/form-data" action='/ashweb20-team-team-e/student_review.php'>
        <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" class="form-control " id="fname" name="First" placeholder="First Name" value=
              <?php
        if($row['first_name']){
            echo  $row['first_name'];
        } else {
          echo "N/A";
        }
      
        ?> readonly>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" class="form-control" id="lname" name="Last" placeholder="Last Name" value=
              <?php
               if($row['last_name']){
                echo  $row['last_name'];
            } else {
              echo "N/A";
            }
        
        ?> readonly>

          </div>


          <div class="form-group">
          <label for="dob">Date of Birth</label><br>
          <input type="date"  placeholder="yyyy-mm-dd" 
          class="form-control" name="Birth" id="dob" required 
          value=
              <?php
               if($row['dob']){
                echo  $row['dob'];
            } else {
              echo "N/A";
            }
      
        ?> readonly>
          </div>

          
          <div class="form-group">
          <label for="gender">Gender</label>
              <input type="text" class="form-control" id="gender" name="Gender" placeholder="Gender" value= <?php
            if($row['gender']){
                echo  $row['gender'];
            } else {
              echo "N/A";
            }
        ?> readonly>
            
        </div>

        <div class="form-group">
          <label for="mail">Email</label><br>
          <input type="email"class="form-control" placeholder="Email" name="Mail" id="mail" required value=
              <?php
                if($row['email']){
                    echo  $row['email'];
                } else {
                echo "N/A";
                }
              
        ?> readonly> 
          </div>


          <div class="form-group">
          <label for="phone">Phone Number</label><br>
                <input type="tel" class="form-control"placeholder="Phone Number" name="Phone" id="phone" maxlength=10 required value=
              <?php
              if($row['phoneNumber']){
                echo  $row['phoneNumber'];
            } else {
              echo "N/A";
            }
       
        ?> readonly>
            </div>
            
            
            <div class="form-group">
          <label for="jhs">JHS School</label><br>
          <input type="text"class="form-control" placeholder="JHS" name="JHS" id="jhs"  value="<?php
                if($rows['Junior_High']){
                    echo  $rows['Junior_High'];
                } else {
                echo "N/A";
                }
              
        ?>" readonly> 
          </div>


          <div class="form-group">
          <label for="courses">Number of Courses</label><br>
          <input type="text"class="form-control" placeholder="Course" name="courses" id="courses"  value=
              <?php
                if($rows['Offered_Course']){
                    echo  $rows['Offered_Course'];
                } else {
                echo "N/A";
                }
              
        ?> readonly> 
          </div>
          
          
          <div class="form-group">
          <label for="activity">ExtraCurricular Activities</label><br>
          <input type="text"class="form-control" placeholder="extra" name="extra" id="extra"  value=
              <?php
                if($rows['Extra_Activity']){
                    echo  $rows['Extra_Activity'];
                } else {
                echo "N/A";
                }
              
        ?> readonly> 
          </div>
          
          
          
          
          <div class="form-group">
          <label for="result">Results</label><br>
          <input type="text"class="form-control" placeholder="result" name="results" id="results"  value="<?php
                if($rows['Results']){
                    echo  $rows['Results'];
                } else {
                echo "N/A";
                }
              
        ?>" readonly> 
          </div>
          
          
          <div class="form-group">
          <label for="course">Main Course</label><br>
          <input type="text"class="form-control" placeholder="course" name="course" id="course"  value="<?php
                if($ros['course']){
                    echo  $ros['course'];
                } else {
                echo "N/A";
                }
              
        ?>"readonly> 
          </div>
          
          <div class="form-group">
          <label for="core">Core Course</label><br>
          <input type="text"class="form-control" placeholder="core" name="core" id="core"  value="<?php
                if($ros['core']){
                    echo  $ros['core'];
                } else {
                echo "N/A";
                }
              
        ?>" readonly> 
          </div>
          
          
          <div class="form-group">
          <label for="elective">Elective Courses</label><br>
          <input type="text"class="form-control" placeholder="elective" name="elective" id="elective"  value="<?php
                if($ros['elective']){
                    echo  $ros['elective'];
                } else {
                echo "N/A";
                }
              
        ?>" readonly> 
          </div><br>

            


            


</form>


                                

</div>



</body>


</html>
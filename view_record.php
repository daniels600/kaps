<!-- this code allows you to view a particular student's record -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrator</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
   
   <link rel="stylesheet" href="/ashweb20-team-team-e/css/admin.css">
</head>
<body>
<div style="background: lavender;height:100%">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="images/KwabenyaSHS.png" width="30" height="30" class="d-inline-block align-top" alt="">
                KAPS Admin
              </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item ">
                  <a class="nav-link" href="/ashweb20-team-team-e/admin_page.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/ashweb20-team-team-e/view_student.php">Application</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/admin_logout.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </nav>

                               
            <div class="container bootstrap snippets bootdey" >
            <div class="row">
            <?php
                                                session_start();
                                      require_once("connection.php");
                                      $id=$_GET["sid"];
                                      
                                      $sql="SELECT * from  basic_info inner join students on basic_info.email=students.Email where students.student_id=$id ";
                                      $results=mysqli_query($conn,$sql);
                                      $row = mysqli_fetch_assoc($results); 
                                      $image = isset($row['image'])? $row['image'] : "";
                                      $imageSrc = '.'  . '/' . $image;
                                      
                                
                                    $sql_edu="SELECT * from  education_info inner join students on education_info.student_id=students.student_id where students.student_id=$id";
                                      $result=mysqli_query($conn,$sql_edu);
                                      $rows = mysqli_fetch_assoc($result);                                      

                                      
                                    $sql_course="SELECT * from  course_info inner join students on course_info.student_id=students.student_id where students.student_id=$id ";
                                      $resul=mysqli_query($conn,$sql_course);
                                      $ros = mysqli_fetch_assoc($resul);
                                      
                               ?>
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="<?php if(isset($imageSrc)){echo $imageSrc;}else{
                      echo "<img class='rounded-circle z-depth-2' alt='100x100'  src='https://bootdey.com/img/Content/avatar/avatar3.png' data-holder-rendered='true'>";}?>" alt="">
              </a>
              <h1><?php if(isset($row['first_name'])){echo $row['first_name'];} ;
              echo " ";

              if(isset($row['last_name'])){echo $row['last_name'];}?></h1>
              <p><?php if(isset($row['email'])){echo $row['email'];}?></p>
          </div>

         
      </div>
  </div>
  <div class="profile-info col-md-9" >
  <div class="white-box" style="background:#fff;margin-bottom:15px">
      <div class="panel">
          <div class="bio-graph-heading">
             Believe in the dream!
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Student Details</h1>
              <h1><?php if(isset($ros['course'])) { echo $ros['course']; }?></h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>First Name </span>: <?php if(isset($row['first_name'])) {echo $row['first_name'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Last Name </span>: <?php if(isset($row['last_name'])){echo $row['last_name'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Date of Birth </span>:<?php if(isset($row['dob'])){echo $row['dob'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Gender</span>: <?php if(isset($row['gender'])){echo $row['gender'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Occupation </span>: JHS Graduate</p>
                  </div>
                  <div class="bio-row">
                      <p><span>Email </span>: <?php if(isset($row['email'])){echo $row['email'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Mobile </span>: <?php if(isset($row['phoneNumber'])){echo $row['phoneNumber'];}?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Junior High School </span>: <?php if(isset($rows['Junior_High'])){echo $rows['Junior_High'];}?> </p>
                  </div>
                  <div class="bio-row">
                      <p><span> Extracurricular Activites</span>: <?php if(isset($rows['Extra_Activity'])){echo $rows['Extra_Activity'];} ?> </p>
                  </div>
                  <div class="bio-row">
                      <p><span> Courses Offered</span>: <?php if(isset($rows['Offered_Course'])){echo $rows['Offered_Course'];}?> </p>
                  </div>
                  <div class="bio-row">
                      <p><span> Results Status</span>: <?php if(isset($rows['Results'])){echo $rows['Results'];}?> </p>
                  </div>

                  <div class="bio-row">
                      <p><span> Results File</span>:<a href="downloadReport.php?file_id=<?php if(isset($row['student_id'])){echo $row['student_id']; }?>"> Download</a> </p>
                  </div>
              </div>
          </div>
      </div>
      </div>
      <div style="float:right">
            <button type="button" class="btn btn-primary btn-lg" onclick="location.href='/ashweb20-team-team-e/view_student.php'">GO BACK</button>
            <a href='enroll.php?sid=<?php echo $id?>' ><button type="button" class="btn btn-primary btn-lg">ENROLL</button></a>
            
            </div>
  </div>

  
</div>
</div>

                                

</div>



</body>

<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3"> © 2020 Copyright:
  <a href="https://mdbootstrap.com/"> Team E  Inc Reserved </a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
</html>

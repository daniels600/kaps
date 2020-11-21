<!--this code displays tha admin page and other admin functionalities-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrator</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

    .welcome h1{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: #202020;
        z-index: -1;
        width: 100%;
        text-align: center;
        font-size: 80px;
    }



    </style>
   
   <link rel="stylesheet" href="css/main.css">
</head>
<body >

<div style="background:Lavender;height:93%">

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
                <li class="nav-item active">
                  <a class="nav-link" href="/ashweb20-team-team-e/admin_page.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/view_student.php">Application</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/admin_logout.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </nav>

          <div id="page-wrapper" style="padding:0 0 60px;min-height:568px;">
            <div class="row" style="margin-top:3%;padding-left:15px;padding-right:5px">
                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box" style="background:#fff;padding:25px;margin-bottom:15px">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E"
                                        class="linea-icon linea-basic"></i>
                                    <h5 class="text-muted vb">APPLICATIONS</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-danger">
                                      <?php 
                                      session_start();
                                      require_once("connection.php");
                                      $sql="SELECT student_id FROM  students ";
                                      $results=mysqli_query($conn,$sql);
                                      $row = mysqli_num_rows($results);

                                      if ($row){
                                          echo $row;
                                          echo "/400";
                                      } else {
                                        echo "0";
                                  
                                    }
                                      ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" style="width: <?php $sql="SELECT student_id,concat(round(( (count(*) * 100 )/400),2),'%') AS percentage from students  ";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box" style="background:#fff;padding:25px;margin-bottom:15px">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe01b;"></i>
                                    <h5 class="text-muted vb">MALES</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-megna"><?php
                                     $sql="SELECT gender from basic_info inner join students on basic_info.email=students.Email where gender='Male' ";
                                     $results=mysqli_query($conn,$sql);
                                     $row = mysqli_num_rows($results);

                                     if ($row){
                                         echo $row;
                                     } else {
                                       echo "0";
                                 
                                   }
                                     ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                      <div class="progress-bar" role="progressbar" style="width: <?php $sql="SELECT gender,concat(round(( (count(*) * 100 )/(SELECT count(*) from basic_info)),2),'%') AS percentage from basic_info where gender='Male' ";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!--col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="white-box" style="background:#fff;padding:25px;margin-bottom:15px">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe00b;"></i>
                                    <h5 class="text-muted vb">FEMALES</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php
                                     $sql="SELECT gender from basic_info inner join students on basic_info.email=students.Email where gender='Female' ";
                                     $results=mysqli_query($conn,$sql);
                                     $row = mysqli_num_rows($results);

                                     if ($row){
                                         echo $row;
                                     } else {
                                       echo "0";
                                 
                                   }
                                     ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                      <div class="progress-bar" role="progressbar" style="width: <?php $sql="SELECT gender, concat(round(( (count(*) * 100 )/(SELECT count(*) from basic_info)),2),'%') AS percentage from basic_info where gender='Female' ";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
    

                
                    
              <div class="row">

              <div class="col-md-12 col-lg-6 col-sm-12" >
                        <div class="white-box" style="background:#fff;padding:25px;margin-bottom:15px;margin-top:2%;margin-left:2%">
                            <h3 class="box-title">Courses</h3>
                         
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe00b;"></i>
                                    <h5 class="text-muted vb">General Science</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php
                                     $sql="SELECT course from course_info where course='General Science'";
                                     $results=mysqli_query($conn,$sql);
                                     if($row = mysqli_num_rows($results)){
                                      if ($row){
                                        echo $row;
                                        } else {
                                          echo "0";
                                
                                      }
                                     }
                                     

                                     
                                     ?></h3>
                                 </div> 
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php $sql="SELECT course, concat(round(( (count(*) * 100 )/(SELECT count(*) from course_info)),2),'%') AS percentage from course_info where course='General Science'";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                         </div> <br>


                         <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe00b;"></i>
                                    <h5 class="text-muted vb">General Arts</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php
                                     $sql="SELECT course from course_info where course='General Arts'";
                                     $results=mysqli_query($conn,$sql);
                                     $row = mysqli_num_rows($results);

                                     if ($row){
                                         echo $row;
                                     } else {
                                       echo "0";
                                 
                                   }
                                     ?></h3>
                                 </div> 
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php $sql="SELECT course, concat(round(( (count(*) * 100 )/(SELECT count(*) from course_info)),2),'%') AS percentage from course_info where course='General Arts'";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                
                                      
                                    
                                    </div>
                                </div>
                         </div> <br>

                         <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe00b;"></i>
                                    <h5 class="text-muted vb">Visual Arts</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php
                                     $sql="SELECT course from course_info where course='Visual Arts'";
                                     $results=mysqli_query($conn,$sql);
                                     $row = mysqli_num_rows($results);

                                     if ($row){
                                         echo $row;
                                     } else {
                                       echo "0";
                                 
                                   }
                                     ?></h3>
                                 </div> 
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php $sql="SELECT course, concat(round(( (count(*) * 100 )/(SELECT count(*) from course_info)),2),'%') AS percentage from course_info where course='Visual Arts'";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    
                                    </div>
                                </div>
                         </div> <br>

                         <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic"
                                        data-icon="&#xe00b;"></i>
                                    <h5 class="text-muted vb">Home Economics</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php
                                     $sql="SELECT course from course_info where course='Home Economics'";
                                     $results=mysqli_query($conn,$sql);
                                     $row = mysqli_num_rows($results);

                                     if ($row){
                                         echo $row;
                                     } else {
                                       echo "0";
                                 
                                   }
                                     ?></h3>
                                 </div> 
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                <div class="progress-bar " role="progressbar" style="width: <?php $sql="SELECT course, concat(round(( (count(*) * 100 )/(SELECT count(*) from course_info)),2),'%') AS percentage from course_info where course='Home Economics' ";
                                      $results=mysqli_query($conn,$sql); 
                                      $row = mysqli_fetch_assoc($results);
                                      if($row){
                                        echo $row['percentage'];
                                      }
                              
                                      ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              
                                    </div>
                                </div>
                         </div> <br>
                          </div>
                    </div>

                  
                  <div class="col-lg-6 col-md-12 col-sm-12" >
                        <div class="white-box" style="background:#fff;padding:25px;margin-bottom:15px;margin-top:2%;margin-right:2%">
                            <h3 class="box-title">Messages</h3>
                            <div class="message-center">
                                      <?php
                                      $sql="SELECT Name,Message FROM  contact_us ";
                                      $results=mysqli_query($conn,$sql);
                                      

                                      if (mysqli_num_rows($results) > 0) {
                                        while($row = mysqli_fetch_assoc($results)) {
                                        echo "<div class='mail-contnet'>
                                        <h5>" .$row['Name']."</h5> <span class='mail-desc'>" .$row['Message']. "</span>
                                            </div> 
                                            <hr style='background-color: gray;' class='hr-dark'>";
                                      } 
                                    }else {
                                        echo "No messages";
                                    }
                               ?>
                              </div>
                          </div>
                    </div>
                                  
                </div>
            </div>
      </div>
        
  
    </body>

    <!-- Footer -->
<footer class="page-footer font-small blue" >

<!-- Copyright -->
<div class="footer-copyright text-center py-3"> © 2020 Copyright:
  <a href="https://mdbootstrap.com/"> Team E  Inc Reserved </a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
</html>

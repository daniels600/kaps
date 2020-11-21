<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrator</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/main.css">

</head>
<body>
<div style="background:Lavender;height:100%">

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
          
        

          
          <div style="margin-bottom:2%;padding:0 0 60px">
           <table class="table table-hover"style="width:90%;margin-left:5%;margin-right:5%;background:#fff;margin-top:3%" >
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Status</th>
          <th scope="col">View</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        session_start();
        require_once("connection.php");
         $sql="SELECT * from basic_info ";
        
        $results=mysqli_query($conn,$sql);
          while( $row = mysqli_fetch_assoc($results) ){
            $student_id=$row['application_id'];
            $status="SELECT STATUS from students where student_id=$student_id";
            $stat_res=mysqli_query($conn,$status);
            $rows=mysqli_fetch_assoc($stat_res);

            
            echo
            "<tr scope='row'>
              <td>{$row['application_id']}</td>
              <td>{$row['first_name']}</td>
              <td>{$row['last_name']}</td>";


              if($rows['STATUS']=="PROGRESS"){

                echo " <td><div class='progress md-progress'>
              <div class='progress-bar bg-success' role='progressbar' style='width: 50%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
          </div></td>";

              }
              else if($rows['STATUS']=="REVIEWED"){
             echo " <td><div class='progress md-progress'>
              <div class='progress-bar bg-success' role='progressbar' style='width: 85%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
          </div></td>";
              }
              else{
                echo " <td><div class='progress md-progress'>
              <div class='progress-bar bg-success' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
          </div></td>";
              }
            
              
              echo"
              <td><a href='view_record.php?sid={$student_id};'  ><i class='icon ion-md-eye' size='large'></i></a></td>
              <td><a href='delete_record.php?sid={$student_id};' ><i class='icon ion-md-trash' size='large'></i></a></td>
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
 
  </div>
  </div>

  <script src="js/app.js"></script>

  
    </body>


    <!-- Footer -->
<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3"> © 2020 Copyright:
  <a href="https://mdbootstrap.com/"> Team E  Inc Reserved </a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
</html>           

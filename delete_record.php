<!--this code deletes a record from the table -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrator</title>
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
                  <a class="nav-link" href="/team_e/ashweb20-team-team-e/admin_page.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/team_e/ashweb20-team-team-e/view_student.php">Application</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/team_e/ashweb20-team-team-e/admin_logout.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </nav>




          
<?php
$Confirmation = "<script> window.confirm('Are you sure you want to delete a record? View the record before you delete');
</script>";

echo $Confirmation;
session_start();
require_once("connection.php");
$id=$_GET["sid"];
$sql="SELECT * from  basic_info inner join students on basic_info.application_id=students.student_id where students.student_id=$id ";
$results=mysqli_query($conn,$sql);




if ($Confirmation) {
            if($results){
                $delete ="DELETE FROM basic_info
                WHERE basic_info.application_id = $id";
                $delete_edu="DELETE FROM education_info
                WHERE student_id = $id";
                $delete_course="DELETE FROM course_info
                WHERE student_id = $id";
                $delete_stud="DELETE FROM students
                WHERE student_id = $id";

                $result= mysqli_query($conn,$delete);
                $resul= mysqli_query($conn,$delete_edu);
                $resut= mysqli_query($conn,$delete_course);
                $resuts= mysqli_query($conn,$delete_stud);
                    if($result&& $resul && $resut&&$resuts){
                        header('Location:view_student.php?success=datadeleted ');
                    }
                    else{
                       header('Location:view_student.php?success=dataNotdeleted ');
            
                    }
                   
                }
                else{
                    return null;
            }
    }
    else{
        header("Location: view_student.php");
    }

    mysqli_close($conn);
   
?>
                
          </div>



</div>
</body>

</html>

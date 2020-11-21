
<!--this code insert a student's education info into the database -->
<?php

session_start();

require_once("connection.php");

$stud_id = $_SESSION["id"];


if(isset($_POST['submit'])){
    $class=$_POST["JHS"];
    $course=$_POST["Course"];
    $extra=$_POST["Extra"];
    $results=$_POST["Results"];
    $filename = $_FILES['myResults']['name'];

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myResults']['tmp_name'];
    $size = $_FILES['myResults']['size'];

    $dst = 'results/' . $filename;


    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        header("Location: education.php?JHS=".$class."&course=".$course."&extra=".$extra."&result=".$results."&error=wrongFile");
        exit();

    } elseif ($_FILES['myResults']['size'] > 2000000) { 
        header("Location: education.php?JHS=".$class."&course=".$course."&extra=".$extra."&result=".$results."&error=wrongFile");
        exit();
    }else {
        move_uploaded_file($_FILES['myResults']['tmp_name'], $dst);
        // header("Location: edu_info.php?error=dataNotsubmitted");
    }


    if(!empty($class) && !empty($course) && !empty($extra)&& !empty($results)){
        
            // Prepare an insert statement
        $sql = "INSERT INTO education_info(student_id,Junior_High,Offered_Course,Extra_Activity,Results,result_file) values
            ('$stud_id','$class', '$course', '$extra', '$results','$filename')";

            $result= mysqli_query($conn,$sql);
            //mysqli_error($conn);
            if(isset($result)){
                header("Location: education.php?success=datasubmitted");
            }else{
                header("Location: education.php?JHS=".$class."&course=".$course."&extra=".$extra."&result=".$results."&error=dataNotsubmitted");
                echo "The error is".mysqli_error($conn);
            }
  
        }
    }

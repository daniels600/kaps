<!-- this code inserts a student's course info into the database-->
<?php

session_start();

require_once("connection.php");

$stud_id = $_SESSION["id"];


if(isset($_POST['submit'])){

    $course = mysqli_real_escape_string($conn,$_POST["Courses"]);
    $core = mysqli_real_escape_string($conn,$_POST["Subjects"]);
    $elective = mysqli_real_escape_string($conn,$_POST["Elective"]);
    $id = $_SESSION["email"];
    $stud = $_SESSION['id'];
    

    if (!empty($course) && !empty($course) && !empty($core)) {

        // Prepare an insert statement
        $sql = "INSERT INTO course_info(student_id,course,core,elective) values
                ('$stud_id','$course', '$core', '$elective')";

        $result = mysqli_query($conn, $sql);
        
        if (isset($result)) {
            header("Location:course.php?success=datasubmitted");
        } else {
            header("Location:course.php?course='.$course.'&core='.$core.'&elective='.$elective.'&error=dataNotsubmitted");
            echo "The error is ".mysqli_error($conn);
        }
    }



}

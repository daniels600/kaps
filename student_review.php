<!--this code changes a student's appicaltion status to 'REVIEWED' -->
<?php


session_start();
require_once("connection.php");


    $id=$_SESSION["id"];
    $mail=$_SESSION["email"];
    
    
    if(!empty($id)&& !empty($mail)){
            
       
        $sql_in = "INSERT INTO student_final(student_id,Email) values
        ('$id','$mail')";
        $update="UPDATE students SET status = 'REVIEWED' where student_id=$id";
        $result= mysqli_query($conn,$update);
    
        $results= mysqli_query($conn,$sql_in);
        mysqli_error($conn);
        if($result && $results){
            header("Location:student_page.php?message=finalSubmit");
        }else{
            header("Location:application_review.php?success=dataNotsubmitted");
        }
    }
    

?>

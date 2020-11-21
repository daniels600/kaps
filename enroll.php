<!-- this code changes a student's application status to 'ENROLLED'-->
<?php 
session_start();
require_once("connection.php");


$id=$_GET['sid'];


if(!empty($id)){


    $status= "SELECT STATUS from students where student_id=$id";
    $results=mysqli_query($conn,$status);
    $row = mysqli_fetch_assoc( $results );
    if($row["STATUS"]=="REVIEWED"){
        
    $update="UPDATE students SET STATUS = 'ENROLLED' where student_id=$id";
    $result= mysqli_query($conn,$update);
    mysqli_error($conn);
    if($result){
        header("Location:view_record.php?sid={$id}&success=datasubmitted");
    }else{
        header("Location:view_record.php?sid={$id}&success=dataNotsubmitted");
    }

}
else{
    header("Location:view_record.php?sid={$id}&studentsubmission=notfinalized");
}
}

?>

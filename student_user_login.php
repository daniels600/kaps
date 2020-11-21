
<!-- this code allows a student user to log into the system-->
<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to info page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: info.php");
//     exit();
// }else {
//     header('Location: login.php');
// }


require_once ('connection.php');

if (isset($_POST['submit'])) {

    $email = stripcslashes($_POST['email']);
    $password = stripcslashes(($_POST['password']));

    $email= mysqli_real_escape_string($conn,$email);
    
    $password= mysqli_real_escape_string($conn,$password);

    


     $sql =  "SELECT * from students WHERE email = '$email'";


     $result =  mysqli_query($conn, $sql);

   


    if($result === false){
        
        die(mysqli_error($conn));;
    } 
    else{
        
        $row = mysqli_fetch_array($result);

        $id =  $row[0];

        $password1 = $row[2];

        if($row[1] == $email && password_verify($password,$password1)){
            
                            
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;

            $sql_final="SELECT * from student_final inner join students on student_final.student_id=$id";
            $results=mysqli_query($conn,$sql_final);
            $rows = mysqli_fetch_assoc( $results);

            if($rows){
            if(($rows['STATUS']=="ENROLLED")||($rows['STATUS']=="REVIEWED" )){
                header("Location: student_page.php");
            }
         }
            else{
            // sends user to info.php
            header("Location: info.php");
            }
        } else {
            // send user to login with an error message
            header('Location: login.php?email='.$email.'&error=invalidInputs');
            exit();
        }
    
    }

}
?>
         



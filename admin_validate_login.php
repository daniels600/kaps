<!--this code validates an admin's login credentials in the admin login page -->

<?php


require_once ('connection.php');

if (isset($_POST['submit'])) {

    $email = stripcslashes($_POST['email']);
    $password = stripcslashes(($_POST['password']));

    $email= mysqli_real_escape_string($conn,$email);
    
    $password= mysqli_real_escape_string($conn,$password);


     $sql =  "SELECT * from admin WHERE admin_mail = '$email'";

     $result =  mysqli_query($conn, $sql);

    if($result === false){
        
        die(mysqli_error($conn));;
    } 
    else{
        
        $row = mysqli_fetch_array($result);

        $id=  $row[0];

        $password1 = $row[2];

        if($row[1] == $email && password_verify($password,$password1)){
            
            session_start();
                            
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["admin_email"] = $email;

            // sends user to admin_page.php
            header("Location: admin_page.php");
           
        } else {
            // send user to login with an error message
            header('Location: admin_log_in.php?email='.$email.'&error=invalidInputs');
           // exit();
        }
    
    }

}
?>



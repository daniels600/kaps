<!-- this code inserts a user's message into the database-->
<?php
    


    require_once("connection.php");

    $name= $_POST["Name"];
    $email= $_POST["email"];
    $message= $_POST["Message"];
       

        
        if(!empty($name) && !empty($email) && !empty($message)){
        
            // Prepare an insert statement
            $sql = "INSERT INTO contact_us(Name, email, Message) values
            ('$name', '$email', '$message')";

            $result= mysqli_query($conn,$sql);
            mysqli_error($conn);
            if($result){
                echo "<script>alert('Success')</script>";
                header("Location:contact.php?success=datasubmitted");
            }else{
                echo "<script>alert('No Success')</script>";
                header("Location:contact.php?success=dataNotsubmitted");
            }
  
        }

        mysqli_close($conn); 

?>

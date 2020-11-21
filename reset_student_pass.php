<?php
// Initialize the session
session_start();


// Include config file
require_once "connection.php";


// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$stud_email = $_SESSION["email"];
$id = $_SESSION['id'];



if (isset($_POST['submit'])) {

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $current_password = mysqli_real_escape_string($conn, $current_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);


    $sql =  "SELECT * from students WHERE email = '$stud_email'";

    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);


    if (isset($row['password'])) {
        echo $stud_email;
        
        $password = $row['password'];

        // Check input errors before updating the database
        if ( $row['email'] == $stud_email && password_verify($current_password,$password)) {
           
            //hash new password 
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Prepare an update statement
            $sql = "UPDATE students SET Password = '$new_password' WHERE email = '$stud_email'";

            $updatePass = mysqli_query($conn, $sql);

            if ($updatePass) {
                header('Location: login.php');
            } else {
                header('Location: reset-password-student.php?error=resetfailed');
            }

            // Close statement
            $stmt->close();
        } else{
            header('Location: reset-password-student.php?error=resetfailed');
        }
    } else {
        header('Location: reset-password-student.php?error=resetfailed');
    }

    // Close connection
    $conn->close();
}
?>

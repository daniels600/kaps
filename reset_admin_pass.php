<?php
// Initialize the session
session_start();
 
// // Check if the user is logged in, if not then redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: admin_log_in.php");
//     exit;
// }
 
// Include config file
require_once "connection.php";
 



 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
 
    $admin_mail = $_POST['email'];
    // $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $new_password = mysqli_real_escape_string($conn, $new_password);
    // $current_password = mysqli_real_escape_string($conn, $current_password);

    
    $sql =  "SELECT * from admin WHERE admin_mail = '$admin_mail'";

    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);

    
    if (isset($row['admin_password'])) {
        
        $password = $row['admin_password'];

        // Check input errors before updating the database
        if ( $row['admin_mail'] == $admin_mail) {
            
            //hash new password 
            $new_password = password_hash($new_password,PASSWORD_DEFAULT);

            // Prepare an update statement
            $sql_up = "UPDATE admin SET admin_password = '$new_password' WHERE admin_mail = '$admin_mail'";

            $updatePass = mysqli_query($conn, $sql_up);

            if (isset($updatePass)) {
                header('Location: admin_log_in.php?reset=success');
            } else {
                header('Location: reset-password-admin.php?error=resetfailed');
            }

            // Close statement
            $stmt->close();
        } else{
            header('Location: reset-password-admin.php?error=resetfailed');
        }
    } else {
        header('Location: reset-password-admin.php?error=resetfailed');
    }

    // Close connection
    $conn->close();
}
?>
 
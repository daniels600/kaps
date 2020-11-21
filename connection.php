<!-- this code establishes a connection with the database-->
<?php 

    require_once('config/const.php');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn === false){
        die("ERROR: Could not connect. " . $conn->connect_error);
    }


?>

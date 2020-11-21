
<?php
session_start();
require_once("connection.php");

$getEmail = $_SESSION['email'];
$stud_id = $_SESSION["id"];




if (isset($_POST['submit'])) {
    $tm = md5(time());
    $fname = mysqli_escape_string($conn,$_POST["First"]);
    $lname = mysqli_escape_string($conn,$_POST["Last"]);
    $dob = mysqli_escape_string($conn,$_POST["Birth"]);
    $gender = mysqli_escape_string($conn,$_POST["Gender"]);
    $mail = mysqli_escape_string($conn,$_POST["Mail"]);
    $phone = mysqli_escape_string($conn,$_POST["Phone"]);
    $stu_id = $stud_id;
    $image_name = mysqli_escape_string($conn,$_FILES['image']['name']);
    $dst = "student_images/" . $tm . $image_name;
    $dst1 = "student_images/" . $tm . $image_name;
    $image_type = $_FILES['image']['type']; // getting the type to check if it is an image

    // checking file upload if it is an image
    if (
        !empty($_FILES['image']['tmp_name'])
        && file_exists($_FILES['image']['tmp_name'])
    ) {
        $data = addslashes(file_get_contents($_FILES['image']['tmp_name']));

        $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");

        if (!in_array($image_type, $allowed)) {
            $error_message = 'Only jpg, gif, and png files are allowed.';
            header("Location: basic.php?fname=".$fname."&lname=".$lname."&dob=".$dob."&sex=".$gender."&mail=".$mail."&phone=".$phone."&error=wrongImage");
            exit();
        } else {
            move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        }
    }



    // Prepare an insert statement
    $sql = "INSERT INTO basic_info(first_name,last_name,dob,gender,email,phoneNumber,application_id,image) values
            (?, ?, ?, ?, ?, ?, ?, ?)";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssds", $fname, $lname, $dob, $gender, $mail, $phone,  $stu_id, $dst1);
       
        // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        echo "Data inserted successfully";
            header("Location:basic.php?success=submitted");
    } else { 
        header("Location: basic.php?fname=".$fname."&lname=".$lname."&dob=".$dob."&sex=".$gender."&mail=".$mail."&phone=".$phone."&error=dataNotSubmitted");
        echo "The error is ".mysqli_error($conn);
    }

        // Close statement
        $stmt->close();
    }



mysqli_close($conn);
?>

        


<!-- this code displays the login page for users-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign-In</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>

    <link rel="stylesheet" href="css/parsley.css">

   
</head>
<body>

  
 
        <div class="back" style=" background-image: url('/ashweb20-team-team-e/images/laptopp.jpg');height: 100%;  background-position: center;background-repeat: no-repeat;background-size: cover;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="/ashweb20-team-team-e/images/KwabenyaSHS.png" width="30" height="30" class="d-inline-block align-top" alt="">
                KAPS
              </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="/ashweb20-team-team-e/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/contact.php">Contact</a>
                </li>
              </ul>
            </div>
          </nav>


        
            <!-- Default form login -->
<form  style="background-color: white; margin-top: 10%; margin-left: 65%; width: 30%;margin-right: 5%;" class="text-center border border-light p-5" action="student_user_login.php" method="POST" onsubmit="return validate_login ();" data-parsley-validate>

    <p class="h4 mb-4">Student Sign in</p>

    <?php if(isset($_GET['error'])){if($_GET['error'] == 'invalidInputs'){echo "<p style='color:red'>Invalid credentials</p>";}} ?>

    <!-- Email -->
    <input type="email" id="email" class="form-control mb-4" placeholder="E-mail" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" data-parsley-trigger="change" data-parsley-error-message="Please enter a valid email" required>
    <!-- <p style= 'color:red' id= "email_error"></p> -->
    
  
    <!-- Password -->
    <input type="password" id="password" class="form-control mb-4" placeholder="Password" name="password">
    <p style= 'color:red' id="password_error" required></p>


    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit" name ="submit" >Sign in</button>
    <!-- <input type="submit" value="sign in" name ="submit" > -->
    

    <!-- Register -->
    <p>Not an Applicant?
        <a href="/ashweb20-team-team-e/student_sign_up.php">Register</a>
    </p>


</form>
<!-- Default form login -->
    </div>


    <script src="js/app.js">

    </script>
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3"> © 2020 Copyright:
      <a href="https://mdbootstrap.com/"> Team E  Inc Reserved </a>
    </div>
    <!-- Copyright -->
  
  </footer>
  <!-- Footer -->

</html>



<!-- this code is for the admin login page-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator</title>
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
                KAPS ADMIN
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
                  <a class="nav-link" href="/ashweb20-team-team-e/about_us.html">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/contact.php">Contact</a>
                </li>
              </ul>
            </div>
          </nav>


        
            <!-- Default form login -->
<form  style="background-color: white; margin-top: 10%; margin-left: 65%; width: 30%;margin-right: 5%;" class="text-center border border-light p-5" method="POST" action="admin_validate_login.php" onsubmit="return validate_login ();" data-parsley-validate>

    <p class="h4 mb-4">Administrator Sign in</p>
    <?php if(isset($_GET['error'])){if($_GET['error'] == 'invalidInputs'){echo "<p style='color:red'>Invalid credentials</p>";}} ?>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" required>

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="password" data-parsley-minlength="6" data-parsley-maxlength="16"  required>

   

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" name="submit" type="submit">Sign in</button>
    <p>Forgot Password?<a href="reset-password-admin.php">Reset Password</a>
    
    

</form>
<!-- Default form login -->
</div>


  


    



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


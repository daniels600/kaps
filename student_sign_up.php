<!-- this code allows a student user to sign up for the first time-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign-Up</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>

    <link rel="stylesheet" href="css/parsley.css">
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>

  <div class="back" style=" background-image: url('images/laptopp.jpg');height: 100%;  background-position: center;background-repeat: no-repeat;background-size: cover;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="images/KwabenyaSHS.png" width="30" height="30" class="d-inline-block align-top" alt="">
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
                  <a class="nav-link" href="/ashweb20-team-team-e/about_us.html">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/contact.html">Contact</a>
                </li>
              </ul>
            </div>
          </nav>

    

      <!-- Default form login -->
      <form
        style="
          background-color: white;
          margin-top: 10%;
          margin-left: 65%;
          width: 30%;
          margin-right: 5%;
        "
        class="text-center border border-light p-5"
        action="student_user_signup.php"
        method="POST"
        onsubmit="return validate();"
        data-parsley-validate
      >
        <p class="h4 mb-4">Student Sign Up</p>

        <?php if(isset($_GET['error']))
         {if($_GET['error'] == 'noInsertion')
         { echo 'There is an error inserting';}
         
         }?>

        <!-- Email -->
        <input
          type="email"
          id="email"
          name="email"
          class="form-control mb-4"
          placeholder="E-mail"
        required data-parsley-error-message='Please enter correct email' value="<?php if(isset($_GET['email'])){echo $_GET['email']; }?>"/>
        <!-- <span style= 'color:red' id="email_error"></span> -->

        <!-- display to user that email already exist -->
        <?php if(isset($_GET['error'])){if($_GET['error'] == 'emailAlreadyExist'){ echo '<p style="color:red">Please email already exist</p>';}}?>

        <!-- Password -->
        <input
          type="password"
          id="password"
          name="password"
          class="form-control mb-4"
          placeholder="Password"
        required data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-trigger="keyup"/>
        <span style= 'color:red' id="password_error"></span>

        <!-- Confirm Password -->
        <input
          type="password"
          id="confirm_password"
          name="confirm_password"
          class="form-control mb-4"
          placeholder="Confirm Password"
        required data-parsley-equalto="#password" data-parsley-trigger="keyup" data-parsley-error-message='Passwords are not the same'/>
        <span style= 'color:red'id="password_conf_error"></span>

        <!-- Sign in button -->
        <button class="btn btn-info btn-block my-4" type="submit">Sign Up</button>
        <!-- <input type="submit" name="submit" value="Signup" /> -->

        <p>Already have an account? <a href="/ashweb20-team-team-e/login.php">Login here</a>.</p>
      </form>
      <!-- Default form login -->
    </div>
    </div>

    <script src="js/app.js"></script>
  </body>
  <!-- Footer -->
  <footer class="page-footer font-small blue">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
      © 2020 Copyright:
      <a href="https://mdbootstrap.com/"> Team E Inc Reserved </a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</html>

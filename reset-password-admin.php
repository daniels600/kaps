
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
    <style>
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;
            color: #B94A48;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }

        #form {background-color: white; margin-top: 10%; margin-left: 65%; width: 30%;margin-right: 5%;}
    </style>
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



        <!-- Reset Form -->
        <form class="text-center border border-light p-5" action="/ashweb20-team-team-e/reset_admin_pass.php" method="POST" id='form' data-parsley-validate>

            <p class="h4 mb-4">Reset Password</p>
           

            <?php if (isset($_GET['error'])) {
                if ($_GET['error'] == 'resetfailed') {
                    echo "<p style='color:red'>Oops! Password reset unsuccessful</p>";
                }
            } ?>

            <!-- Current Password -->
            <input type="email" id="email" class="form-control mb-4" placeholder="Email" name="email" required  data-parsley-trigger="keyup">

             <!-- New Password -->
             <!-- <input type="password" id="current_password" class="form-control mb-4" placeholder="Current Password" name="current_password" required data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-trigger="keyup"> -->

            <!-- New Password -->
            <input type="password" id="new_password" class="form-control mb-4" placeholder="New Password" name="new_password" required data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-trigger="keyup">

            <!-- Confirm Password -->
            <input type="password" id="confirm_password" class="form-control mb-4" placeholder="Confirm Password" name="confirm_password" required data-parsley-equalto="#new_password" data-parsley-trigger="keyup" data-parsley-error-message='Passwords are not the same'>


            <button type="submit" name="submit" class="btn btn-success" style="text-align: center;"><i class="fas fa-lock"></i> Reset</button>

            <!-- <div class="form-group text-center">
                <input type="hidden" name="action" value="change_password" />
                
            </div> -->

        </form>
        <!-- Default form login -->
    </div>
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3"> © 2020 Copyright:
        <a href="https://mdbootstrap.com/"> Team E Inc Reserved </a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

</html>
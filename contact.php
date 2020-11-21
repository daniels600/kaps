
<!-- this code displays the contact information of the school-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/ashweb20-team-team-e/css/main.css">

   
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
                <li class="nav-item ">
                  <a class="nav-link" href="/ashweb20-team-team-e/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/ashweb20-team-team-e/about_us.html">About Us</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/ashweb20-team-team-e/contact.php">Contact</a>
                </li>
              </ul>
            </div>
          </nav>


    
                
          <form style="background-color: white; margin-top: 10%; margin-left: 35%; width: 30%;margin-right: 5%;" class="text-center border border-light p-5" method="POST"action="contact_us.php" >

            <p class="h4 mb-4">Contact Us</p>
        
            <!-- Name-->
            <input type="text" id="Name" class="form-control mb-4" placeholder="Name" name="Name">
        
            <!-- Password -->
            <input type="text" id="email" class="form-control mb-4" placeholder="Email" name="email">
        
           <!-- Message -->
            <textarea type="text" id="message" rows="2" class="form-control md-textarea" placeholder="Message" name="Message"></textarea>
            
        
        
            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit" name="submit">Submit</button>
            
        
        
        
        </form>
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

<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: MovieTimeHome.php");
 exit;
}

if (isset($_POST['btn-login'])) {
 
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);
 
 $email = $con->real_escape_string($email);
 $password = $con->real_escape_string($password);
 $query = $con->query("SELECT user_id, email, password FROM user WHERE email='$email' AND password='$password'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if email/password are correct returns must be 1 row
 
 if ($count==1) {
  $_SESSION['userSession'] = $row['email'];
  header("Location: MovieTimeHome.php");
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $con->close();
}
?>
<html>
<head>
<title>Login to MovieTime</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="MovieTime.css">
<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-inverse">
		 <img id="logo" src="MTlogo.jpg">
		 </nav>
<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign in to MovieTime</h2><hr />
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   			</button> 
            
            <a href="MovieTimeRegister.php" class="btn btn-default" style="float:right;">Or register here</a>
            
        </div>  
        
        
      
      </form>
    </div>
    
</div>

</body>
</html>
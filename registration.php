<?php
session_start();
error_reporting(0);
include("dbconnection.php");
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$mobile=$_POST['phone'];
	$gender=$_POST['gender'];
	$query=mysqli_query($con,"select email from user where email='$email'");
	$num=mysqli_fetch_array($query);
	if($num>1)
	{
  echo "<script>alert('Email-id already register with us. Please try with diffrent email id.');</script>";
  echo "<script>window.location.href='registration.php'</script>";
	}
	else
	{
 mysqli_query($con,"insert into user(name,email,password,mobile,gender) values('$name','$email','$password','$mobile','$gender')");
echo "<script>alert('Successfully register with us. Now you can login');</script>";  
echo "<script>window.location.href='login.php'</script>";
}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.cpassword.value)
{
alert('New Password and Re-Password field does not match');
document.signup.cpassword.focus();
return false;
}
return true;
}   

</script>

</head>

<body class="error-body no-top" style="background: linear-gradient(0deg,#262625 0, #1d58b3 100%)fixed;">

<header >
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" >
    <div class="container" style="background-color:#1F1F1F; width:100%; height:50px;" >
      <a class="navbar-brand" href="index.php" style="color:white; font-size: 30px;">CLOUDYFY</a>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul style="list-style-type: none;">
          <li >
            <a class="nav-link" href="admin/" style="margin-right:20px; font-size:16px;float: right;color:  #34c6eb;list-style: none;padding-top: 15px;">Admin</a>
          </li>
        </ul>
      </div>

      </div>
    </div>
  </nav>
</header>
 
  
<div class="container" id="form_con" style="background-color: rgba(0, 0, 0, 0.5);  
 backdrop-filter: blur(80px); width:40%; height:auto; padding:30px 50px; border-radius:20px; color:white">

      <h2 style="color:white;justify-content: center;display: flex;">Sign up for Cloudyfy CRM</h2>
          
      <br>

      <p style="justify-content: center;display: flex;">Already have an Account &nbsp;&nbsp;&nbsp;<a href="login.php" style="color: #34c6eb;">Log in Now!</a>    

        
		 <form id="signup" name="signup" class="login-form" onsubmit="return checkpass();" method="post" style="color:white">
		 <div class="row" style="justify-content: center;display: flex;">
		 <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Name</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="text" name="name" id="name" class="form-control" required="true" style="border-radius:10px">                                
				</div>
            </div>
          </div>
          </div>
           <div class="row" style="justify-content: center;display: flex;">
		 <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Email ID</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="email" name="email" id="email" class="form-control" required="true" style="border-radius:10px">                                 
				</div>
            </div>
          </div>
          </div>
           <div class="row" style="justify-content: center;display: flex;">
		 <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Password</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="password" name="password" id="password" class="form-control" required="true" style="border-radius:10px">                                 
				</div>
            </div>
          </div>
          </div>
		  <div class="row" style="justify-content: center;display: flex;">
          <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Confirm Password</label>
            <span class="help"></span>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="password" name="cpassword" id="cpassword" class="form-control" required="true" style="border-radius:10px">                                 
				</div>
            </div>
          </div>
          </div>
          <div class="row" style="justify-content: center;display: flex;">
          <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Contact Number</label>
            <span class="help"></span>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="text" name="phone" id="txtpassword" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required="true" style="border-radius:10px">                                 
				</div>
                
            </div>
          </div>
          </div>
          <div class="row" style="justify-content: center;display: flex;">
          <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Gender</label>
            <span class="help"></span>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<input type="radio" value="m" name="gender" checked > Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" value="f" name="gender" > Female
          <br><br>
                                
				</div>
            </div>
          </div>
          </div>
         <div class="row" style="justify-content: center;display: flex;">
            <div class="col-md-10" style="justify-content: center;display: flex;">
              <input   class="btn btn-primary btn-cons" name="submit" value="Sign up" type="submit" style="background-color:#1d58b3; border-radius:30px; padding:10px; font-size:16px; border:1px solid white; box-shadow:0 0 10px 10px rgba(255,255,255,0.01)" />
              
            </div>
          </div>
		  </form>
     
  </div>


  
  
</div>
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/js/login.js" type="text/javascript"></script>
</body>
</html>
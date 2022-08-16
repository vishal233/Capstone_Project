<?php
session_start();
error_reporting(0);
include("dbconnection.php");
if(isset($_POST['login']))
{
$ret=mysqli_query($con,"SELECT * FROM admin WHERE name='".$_POST['email']."' and password='".$_POST['password']."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="home.php";
$_SESSION['alogin']=$_POST['email'];
$_SESSION['id']=$num['id'];
echo "<script>window.location.href='".$extra."'</script>";
exit();
}
else
{
$_SESSION['action1']="*Invalid username or password";
$extra="index.php";

echo "<script>window.location.href='".$extra."'</script>";
exit();
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>

</head>

<body class="error-body no-top" style="background: linear-gradient(0deg,#262625 0%,#1d58b3 100%)fixed;">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
<div class="container" style="background-color:#1F1F1F; width:100%; height:50px;" >
      <a class="navbar-brand" href="../index.php" style="color:white; font-size: 30px;">CLOUDYFY</a>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul style="list-style-type: none;">
          <li >
            <a class="nav-link" href="../login.php" style="margin-right:20px; font-size:16px;float: right;color:  #34c6eb;list-style: none;padding-top: 15px;">User Log In</a>
          </li>
        </ul>
      </div>


</div>
  </nav>

  <div class="container" id="form_con" style="background-color: rgba(0, 0, 0, 0.5);  
 backdrop-filter: blur(80px); width:40%; height:auto; padding:30px 50px; border-radius:30px; color:white">
   
  <h2 style="color:white;justify-content: center;display: flex;">Admin Login</h2>
         
		 <form id="login-form" class="login-form" action="" method="post">
         <p style="color: #F00"><?php echo $_SESSION['action1'];?><?php echo $_SESSION['action1']="";?></p>
		 <div class="row" style="justify-content: center;display: flex;">
		 <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Username</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<i class=""></i>
					<input type="text" name="email" id="txtusername" class="form-control" style="border-radius:10px">                                 
				</div>
            </div>
          </div>
          </div>
		  <div class="row" style="justify-content: center;display: flex;"> 
          <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Password</label>
            <span class="help"></span>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<i class=""></i>
					<input type="password" name="password" id="txtpassword" class="form-control" style="border-radius:10px">                                 
				</div>
            </div>
          </div>
          </div>
          <div class="row" style="justify-content: center;display: flex;"> 
            <br>
            <br>
            <div class="col-md-10" style="justify-content: center;display: flex;">
              <input  class="btn btn-primary btn-cons" name="login" value="Log in" type="submit" style="background-color:#1d58b3; border-radius:30px; padding:10px; font-size:16px; border:1px solid white; box-shadow:0 0 10px 10px rgba(255,255,255,0.01)"/>
            </div>
          </div>
		  </form>
      </div>
        </div>
     
    
  </div>
</div>
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/js/login.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="js/exporting.js"></script>	
</body>
</html>
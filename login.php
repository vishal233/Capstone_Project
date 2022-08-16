<?php
session_start();
error_reporting(0);
include("dbconnection.php");
if(isset($_POST['login']))
{
$ret=mysqli_query($con,"SELECT * FROM user WHERE email='".$_POST['email']."' and password='".$_POST['password']."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['name'];
$val3 =date("Y/m/d");
date_default_timezone_set("Asia/Calcutta");
$time=date("h:i:sa");
$tim = $time;
$ip_address=$_SERVER['REMOTE_ADDR'];
$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 
$city = $addrDetailsArr['geoplugin_city']; 
$country = $addrDetailsArr['geoplugin_countryName'];
ob_start();
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();
$findme = "Physical";
$pmac = strpos($mycom, $findme);
$mac=substr($mycom,($pmac+36),17);
$ret=mysqli_query($con,"insert into usercheck(logindate,logintime,user_id,username,email,ip,mac,city,country)values('".$val3."','".$tim."','".$_SESSION['id']."','".$_SESSION['name']."','".$_SESSION['login']."','$ip_address','$mac','$city','$country')");

$extra="dashboard.php";
echo "<script>window.location.href='".$extra."'</script>";
exit();
}
else
{
$_SESSION['action1']="Invalid username or password";
$extra="login.php";

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
<title>CRM | Login</title>
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
  function myFunction() {
  var x = document.getElementById("txtpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</head>

<body class="error-body no-top" style="background: linear-gradient(0deg,#262625 0%,#1d58b3 100%)fixed;">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" style="height: 35px;">
<div class="container" style="background-color:#1F1F1F; width:100%; height:50px;" >
      <a class="navbar-brand" href="index.php" style="color:white; font-size: 30px;">CLOUDYFY</a>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul style="list-style-type: none;">
          <li >
            <a class="nav-link" href="admin/" style="margin-right:20px; color: #34c6eb; font-size:16px;float: right;list-style: none;padding-top: 15px;">Admin</a>
          </li>
        </ul>
      </div>

      </div>
  </nav>

  <div class="container" id="form_con" style="background-color: rgba(0, 0, 0, 0.5);  
 backdrop-filter: blur(80px); width:40%; height:auto; padding:30px 50px; border-radius:30px; color:white">
   
  <h2 style="color:white;justify-content: center;display: flex;">Log into your Cloudyfy CRM account</h2>
          
          <br>
        
    <p style="justify-content: center;display: flex;">Don't have an Account &nbsp;&nbsp;&nbsp;<a href="registration.php" style="color: #34c6eb;">Sign up Now!</a>
      <br>
      <p style="color:#F00"><?php echo $_SESSION['action1'];?><?php echo $_SESSION['action1']="";?></p>

		 <form id="login-form" class="login-form" action="" method="post">
		 <div class="row" style="justify-content: center;display: flex;">
		 <div class="form-group col-md-10">
            <label class="form-label" style="color:white">Email</label>
            <div class="controls">
				<div class="input-with-icon  right">                                       
					<i class=""></i>
					<input type="email" name="email" id="txtusername" class="form-control" required="true" style="border-radius:10px">                                 
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
					<input type="password" name="password" id="txtpassword" class="form-control" required="true" style="border-radius:10px">
          <input type="checkbox" onclick="myFunction()" style="margin-top:10px"> Show Password             
				</div>
            </div>
          </div>
          </div>
		  <div class="row" style="justify-content: center;display: flex;">
          <div class="control-group  col-md-10">
            <div class="checkbox checkbox check-success"> <a href="forgot-password.php" style="color:#B9F2FF; font-size:18px">Forgot Password </a>&nbsp;&nbsp;
         </div>
          </div>
          </div>
          <br>
          <br>
          <div class="row" style="justify-content: center;display: flex;">
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
</body>
</html>
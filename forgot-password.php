<?php
session_start();
error_reporting();
include("dbconnection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
	require('PHPMailer\PHPMailer.php');
	require('PHPMailer\SMTP.php');
	require('PHPMailer\Exception.php');

	$mail = new PHPMailer(true);

	try {
	//Server settings
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'sutharvishal1996@gmail.com';                     //SMTP username
	$mail->Password   = 'xazsvkkaybwkhole';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom('sutharvishal233@gmail.com', 'Coudify');
	$mail->addAddress($email);     //Add a recipient

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = 'Coudify Password Reset Link';
	$mail->Body    = "Here is the link to reset your password with Us.<br>
	Click the link below...<br>
	<a href='http://localhost/TASK/Project/crm demo/updatepassword.php?email=$email&reset_token=$reset_token'>
		Reset Password
	<a>";

	$mail->send();
	
	return true;

	} catch (Exception $e) {
		return false;
	}
}


if(isset($_POST['submit']))
	{
		$query = "SELECT * FROM `user` WHERE email='$_POST[email]'";
		$result = mysqli_query($con, $query);
		
		if($result)
		{	
			if(mysqli_num_rows($result)==1)
			{
				$reset_token = bin2hex(random_bytes(16));
				date_default_timezone_set('America/Toronto');
				$date = date("Y-m-d");
				$query = "UPDATE `user` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE email='$_POST[email]'";
				
				if(mysqli_query($con,$query) && sendMail($_POST['email'], $reset_token))
				{
					echo "<script>
					alert('Link Send to Mail');
					window.location.href='forgot-password.php';
					</script>";
				}
				else
				{
					echo "<script>
					alert('Server Down Please Try Again Later');
					window.location.href='forgot-password.php';
					</script>";
				}
			}
			else
			{
				echo "<script>
				alert('Email Not Found.');
				window.location.href='forgot-password.php';
				</script>";
			}
		}
		else
		{
			echo "<script>
				alert('cannot run query');
				window.location.href='forgot-password.php';
			</script>";
		}



		$row1=mysqli_query($con,"select email,password from user where email='".$_POST['email']."'");
		$row2=mysqli_fetch_array($row1);
	if($row2>0){
		$email = $row2['email'];
		$subject = " CRM about your password";
		$password=$row2['password'];
		$message = "Your password is ".$password;
		mail($email, $subject, $message, "From: $email");
		$_SESSION['msg']= "Your Password has been sent to your email id Successfully.";
	}else{
		$_SESSION['msg']= "*Email not register with us.";   
	}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Forgot Password</title>
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

</head>
<body class="error-body no-top" style="background: linear-gradient(0deg,#262625 0%,#1d58b3 100%)fixed;">

	

	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" style="height: 35px;">
		<div class="container" style="background-color:#1F1F1F; width:100%; height:50px;" >
			<a class="navbar-brand" href="index.php" style="color:white; font-size: 30px;">CLOUDYFY</a></div>
	</nav>


	<div class="container" id="form_con" style="background-color: rgba(0, 0, 0, 0.5);  
		backdrop-filter: blur(80px); width:40%; height:auto; padding:30px 50px; border-radius:30px; color:white">

		<h2 style="color:white;justify-content: center;display: flex;">Forgot Password</h2>
		<br>

		<p style="justify-content: center;display: flex;">Don't have an Account &nbsp;&nbsp;&nbsp;<a href="registration.php" style="color: #34c6eb;">Sign up Now!</a></p>
		<br>

		
		<p style="color:#F00; font-size:12px;"></p>

		<form id="login-form" class="login-form" action="" method="post">
			
			<div class="row" style="justify-content: center;display: flex;">
				<div class="form-group col-md-10">
					<label class="form-label" style="color:white">Username / Email</label>
					<div class="controls">
						<div class="input-with-icon  right">                                       
							<i class=""></i>
							<input type="text" name="email" id="txtusername" class="form-control" required="true" style="border-radius:10px">  </div>
					</div>
				</div>
			</div>

			<div class="row" style="justify-content: center;display: flex;">
				<div class="col-md-10" style="justify-content: center;display: flex;">				
					<button class="btn btn-primary btn-cons" name="submit" type="submit" style="background-color:#1d58b3; border-radius:30px; padding:10px; font-size:16px; border:1px solid white; box-shadow:0 0 10px 10px rgba(255,255,255,0.01)">submit</button>				
				</div>
			</div>
		</form>
		  
	</div>

  <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="assets/js/login.js" type="text/javascript"></script>
</body>
</html>
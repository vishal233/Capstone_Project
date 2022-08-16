<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRM | Update Password</title>
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

	<style>
		.password{
			width: 100%;
			margin-bottom: 20px;
			background: transparent;
			border: none;
			/*border-bottom: 2px solid #30475e;*/
			border-radius: 5px;
			padding: 5px 0;
			font-weight: 550;
			font-size: 14px;
			outline: none;
		}
		form button{
			font-weight: 550;
			font-style: 15px;
			background-color: #30475e;
			color: white;
			padding: 4px 10px;
			border: none;
			outline: none;
			margin-top: 5px;
			border-radius: 5px;
			margin-top: 10px;
		}
	</style>

	<script type="text/javascript">
		function myFunction() {
			var x = document.getElementById("txtpassword");
			if (x.type === "password") {
				x.type = "text";
			} 
			else {
				x.type = "password";
			}
		}
</script>

</head>
<body class="error-body no-top" style="background: linear-gradient(0deg,#262625 0%,#1d58b3 100%)fixed;">

	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" style="height: 35px;">
		<div class="container" style="background-color:#1F1F1F; width:100%; height:50px;" >
      		<a class="navbar-brand" href="index.php" style="color:white; font-size: 30px;">CLOUDYFY</a>
      	</div>
  </nav>

	<div class="container" id="form_con" style="background-color: rgba(0, 0, 0, 0.5);  
		backdrop-filter: blur(80px); width:40%; height:auto; padding:30px 50px; border-radius:30px; color:white;">
		
		<h2 style="color:white;justify-content: center;display: flex;">Create New Password</h2>
		<br>

		<?php
			include("dbconnection.php");
			if(isset($_GET['email']) && isset($_GET['reset_token']))
			{	
				date_default_timezone_set('America/Toronto');
				$date = date("Y-m-d");
				$query = "SELECT * FROM `user` WHERE email='$_GET[email]' AND resettoken = '$_GET[reset_token]' AND resettokenexpire = '$date'";

				$result = mysqli_query($con, $query);
				if($result)
				{	
					if(mysqli_num_rows($result)==1)
					{	
						echo"
							<form method='POST'> 
								<input class='password' type='password' placeholder='New Password' name='Password' id='txtpassword'>
								<input type='checkbox' onclick='myFunction()'> Show Password <br>
								<button type='submit' name='updatepassword'>UPDATE</button>
								<input type='hidden' name='email'value='$_GET[email]'> 					
							</form>
						";
					}
					else
					{
						echo "
							<script>
							alert('Invalid/Expire Link');
							window.location.href='login.php';
							</script>
						";
					}
				}
				else
				{
					echo "
						<script>
						alert('Server Down Try again later');
						window.location.href='login.php';
						</script>
						";
				}
			}
			else
			{
				echo "
					<script>
					alert('hello this is not working');
					window.location.href='login.php';
					</script>
					";
			}
		?>

		<?php 
			if(isset($_POST['updatepassword']))
			{
				// $pass = password_hash($_POST['Password'], PASSWORD_BCRYPT);
				$update = "UPDATE `user` SET `password`='$_POST[Password]',`resettoken`=NULL,`resettokenexpire`=NUll WHERE email='$_GET[email]'";
				$result = mysqli_query($con, $update);
				if($result)
				{
					echo "
						<script>
							alert('Password Updated Successfully...!!');
							window.location.href='login.php';
						</script>
						";
				}
				else
				{
					echo "
						<script>
							alert('Server Down..! Please Try again later.');
							window.location.href='updatepassword.php';
						</script>
						";
				}
			}
		?>
	</div>
</body>
</html>
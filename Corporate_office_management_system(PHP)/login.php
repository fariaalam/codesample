<?php
	session_start();
	
	if(!isset($_SESSION['login_permission'])){
		$_SESSION['login_permission'] 	= 'no';
	}
	
	if($_SESSION['login_permission'] == 'yes'){
		header('location:index.php');
	}
		
	if($_POST){
		$email = $_POST['email'];
		$passw = $_POST['password'];
		 $type = $_POST['type'];
		
		$con = mysqli_connect("localhost","root","vertrigo","office-management");
		$result = mysqli_query($con,"SELECT * FROM `$type` WHERE email = '$email' AND password = '$passw'");
		while($row = mysqli_fetch_array($result)){			
			$_SESSION['login_permission'] 	= 'yes';		
			$_SESSION['login_type'] 		= $type;
			$_SESSION['user'] 				= $row[$type.'_id'];
			header('location:index.php');
			//echo '<br>done.';
		}
	}
?>

<!DOCTYPE html>
<head>

	<title>Login</title>
	
	<link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/normalize/normalize.css">
	<link rel="stylesheet" href="assets/css/creativeitem.css">
	<link rel="stylesheet" href="assets/css/creativeitem-responsive.css">
	
	<script src="assets/modernizr/modernizr-2.6.2.min.js"></script>
</head>

<body class="login-page" >

<div class="login-wrapper">
	<form action="" method="post">
		<h3><b>Login to your account</b></h3>
		<hr/>
		<div class="control-group">
			<div class="controls">
				<select class="input-block-level" name='type'>
					<option>Select a Type</option>
					<option value='admin' >Admin</option>
					<option value='managing_director'>Managing Director</option>
						<option value='human_resource'>Human Resource</option>
						<option value='accountant'>Accountant</option>
					<option value='director'>Director</option>
				   <option value='executive_officer'>Executive Officer</option>
					<option value='senior_officer'>Senior Officer</option>
					<option value='junior_officer'>Junior Officer</option>
					<option value='senior_officer'>Trainee</option>
			
				</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="email" placeholder="e-mail address" class="input-block-level" name="email" />
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="password" placeholder="Password" class="input-block-level"  name="password"/>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary input-block-level">Sign In</button>
			</div>
		</div>
	</form>
</div>


<!--basic scripts-->
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
<script>window.jQuery || document.write('<script src="assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
<script src="assets/bootstrap/bootstrap.min.js"></script>

</body>
</html>
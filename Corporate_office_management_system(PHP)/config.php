<?php
	session_start();
	
	if(!isset($_SESSION['login_permission'])){
		$_SESSION['login_permission'] 	= 'no';
	}
		
	if($_SESSION['login_permission'] == 'no'){
		header('location:login.php');
	}
	
	$con = mysqli_connect('localhost','root','vertrigo','office-management');
	date_default_timezone_set('Asia/Dacca');
?>
<?php
	session_start();
	$_SESSION['login_permission'] = 'no';
	$_SESSION['login_type'] = '';
	$_SESSION['user'] = '';
	header('location:login.php');
?>
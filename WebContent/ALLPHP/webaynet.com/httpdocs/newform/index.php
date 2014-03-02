<?php
/******************************************************************************
 MachForm
  
 Copyright 2007 Appnitro Software. This code cannot be redistributed without
 permission from http://www.appnitro.com/
 
 More info at: http://www.appnitro.com/
 ******************************************************************************/
	session_start();	

	require('config.php');
	require('includes/db-core.php');
	require('includes/db-functions.php');
	require('includes/helper-functions.php');
	
	$ssl_suffix = get_ssl_suffix();
	
	if(file_exists("installer.php")){
		header("Location: http{$ssl_suffix}://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/installer.php");
		exit;
	}
	
	//redirect to form manager if already logged-in
	if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
		header("Location: http{$ssl_suffix}://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/manage_form.php");
		exit;
	}
	
	if(!empty($_POST['submit'])){
		$username = trim($_POST['admin_username']);
		$password = trim($_POST['admin_password']);
		if(($username != ADMIN_USER) || ($password != ADMIN_PASSWORD)){
			$_SESSION['AP_LOGIN_ERROR'] = 'Please enter the correct user and password!';
		}else{
			$_SESSION['logged_in'] = true;
			
			if(!empty($_SESSION['prev_referer'])){
				$next_page = $_SESSION['prev_referer'];
				
				unset($_SESSION['prev_referer']);
				header("Location: http{$ssl_suffix}://".$_SERVER['HTTP_HOST'].$next_page);
				
				exit;
			}else{
				header("Location: http{$ssl_suffix}://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/manage_form.php");
				exit;
			}
		}
	}
	
	if(!empty($_GET['from'])){
		$_SESSION['prev_referer'] = base64_decode($_GET['from']);
	}
	
	$hide_nav = true;
	
?>    
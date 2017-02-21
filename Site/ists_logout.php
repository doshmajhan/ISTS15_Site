<?php
	if(!isset($_SESSION)) { session_start(); }	
	if(!isset($_SESSION)){
		die();
	}
	$_SESSION = array();
	session_unset();
	session_destroy();
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'ists.php';  

	header("Location: http://$host$uri/$extra");
	exit;

?>
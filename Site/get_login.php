<?php 
if(!isset($_GET['username']) or !isset($_GET['password'])){
	exit("We didn't get the arguments we expected");
}
if(!isset($_SESSION)) { session_start(); }	
include_once('api_calls.php');
$username = $_GET['username'];
$password = $_GET['password'];
$session = login($backend,$scheme,$port,$username,$password);
if(strlen($session) == 32){
	$_SESSION['logged_in'] = "TRUE";
	$_SESSION['session'] = $session;
	echo "TRUE";
}else{
	echo $session;
}
?>
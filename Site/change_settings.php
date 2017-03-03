<?php 
if(!isset($_SESSION)) { session_start(); }	
if(!isset($_SESSION['logged_in'])){
	die();
}
if(!isset($_GET['password']) and !isset($_GET['pin']) and !isset($_GET['balance'])){
	exit("We didn't get the arguments we expected");
}
include_once('api_calls.php');
if(isset($_GET['password'])){
	$cname = get_name($backend,$scheme,$port,$_SESSION['session']);
	$save = change_pass($cname,$bank,$_SESSION['session'],$_GET['password']);
	if(is_array($save)){
		echo $save[0]['Status'];
	}else{
		echo $save;
	}
}
if(isset($_GET['pin'])){
	$cname = get_name($backend,$scheme,$port,$_SESSION['session']);
	$save = change_pin($cname,$bank,$_SESSION['session'],$_GET['pin']);
	if(is_array($save)){
		echo $save[0]['Status'];
	}else{
		echo $save;
	}
}
if(isset($_GET['balance'])){
	$cname = get_name($backend,$scheme,$port,$_SESSION['session']);
	$save = get_balance($cname,$bank,$_SESSION['session']);
	if(is_array($save)){
		echo $save['Balance'];
	}else{
		echo "Loading...";
	}
}
?>
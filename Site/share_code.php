<?php
if(!isset($_SESSION)) { session_start(); }	
if(!isset($_SESSION)){
	die();
}
if(!isset($_GET['code']) or !isset($_GET['country'])){
	exit("We didn't get the arguments we expected");
}

include_once('api_calls.php');
$output = add_res_country($backend,$scheme,$port,$_SESSION['session'],$_GET['code'],$_GET['country']);
	if(isset($output['False'])){
		echo $output['False'];
	}
	if(isset($output['True'])){
		echo "TRUE";
	}
?>

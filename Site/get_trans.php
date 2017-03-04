<?php 
if(!isset($_SESSION)) { session_start(); }	
if(!isset($_SESSION)){
	die();
}
include_once('api_calls.php');
echo get_trans($backend,$scheme,$port,$_SESSION['session']);
?>

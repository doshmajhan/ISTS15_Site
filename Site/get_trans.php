<?php 
if(!isset($_SESSION)) { session_start(); }	
if(!isset($_SESSION)){
	die();
}
include_once('api_calls.php');
echo get_trans($bank,$_SESSION['session']);
?>

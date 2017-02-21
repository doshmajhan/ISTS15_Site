<?php 
if(!isset($_GET['code'])){
	exit("We didn't get the arguments we expected");
}
include_once('api_calls.php');
$output = add_res($backend,$scheme,$port,$_SESSION['session'],$_GET['code']);
	if(isset($output['False'])){
		echo $output['False'];
	}
	if(isset($output['True'])){
		echo "TRUE";
	}
?>

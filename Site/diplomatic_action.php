<?php 
if(!isset($_GET['action']) or !isset($_GET['country'])){
	exit("We didn't get the arguments we expected");
}
include_once('api_calls.php');
$countryAck = array('AU','BR','CA','CN','GB','DE','IN','JP','RU','ZA','US');
$countries = array('Australia','Brazil','Canada','China','United Kingdom','Germany','India','Japan','Russia','South Africa','United States');	
if($_GET['action'] === "peace"){
	$countryCode = $_GET['country'];
	$index = array_search($countryCode, $countryAck);
	$mycountry = $countries[$index];
	$response = add_ally($backend,$scheme,$port,$session,$mycountry);
	if(isset($response['False'])){
		echo $response['False'];
	}
	if(isset($response['True'])){
		echo "TRUE";
	}	
}

if($_GET['action'] === "war"){
	$countryCode = $_GET['country'];
	$index = array_search($countryCode, $countryAck);
	$mycountry = $countries[$index];
	$response = declare_war($backend,$scheme,$port,$session,$mycountry);
	if(isset($response['False'])){
		echo $response['False'];
	}
	if(isset($response['True'])){
		echo "TRUE";
	}	
}

if($_GET['action'] === "neutral"){
	$countryCode = $_GET['country'];
	$index = array_search($countryCode, $countryAck);
	$mycountry = $countries[$index];
	$response = make_neutral($backend,$scheme,$port,$session,$mycountry);
	if(isset($response['False'])){
		echo $response['False'];
	}
	if(isset($response['True'])){
		echo "TRUE";
	}	
}

?>

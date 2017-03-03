<?php 
if(!isset($_SESSION)) { session_start(); }	
if(!isset($_SESSION)){
	die();
}
if(!isset($_GET['country'])){
	exit("We didn't get the arguments we expected");
}
include_once('api_calls.php');
$country = htmlspecialchars($_GET['country'],ENT_QUOTES | ENT_HTML5, 'UTF-8');
$countries = array('Australia','Brazil','Canada','China','United Kingdom','Germany','India','Japan','Russia','South Africa','United States');
$allies = get_ally($backend,$scheme,$port,$_SESSION['session'],$country);
$enemies = get_enemies($backend,$scheme,$port,$_SESSION['session'],$country);
if(($key = array_search($country, $countries)) !== false) {
	unset($countries[$key]);
}	
?>
				<table id="conflict_table">
				<?php
				foreach($enemies['enemies'] as $value){
					echo '<tr><td><img src="/images/flags/'.$country.'.png" width /></td><td><img src="/images/icons/WarIcon.png" width=65 height=52 /></td><td><img src="/images/flags/'.$value.'.png" /></td><td class="conflict_text">('.$country.' and '. $value ,' Are At War)</tr>';					
					if(($key = array_search($value, $countries)) !== false) {
						unset($countries[$key]);
					}					
					
				}
				foreach($allies['allies'] as $value){
					echo '<tr><td><img src="/images/flags/'.$country.'.png" /></td><td><img src="/images/icons/AllyIcon.png" width=65 height=52 /></td><td><img src="/images/flags/'.$value.'.png" /></td><td class="conflict_text">('.$country.' and '. $value ,' Are At Peace)</tr>';					
					if(($key = array_search($value, $countries)) !== false) {
						unset($countries[$key]);
					}					
				}
				foreach($countries as $value){
					echo '<tr><td><img src="/images/flags/'.$country.'.png" /></td><td><img src="/images/icons/NuetralIcon.png" width=65 height=52 /></td><td><img src="/images/flags/'.$value.'.png" /></td><td class="conflict_text">('.$country.' and '. $value ,' Are Neutral)</td></tr>';					
				}
				?>
				</table>
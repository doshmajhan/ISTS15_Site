<?php

function login($backend,$scheme,$port,$country,$password){
	$ch = curl_init();
	$fields = array(
		'country' => urlencode($country),
		'password' => urlencode($password)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/login' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$session = curl_exec($ch); 
	curl_close($ch);
	if(strlen($session) != 32){
		exit("Error: Couldn't Log In");
	}
	return $session;
}

// if returns true it will return the resource it added
function get_res($backend,$scheme,$port,$session){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/getresources' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);	
	return $response;
}

function add_res($backend,$scheme,$port,$session,$resource_code){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'resource' => urlencode($resource_code)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/addresource' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	return $response;
}

function add_ally($backend,$scheme,$port,$session,$country_name){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'country' => urlencode($country_name)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/addally' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	return $response;
}

function make_neutral($backend,$scheme,$port,$session,$country_name){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'country' => urlencode($country_name)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/makeneutral' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	return $response;
}

function get_ally($backend,$scheme,$port,$session,$country){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'country' => urlencode($country)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/getallies' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	if(!isset($response['allies'])){
		exit("Error: We didn't get the response we expected");
	}	
	return $response;
}

function get_enemies($backend,$scheme,$port,$session,$country){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'country' => urlencode($country)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/getenemies' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	if(!isset($response['enemies'])){
		exit("Error: We didn't get the response we expected");
	}
	return $response;
}

function declare_war($backend,$scheme,$port,$session,$country_name){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session),
		'country' => urlencode($country_name)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/declarewar' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	return $response;
}

function get_name($backend,$scheme,$port,$session){
	$ch = curl_init();
	$fields = array(
		'session' => urlencode($session)
	);
	$fields_string = "";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = rtrim($fields_string, '&');
	$fields_string = '?' . $fields_string;
	$url = $scheme.'://'.$backend.':'.$port.'/getname' . $fields_string;

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch); 
	curl_close($ch);
	$response = json_decode($response);
	$response = json_decode(json_encode($response), True);
	# Check if it is an array;
	if(!is_array($response)){
		exit("Error: We didn't get the response we expected");		
	}
	if(isset($response['False'])){
		exit("We were unable to obtain your country name");
	}
	if(isset($response['True'])){
		return $response['True'];
	}
	return $response;
}


$backend = "184.73.151.60";
$scheme = "http";
$port = "5000";
$session = login($backend,$scheme,$port,"United States","password");
//echo get_name($backend,$scheme,$port,$session);
//get_res($backend,$scheme,$port,$session);
//add_res($backend,$scheme,$port,$session,'GBZ658P9NJXXXFAW5FFVOEOXMSKV2Z')
//add_ally($backend,$scheme,$port,$session,'Canada');
//get_ally($backend,$scheme,$port,$session,"United States");
//get_enemies($backend,$scheme,$port,$session,"United States");
//remove_ally($backend,$scheme,$port,$session,'United States');
//get_ally($backend,$scheme,$port,$session);
//declare_war($backend,$scheme,$port,$session,'United States');
//


?>
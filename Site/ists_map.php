<html>
<head>
	<title>ISTS - Diplomacy</title>
	<?php
		include_once('ists_includes.php');
	?>
<script>
<?php
$country = get_name($backend,$scheme,$port,$session);

$countryAck = array('AU','BR','CA','CN','GB','DE','IN','JP','RU','ZA','US');
$allowedCountries = "";
foreach($countryAck as $value){
	$allowedCountries .= "\"".$value."\",";
}
$allowedCountries = rtrim($allowedCountries,',');
$countries = array('Australia','Brazil','Canada','China','United Kingdom','Germany','India','Japan','Russia','South Africa','United States');
$allies = get_ally($backend,$scheme,$port,$session,$country);
$enemies = get_enemies($backend,$scheme,$port,$session,$country);

$status = "";
$index = array_search($country, $countries);
$myCountryAck = $countryAck[$index];
$status .= '"'.$countryAck[$index].'": '. "'You',\n";
unset($countries[$index]);
unset($countryAck[$index]);
foreach($enemies['enemies'] as $value){
	$index = array_search($value, $countries);
	$status .= '"'.$countryAck[$index].'": '. "'Enemy',\n";
	unset($countries[$index]);
	unset($countryAck[$index]);	
}
foreach($allies['allies'] as $value){
	$index = array_search($value, $countries);
	$status .= '"'.$countryAck[$index].'": '. "'Allies',\n";
	unset($countries[$index]);
	unset($countryAck[$index]);
}
foreach($countryAck as $value){
	
	$status .= '"'.$value.'": '. "'Neutral',\n";
}
$status = rtrim($status);
$status = rtrim($status,',');

?>
$( document ).ready(function() {
	if($("#result")!=""){
		setTimeout(
			function() 
			{
				$( "#result" ).html( "" );
		}, 5000);
	}
	var mycountry = '<?php echo $myCountryAck; ?>';
	var allowedCountries = [<?php echo $allowedCountries ?>];
	$(document).on('click', '#cam', function(){
		var country_name = $("#code").val()
		$.get( "diplomatic_action.php?action=peace&country="+country_name, function( data ) {
			if(data != "TRUE"){
				$( "#result" ).html( data );
				setTimeout(
					function() 
					{
						$( "#result" ).html( "" );
				}, 5000);

			}else{
				window.location.href="ists_map.php?added=true";
			}			
		  $( "#result" ).html( data );
		});				
	});

	$(document).on('click', '#war', function(){
		var country_name = $("#code").val()
		$.get( "diplomatic_action.php?action=war&country="+country_name, function( data ) {
			if(data != "TRUE"){
				$( "#result" ).html( data );
				setTimeout(
					function() 
					{
						$( "#result" ).html( "" );
				}, 5000);

			}else{
				window.location.href="ists_map.php?added=true";
			}			
		  $( "#result" ).html( data );
		});				
	});	

	$(document).on('click', '#switz', function(){
		var country_name = $("#code").val()
		$.get( "diplomatic_action.php?action=neutral&country="+country_name, function( data ) {
			if(data != "TRUE"){
				$( "#result" ).html( data );
				setTimeout(
					function() 
					{
						$( "#result" ).html( "" );
				}, 5000);

			}else{
				window.location.href="ists_map.php?added=true";
			}			
		  $( "#result" ).html( data );
		});				
	});		

	var gdpData = {
		<?php echo $status; ?>
	};	

  $('#map').vectorMap({  
  map: 'world_mill',
  onRegionClick: function (event, code) {
		if(code != mycountry){
			if(allowedCountries.indexOf(code) > -1){
				$("#box").html('<h1>Diplomatic Options</h1><br><div style="margin-left:10%; margin-right:10%; display: flex; justify-content:space-between;"><input id="code" type="hidden" value="'+code+'"/> <input type="submit" id="cam" value="Become Allies" /><input id="switz" type="submit" value="Become Neutral"><input id="war" type="submit" value="Declare War" \></div>');
				$.fancybox({
					'autoScale': true,
					'transitionIn': 'elastic',
					'transitionOut': 'elastic',
					'speedIn': 500,
					'speedOut': 300,
					'autoDimensions': true,
					'centerOnScroll': true,
					'href': '#box'
				});
			}
		}
  },
  backgroundColor: '#17415f',
  series: {
    regions: [{
      values: gdpData,
        legend: {
          vertical: false,
          title: 'Diplomacy'
        },
	  scale: {
		'Allies': 'Green',
		'Neutral': 'Orange',
		'Enemy': 'Red',
		'You': '#393939'
	  },
	  attribute: 'fill'
    }]
  }
  });
});
</script>	
</head>
<body>
	<?php
		include_once('ists_header.php');
	?>
	<?php
		include_once('ists_splash.php');
	?>
	<div id="content">
		<div id="title">
			<table><td><img src="images/icons/diplomacy.png" class="title_icon" /></td><td id="titletext">Diplomacy</td></table></div>
		</div>
		<div id="data">
			<div id="page_data">
				<div id="result"><?php if(isset($_GET['added'])){echo "The diplomatic action was undertaken succesfully";}; ?></div>
				<div id="map">
				</div>
				<div id="box" style="display:none;width:500px;"></div>
				<br />
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>
<html>
<head>
	<title>ISTS - Resources</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {	
		$( "#resource_form" ).submit(function( event ) {
			event.preventDefault();	
			$( "#result" ).html( "Attempting to Add... Please Wait!" );
			$.get( "add_code.php?code="+$("#resource_code").val(), function( data ) {
				if(data != "TRUE"){
					$( "#result" ).html( data );
					setTimeout(
						function() 
						{
							$( "#result" ).html( "" );
					}, 5000);

				}else{
					window.location.href="ists_resources.php?added=true";
				}
			});		
		});
		var country_name = "";
		$( "#country_select" ).change(function () {
			var str = "";
			$( "select option:selected" ).each(function() {
				country_name = $( this ).text();		
			});
		}).change();		
		$( "#resShare" ).submit(function( event ) {
			event.preventDefault();	
			$( "#resresult" ).html( "Attempting to Share... Please Wait!" );
			$.get( "share_code.php?"+$("#resShare").serialize(), function( data ) {
				if(data != "TRUE"){
					
					$( "#resresult" ).html( data );


				}else{
					$( "#resresult" ).html( "You have succesfully shared your resource." );
				}
				setTimeout(
					function() 
					{
						$( "#resresult" ).html( "" );
				}, 5000);				
			});		
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
	<?php
		$res = array("water"=>"","food"=>"","electricity"=>"","gas"=>"","luxury"=>"" );
		$resources = get_res($backend,$scheme,$port,$_SESSION['session']);
		$starting = $resources['starting_resources'];

		foreach($starting as $val2){
			$res[$val2[0]]=$val2[1];


		}
		$acquired = $resources['acquired_resources'];
		foreach($acquired as $val2){
			$res[$val2[0]]=$val2[1];
		}
		$water_photo="1a";
		$food_photo="2a";
		$electric_photo="3a";
		$gas_photo="4a";
		$luxury_photo="5a";
		if($res['water']!=""){$water_photo=rtrim($water_photo,'a');}
		if($res['food']!=""){$food_photo=rtrim($food_photo,'a');}
		if($res['electricity']!=""){$electric_photo=rtrim($electric_photo,'a');}
		if($res['gas']!=""){$gas_photo=rtrim($gas_photo,'a');}
		if($res['luxury']!=""){$luxury_photo=rtrim($luxury_photo,'a');}
			
	?>
	<div id="content">
		<div id="title">
			<table><td><img src="images/icons/resources.png" class="title_icon" /></td><td id="titletext">Resources</td></table></div>
		</div>
		<div id="data">
			<div id="page_data">
				<table id="resource_table">
				<tr>
				<td class="resource_text">
				<a class="fancybox" href="#water"><img class="resource_image" src="images/resources/<?php echo $water_photo;?>.png" /></a>
				<div id="water" style="display:none;width:500px;">
					<h2>Water</h2>
					<p>
					This is water, when you have it you can share it.
						<?php 
						if($res['water'] != ""){
							echo '
							<div style="color:red;" id="resresult"></div>
							Share Resource with:
							<form id="resShare">
							<select name="country" id="country_select">
							  <option>Australia</option>
							  <option>Brazil</option>
							  <option>Canada</option>
							  <option>China</option>
							  <option>United Kingdom</option>
							  <option>Germany</option>
							  <option>India</option>
							  <option>Japan</option>				  
							  <option>Russia</option>
							  <option>South Africa</option>
							  <option>United States</option>
							</select>
							<input type="hidden" name="code" value="' . $res['water'] . '" /><input type="submit"></form>
							';
						}
						?> 
						
					</p>
				</div>
				</td>
				<td class="resource_text">
				<a class="fancybox" href="#food"><img class="resource_image" src="images/resources/<?php echo $food_photo;?>.png" /></a>
				<div id="food" style="display:none;width:500px;">
					<h2>Food</h2>
					<p>
						<?php 
						if($res['food'] != ""){echo $res['food'];}
						?> 					
						This is food, when you have food you can share it.</a>
					</p>
				</div>
				</td>
				<td class="resource_text">
				<a class="fancybox" href="#electric"><img class="resource_image" src="images/resources/<?php echo $electric_photo;?>.png" /></a>
				<div id="electric" style="display:none;width:500px;">
					<h2>Electricity</h2>
					<p>
						<?php 
						if($res['electricity'] != ""){echo $res['electricity'];}
						?> 					
						This is electricity, when you have electricity you can share it.</a>
					</p>
				</div>
				</td>
				<td class="resource_text">
				<a class="fancybox" href="#gas"><img class="resource_image" src="images/resources/<?php echo $gas_photo;?>.png" /></a>
				<div id="gas" style="display:none;width:500px;">
					<h2>Gas</h2>
					<p>
						<?php 
						if($res['gas'] != ""){echo $res['gas'];}
						?> 					
						This is gas, when you have gas you can share it.</a>
					</p>
				</div>
				</td>
				<td class="resource_text">
				<a class="fancybox" href="#luxury"><img class="resource_image" src="images/resources/<?php echo $luxury_photo;?>.png" /></a>
				<div id="luxury" style="display:none;width:500px;">
					<h2>Luxury</h2>
					<p>
						<?php 
						if($res['luxury'] != ""){echo $res['luxury'];}
						?> 					
						This is luxury, when you have luxury you can share it</a>
					</p>
				</div>
				<td>
				</tr>
				<tr>
				<td class="resource_text"><a class="fancybox" href="#water">Water</a></td>
				<td class="resource_text"><a class="fancybox" href="#food">Food</a></td>
				<td class="resource_text"><a class="fancybox" href="#electric">Electricity</a></td>
				<td class="resource_text"><a class="fancybox" href="#gas">Gas</a></td>
				<td class="resource_text"><a class="fancybox" href="#luxury">Luxury</a></td>
				</tr>
				</table>
				<br /><br />
				<form id="resource_form">
				Add A Resource: <input id="resource_code" type="textbox" placeholder="Resource Code" /> <input type="submit" value="submit"/><br />
				</form>
				<div id="result"><?php if(isset($_GET['added'])){echo "Resource was added succesfully";}; ?></div>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>

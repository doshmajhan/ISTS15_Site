<html>
<head>
	<title>ISTS Finance - Transaction History</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {
		$( "#country_select" ).change(function () {
			var str = "";
			$( "select option:selected" ).each(function() {
				var country_name = $( this ).text();
				$.get( "get_conflicts.php?country="+country_name, function( data ) {
				  $( "#conflict_data" ).html( data );
				});				
			});
		}).change();
		var my_country = "<?php echo get_name($backend,$scheme,$port,$_SESSION['session']); ?>";
		$("#country_select option").each(function(){
			if($(this).text()==my_country){
				$(this).attr("selected","selected");
				var country_name = $( this ).text();
				setTimeout(function(){
				}, 500);				
				$.get( "get_conflicts.php?country="+country_name, function( data ) {
				  $( "#conflict_data" ).html( data );
				});					
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
			<table><td><img src="images/icons/trans.png" class="title_icon" /></td><td style="width:400px;" id="titletext">Transaction History</td></table></div>
		</div>
		<div id="data">

			<div id="page_data">
				Choose A Country:
				<select id="country_select">
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
				<br /><br />
				<div id="conflict_data"></div>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>
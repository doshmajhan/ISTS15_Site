<html>
<head>
	<title>ISTS Finance - Transaction History</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {
				setTimeout(function(){
				}, 500);				
				$.get( "get_trans.php", function( data ) {
				  $( "#conflict_data" ).html( data );
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
<center>
				<div id="conflict_data" style="margins:auto;"></div>
</center>
		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>

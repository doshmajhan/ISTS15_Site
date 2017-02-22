<html>
<head>
	<title>ISTS Finance - Store</title>
	<?php
		include_once('ists_includes.php');
	?>
	<script>
	$( document ).ready(function() {
		$.get( "change_settings.php?balance=true", function( data ) {
			  $( "#bal" ).html( data );
		
		});
		setInterval(function(){
			$.get( "change_settings.php?balance=true", function( data ) {
				  $( "#bal" ).html( data );
			
			});
		}, 3000);		

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
			<table><td><img src="images/icons/store.png" class="title_icon" /></td><td id="titletext">Store</td></table></div>
		</div>
		<div id="data">

			<div id="page_data">
				Your balance is: <div id="bal">Loading...</div>
			</div>

		</div>
		<?php
			include_once('ists_footer.php');
		?>
	</div>
</body>
</html>